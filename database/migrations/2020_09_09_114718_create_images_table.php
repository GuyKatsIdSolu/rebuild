<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('creator_id');
            // $table->bigInteger('store_id');
            $table->string('name');
            $table->text('description');
            $table->enum('status', ['preUploaded','pending','autoNotApproved','approved','notApproved']);
            $table->text('tags');//json
            $table->integer('width');
            $table->integer('height');
            $table->float('ratio');
            $table->integer('likes')->default(0);
            $table->string('average_color')->default('');
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
        Schema::dropIfExists('images');
    }
}
