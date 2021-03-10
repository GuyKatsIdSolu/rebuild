<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('currency')->default('USD');
            $table->string('country')->default('US');
            $table->string('state')->default('');
            $table->string('city')->default('');
            $table->string('address_1')->default('');
            $table->string('address_2')->default('');
            $table->string('post_code')->default('');
            $table->string('phone')->default('');
            $table->decimal('price', 5, 2)->default(99);
            $table->decimal('shipping_price', 5, 2)->default(0);
            $table->decimal('tax', 5, 2)->default(0);
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
        Schema::dropIfExists('orders');
    }
}
