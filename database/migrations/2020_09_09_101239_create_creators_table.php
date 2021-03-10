<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('creators', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('username')->default('');
            $table->text('bio');
            $table->string('store_name')->default('');
            $table->tinyInteger('discount')->default(15);
            $table->string('site')->default('');
            $table->text('chosen_products');
            $table->text('products_price');
            $table->boolean('is_first_time')->default(false);
            $table->string('affiliate_id')->default('{"url":"","status":0}');
            $table->string('instagram')->default('{"url":"","status":0}');
            $table->string('facebook')->default('{"url":"","status":0}');
            $table->string('tiktok')->default('{"url":"","status":0}');
            $table->string('twitter')->default('{"url":"","status":0}');
            $table->string('youtube')->default('{"url":"","status":0}');
            $table->string('twitch')->default('{"url":"","status":0}');
            $table->string('patreon')->default('{"url":"","status":0}');
            $table->string('pinterest')->default('{"url":"","status":0}');
            $table->string('tumblr')->default('{"url":"","status":0}');
            $table->string('behance')->default('{"url":"","status":0}');
            $table->string('mail box')->default('{"url":"","status":0}');
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
        Schema::dropIfExists('creators');
    }
}
