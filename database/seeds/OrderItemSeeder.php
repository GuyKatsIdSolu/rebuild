<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderItemSeeder extends Seeder
{
  /**
  * Run the database seeds.
  *
  * @return void
  */
  public function run()
  {
    DB::table('order_items')->insert(
      [
        'id' => 1,
        'creator_id' => 1,
        'order_id' => 1,
        'product_id' => 1,
        'supplier_id' => 1,
        'status' => 'new',
        'quantity' => 1,
        'properties' => '{}',
        'error_msg' => '',
        'created_at' => date("Y-m-d H:i:s"),
        'updated_at' => date("Y-m-d H:i:s"),
      ]
    );
    DB::table('order_items')->insert(
      [
        'id' => 2,
        'creator_id' => 1,
        'order_id' => 1,
        'product_id' => 2,
        'supplier_id' => 1,
        'status' => 'new',
        'quantity' => 2,
        'properties' => '{}',
          'error_msg' => '',
        'created_at' => date("Y-m-d H:i:s"),
        'updated_at' => date("Y-m-d H:i:s"),
      ]
    );
  }
}
