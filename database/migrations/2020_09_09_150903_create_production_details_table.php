<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductionDetailsTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('production_details', function (Blueprint $table) {
      $table->id();
      $table->string('product_code');
      $table->string('supplier_product_code');
      $table->integer('supplier_id');
      $table->decimal('cost', 5, 2); // How much we pay for it
      $table->decimal('price', 5, 2)->default(1); // How much we ask for it
      $table->decimal('msrp', 5, 2);  //How much we think the creator need to sell it
      $table->float('image_width');
      $table->float('image_height');
      $table->float('image_ratio');
      $table->text('other')->nullable(true);
    });
  }

  /**
  * Reverse the migrations.
  *
  * @return void
  */
  public function down()
  {
    Schema::dropIfExists('production_details');
  }
}
