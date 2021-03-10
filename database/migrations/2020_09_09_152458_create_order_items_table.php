<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\DB;


class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('creator_id');
            $table->bigInteger('order_id');
            $table->bigInteger('product_id');
            $table->bigInteger('supplier_id');
            $table->enum('status', ['new','paymentError','paid','pending','inProduction','shipped','delivered','cancelled']);
            $table->smallInteger('quantity');
            $table->decimal('price', 5, 2)->default(99);
            $table->decimal('shipping_price', 5, 2)->default(0);
            $table->decimal('tax', 5, 2)->default(0);
            $table->smallInteger('discount')->default(15);
            $table->text('properties');//json

            $table->string('tracking_url')->default('');
            $table->timestamp('shipped_on')->useCurrent = true;
            $table->timestamp('delivered_on')->useCurrent = true;

            $table->string('supplier_order_id')->default('');
            $table->string('supplier_order_status')->default('');
            $table->string('customer_payment_status')->default('');
            $table->string('customer_payment_id')->default('');
            $table->string('tracking_number')->default('');
            $table->text('error_msg')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
}
