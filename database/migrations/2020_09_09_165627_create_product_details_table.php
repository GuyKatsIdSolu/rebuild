<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_details', function (Blueprint $table) {
            $table->string('product_code')->unique();
            $table->integer('current_supplier_id');
            $table->integer('category_id');
            $table->string('optional_orientation');
            $table->boolean('is_active')->default(true);
            $table->string('title');
            $table->text('description');
            $table->text('html_description');
            $table->text('html_shipping');
            $table->text('html_sizes');
            $table->string('size');
            $table->float('image_width');
            $table->float('image_height');
            $table->float('image_ratio');
            $table->tinyInteger('dynamic_previews_number')->default(2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_details');
    }
}
