<template>
  <div class="thankyou-page shop">
    <div class="top-name">
      <div class="wrap" v-if="storeOwner">
        <a href="" @click.prevent="$router.push('/@'+storeOwner.username)">
          <img  :src="$root.storageUrl+'/creator_images/'+storeOwner.id+'.jpg'" alt="Avatar of user ">
        </a>
        <a v-if="$root.isMobile" href="" @click.prevent="$router.push('/@'+storeOwner.username)" class="back-mobile">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon" style="width: 16px; height: 16px;vertical-align: middle;fill: currentColor;overflow: hidden;" viewBox="0 0 1024 1024" version="1.1">
            <path
            d="M998.733 930.989l-410.781-410.783 410.77-410.771c0.005-0.005 0.010-0.007 0.016-0.014 21.271-21.272 21.271-55.755 0.001-77.022-21.269-21.269-55.753-21.269-77.022 0.002-0.005 0.004-0.010 0.010-0.015 0.017l-0.002-0.003-410.769 410.77-410.771-410.767c-0.005-0.006-0.010-0.013-0.015-0.017-21.27-21.271-55.755-21.271-77.024-0.002-21.267 21.267-21.27 55.75 0.001 77.022 0.006 0.006 0.011 0.009 0.016 0.014v0.003l410.769 410.768-410.781 410.783c-0.001 0.003-0.002 0.003-0.002 0.003-21.27 21.269-21.27 55.752 0 77.022 21.266 21.265 55.752 21.265 77.020 0 0.001-0.002 0.002-0.002 0.002-0.002l410.783-410.782 410.782 410.782c0 0 0.002 0 0.003 0.002 21.268 21.265 55.753 21.265 77.020 0 21.272-21.27 21.272-55.753 0-77.022 0.001 0 0 0-0.002-0.003z" />
          </svg>
        </a>
        <a v-else href="" @click.prevent="$router.push('/@'+storeOwner.username)" class="back">
          Back To Gallery
        </a>
        <span>
          {{storeOwner.store_name==''? storeOwner.user.first_name+' Shop' : storeOwner.store_name}}
        </span>
      </div>
    </div>
    <div class="container">
      <div class="row row-1">
        <div class="col-md-6">
          <h3><i class="fas fa-check-circle"></i> <b> Order Received</b></h3>
        </div>
      </div>
    </div>
    <div class="cart-option-details-area wrap">
      <div class="container relative">
        <div class="row">
          <div class="return"><a href="" @click.prevent="$router.push('/@'+storeOwner.username)">Return to Gallery Page</a></div>
          <div class="col-md-8">
            <div class="beling-info">
              <h3>Billing Details</h3>
              <span>Thank you! Your order has been received.</span>
              <div class="date">Order ID - {{order.id}}</div>
              <div class="date">Order Date - {{order.received_on}}</div>
            </div>
            <div class="order-info">
              <div class="h3">Order Summary</div>
              <div class="sum">
                <div class="col-md-12 item" v-for="(item, $index) in order.items" :key="$index">
                  <div class="col-md-12" style="margin-bottom: 10px;margin-left: 10px;">Item ID - #{{item.id}}</div>
                  <div class="img col-md-4">
                    <img :src="$root.storageUrl+'/creator_images/'+item.product.image_id+'/previews/'+item.product.product_code+'/1000_1.jpg'" alt=""/>
                  </div>
                  <div class="details col-md-8">
                    <b><div class="col-md-8">{{item.product.details.title}}</div><div class="col-md-4">{{parseInt(item.quantity)}}x  ${{(parseFloat(item.price)/(1-parseFloat(item.discount)/100)).toFixed(2)}} USD</div></b>
                    <div class="col-md-8">Shipping</div><div class="col-md-4">${{parseFloat(item.shipping_price)}} USD</div>
                    <div class="col-md-8">Discount {{parseFloat(item.discount)}}%</div><div class="col-md-4">${{parseFloat(item.price)}} USD</div>
                    <br/>
                    <br/>
                    <b><div class="col-md-8">Sub Total</div><div class="col-md-4">${{((parseFloat(item.price)+parseFloat(item.shipping_price))*parseInt(item.quantity)).toFixed(2)}} USD</div></b>
                  </div>
                </div>
                <div class="total">
                  <div class="col-md-8">Order Total</div><div class="col-md-4">${{(total).toFixed(2)}} USD</div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-md-offset-1">
            <div class="customer-details">
              <h3>Customer Details</h3>
              <p>Email <span>{{order.email}}</span></p>
            </div>
            <div class="customer-details">
              <h3>Billing Address</h3>
              <p>{{order.first_name+' '+order.last_name}}<br>
                {{order.address_1+' '+order.address_2}}<br>
                {{order.city}}<br>
                {{order.post_code}}<br>
                {{order.state}} ,
                {{order.country}}</p>
              </div>
              <div class="customer-details">
                <h3>Shipping Address</h3>
                <p>{{order.first_name+' '+order.last_name}}<br>
                  {{order.address_1+' '+order.address_2}}<br>
                  {{order.city}}<br>
                  {{order.post_code}}<br>
                  {{order.state}} ,
                  {{order.country}}</p>
                </div>
                <div class="customer-details">
                  <a id="print-now" href=""><i class="fa fa-print"></i> PRINT NOW</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
</template>

<script>
import Api from "../apis/Api";
export default {
  data() {
    return {
      order:null,
      storeOwner: null,
      total: 0,
    };
  },
  watch:{
    $route() {
    },
  },
  created() {
    var that = this;
    Api.get('/api/order/' + this.$route.params.orderId)
    .then(response => {
      for (var i in response.data.items) {
        if (response.data.items.hasOwnProperty(i)) {
          that.total+=parseFloat(response.data.items[i].price);
        }
      }
      that.order=response.data;
      that.storeOwner=that.order.creator;

    });
  },
  mounted() {
  },

};
</script>
