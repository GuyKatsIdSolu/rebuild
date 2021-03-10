<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use GuzzleHttp\Client;

use App\Jobs\SendToProduction;

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Hash;
use Auth;
use Cart;
use App\Mail\OrderShipped;

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use PayPal\Api\ShippingAddress;
use PayPal\Exception\PayPalConnectionException;


class PaymentController extends Controller {
  /*
  * Process payment using credit card
  */

  public function getBluesnapToken() {
    $client = new Client();
    $sandbox = [
      'url' => 'https://sandbox.bluesnap.com/services/2/payment-fields-tokens/',
      'auth' => ['API_1598190296828279259865', 'Ondema66']
    ];
    $live = [
      'url' => 'https://ws.bluesnap.com/services/2/payment-fields-tokens/',
      'auth' => ['API_1535458503708892271764', 'Guyguy66']
    ];
    $relevant = $sandbox;
    if (config('app.storage_dir') == 'live')
    $relevant = $live;
    $res = $client->request('POST', $relevant['url'], [
      'auth' => $relevant['auth']
    ]);
    $header = $res->getHeader('location')[0];
    $pfToken = str_replace($relevant['url'], '', $header);
    if (!session()->has('pfToken'))
    session()->put('pfToken', $pfToken);
    return $pfToken;
  }

  public function payWithCreditCard(Request $request) {
    if (config('app.storage_dir') == 'live'){
      \tdanielcox\Bluesnap\Bluesnap::init('production', 'API_1535458503708892271764', 'Guyguy66');
    }
    else{
      \tdanielcox\Bluesnap\Bluesnap::init('sandbox', 'API_1598190296828279259865', 'Ondema66');
    }
    $ordersId = [];
    $shippingPrice = 0;
    $taxPrice = 0;
    $subTotal = 0;
    $metaData = [];

    $order=Order::create([
      'first_name' => $request->first_name,
      'last_name' => $request->last_name,
      'address_1' => $request->address_1,
      'address_2' => $request->address_2? $request->address_2 : '',
      'city' => $request->city,
      'post_code' => $request->post_code,
      'state' => $request->state,
      'country' => $request->country_code,
      'phone' => $request->phone? $request->phone : '',
      'email' => $request->email,
    ]);

    foreach (Cart::content() as $item) {
      $metaData=[];
      $curShippingPrice=$item->options->shippingPrice * $item->qty;
      $curSubTotal=round($item->price * ((100 - ($item->options->discount  + session()->get('coupon'))) / 100), 2) * $item->qty;
      $cur_tax_price=$item->options->taxPrice * $item->qty;
      $shippingPrice+=$curShippingPrice;
      $subTotal+=$curSubTotal;
      $taxPrice+=$cur_tax_price;

      $product=Product::find($item->id);
      $orderItem=OrderItem::create([
        'creator_id' => $product->creator_id,
        'product_id' => $product->id,
        'supplier_id' => $product->details->current_supplier_id,
        'order_id' => $order->id,
        'status' => 'new',
        'quantity' => $item->qty,
        'price' => $item->price * ((100 - ($item->options->discount  + session()->get('coupon'))) / 100),
        'shipping_price' => $item->options->shippingPrice,
        'tax' => $item->options->taxPrice,
        'discount' => $item->options->discount  + session()->get('coupon'),
        'properties' => json_encode($item->options->properties),
      ]);
      $metaData[]=[
        'metaKey' =>'#'.$orderItem->id,
        'metaValue' => '**'.$item->qty.' X** **'.$item->name.'** **$'.($curSubTotal + $curShippingPrice + $cur_tax_price).'** **'.$item->options->previewUrl.'**',
        'metaDescription' => 'name',
      ];
    }
    DB::table('orders')->where('id',$order->id)->update([
      'shipping_price' => $shippingPrice,
      'tax' => $taxPrice,
      'price' => $subTotal,
    ]);

    $response = \tdanielcox\Bluesnap\CardTransaction::create([
      "pfToken" => $request->pfToken,
      'amount' => $subTotal + $shippingPrice + $taxPrice,
      'currency' => 'USD',
      'recurringTransaction' => 'ECOMMERCE',
      'softDescriptor' => '',
      'cardHolderInfo' => [
        'firstName' => explode(' ', $request->cardholder_name)[0],
        'lastName' => explode(' ', $request->cardholder_name)[1],
        'email' => $request->email,
        'zip' => $request->post_code,
      ],
      'transactionMetaData' => [
        'metaData'=>$metaData,
      ],
      'cardTransactionType' => 'AUTH_CAPTURE',
      'merchantTransactionId' => $order->id,
    ]);
    foreach($order->items as $orderItem){
      if ($response->failed()) {
        $error = $response->data;
        OrderItem::where('id', $orderItem->id)->update([
          'status' => 'PaymentError',
          'error_msg' => $error,
        ]);
      }else{
        $transaction = $response->data;
        OrderItem::where('id', $orderItem->id)->update([
          'status' => 'Paid',
          'customer_payment_id' => $transaction->id,
        ]);
        dispatch(new SendToProduction($orderItem->id));
      }
    }
    if ($response->failed()) {
      return [
        'success'=>0,
        'msg'=>$error
      ];
    }
    return [
      'success'=>1,
      'url'=>"/order-received-".$order->id
    ];
  }

  public function paypalPaymentSucceeded($orderId, Request $request) {
    $paypal_conf = \Config::get('paypal');
    $api_context = new ApiContext(new OAuthTokenCredential(
      $paypal_conf['client_id'],
      $paypal_conf['secret'])
    );
    $api_context->setConfig([
      'mode' => 'live'
    ]);
    // $payment = Paypalpayment::getById($request->paymentId, Paypalpayment::apiContext());
    $payment = (new Payment())->get($request->paymentId, $api_context);
    $execution = new PaymentExecution();
    $execution->setPayerId($request->PayerID);
    $order=Order::find($orderId);
    try {
      // ### Create Payment
      // Create a payment by posting to the APIService
      // using a valid ApiContext
      // The return object contains the status;
      $payment->execute($execution, $api_context);
      foreach($order->items as $orderItem){
        OrderItem::where('id', $orderItem->id)->update([
          'status' => 'Paid',
          'customer_payment_id' => $payment->transactions[0]->related_resources[0]->sale->id
        ]);
        dispatch(new SendToProduction($orderItem->id));
      }
      return redirect("/order-received-$orderId");
    }
    catch (\Exception $ex) {
      $error = $ex->getMessage();
      foreach($order->items as $orderItem){
        OrderItem::where('id', $orderItem->id)->update([
          'status' => 'PaymentError',
          'error_msg' => $error,
        ]);
      }
      return response()->json(["error" => $ex->getMessage()], 400);
      //            return redirect()->back()->with('error', 'Address issue! ');
      //            return response()->json(["error" => 'dfgdfggdg'], 400);
    }
  }

  public function paypalPaymentFailed($orderId, Request $request) {
    $order=Order::find($orderId);
    foreach($order->items as $orderItem){
      OrderItem::where('id', $orderItem->id)->update([
        'status' => 'PaymentError',
        'error_msg' => $error,
      ]);
    }
    die('Payment Failed');
  }

  /*
  * Process payment with express checkout
  */

  public function payWithPaypal(Request $request) {
    $paypal_conf = \Config::get('paypal');
    $api_context = new ApiContext(new OAuthTokenCredential(
      $paypal_conf['client_id'],
      $paypal_conf['secret'])
    );
    $api_context->setConfig($paypal_conf['settings']);
    $payer = new Payer();
    $payer->setPaymentMethod('paypal');
    $shippingAddress = new ShippingAddress();
    $shippingAddress->setLine1($request->address_1)
    ->setLine2($request->address_2? $request->address_2 : '')
    ->setCity($request->city)
    ->setState($request->state)
    ->setPostalCode($request->post_code)
    ->setCountryCode($request->country_code)
    ->setPhone($request->phone ? $request->phone : '000000')
    ->setRecipientName($request->first_name);
    $items = [];
    $shippingPrice = 0;
    $taxPrice = 0;
    $subTotal = 0;

    $order=Order::create([
      'first_name' => $request->first_name,
      'last_name' => $request->last_name,
      'address_1' => $request->address_1,
      'address_2' => $request->address_2? $request->address_2 : '',
      'city' => $request->city,
      'post_code' => $request->post_code,
      'state' => $request->state,
      'country' => $request->country_code,
      'phone' => $request->phone? $request->phone : '',
      'email' => $request->email,
    ]);

    foreach (Cart::content() as $item) {
      $product=Product::find($item->id);
      $orderItem=OrderItem::create([
        'creator_id' => $product->creator_id,
        'product_id' => $product->id,
        'supplier_id' => $product->details->current_supplier_id,
        'order_id' => $order->id,
        'status' => 'new',
        'quantity' => $item->qty,
        'price' => $item->price * ((100 - ($item->options->discount  + session()->get('coupon'))) / 100),
        'shipping_price' => $item->options->shippingPrice,
        'tax' => $item->options->taxPrice,
        'discount' => $item->options->discount  + session()->get('coupon'),
        'properties' => json_encode($item->options->properties),
      ]);
      $items[] = (new Item())->setName($item->name.' '.$orderItem->id)
      ->setDescription($item->name)
      ->setCurrency('USD')
      ->setQuantity($item->qty)
      ->setTax($item->options->taxPrice)
      ->setPrice($item->price * ((100 - ($item->options->discount  + session()->get('coupon'))) / 100));
      $shippingPrice+=$item->options->shippingPrice * $item->qty;
      $subTotal+=round($item->price * ((100 - ($item->options->discount  + session()->get('coupon'))) / 100), 2) * $item->qty;
      $taxPrice+=$item->options->taxPrice * $item->qty;


    }

    $details = new Details();
    $details->setShipping($shippingPrice)
    ->setTax($taxPrice)
    ->setSubtotal($subTotal);
    $amount = new Amount();
    $amount->setCurrency('USD')
    ->setTotal($subTotal + $shippingPrice)
    ->setDetails($details);
    $item_list = new ItemList();
    $item_list->setItems($items)
    ->setShippingAddress($shippingAddress);

    DB::table('orders')->where('id',$order->id)->update([
      'shipping_price' => $shippingPrice,
      'tax' => $taxPrice,
      'price' => $subTotal,
    ]);

    $transaction = new Transaction();
    $transaction->setAmount($amount)
    ->setItemList($item_list)
    ->setDescription("Payment description")
    ->setInvoiceNumber($order->id);

    $redirectUrls = new RedirectUrls();
    $redirectUrls->setReturnUrl(url("/api/paypal-payment-succeeded/$order->id"))
    ->setCancelUrl(url("/api/paypal-payment-failed/$order->id"));
    $payment =new Payment();
    $payment->setIntent("sale")
    ->setPayer($payer)
    ->setRedirectUrls($redirectUrls)
    ->setTransactions([$transaction]);


    try {
      $payment->create($api_context);
    } catch (\Exception $ex) {
      // var_die($ex->getData());
      return response()->json(["error" => $ex->getData()], 400);
    }

    return $payment->getApprovalLink();
  }

  /*
  Use this call to get a list of payments.
  url:payment/
  */

  public function index() {

    $payments = Paypalpayment::getAll(['count' => 1, 'start_index' => 0], Paypalpayment::apiContext());

    return response()->json([$payments->toArray()], 200);
  }

}
