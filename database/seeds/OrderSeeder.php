<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderSeeder extends Seeder
{
  /**
  * Run the database seeds.
  *
  * @return void
  */
  public function run()
  {
    DB::table('orders')->insert(
      [
        'id' => 1,
        'email' => Str::random(5).'@test.com',
        'first_name' => Str::random(10),
        'last_name' => Str::random(10),
        'created_at' => date("Y-m-d H:i:s"),
        'updated_at' => date("Y-m-d H:i:s"),
      ]
    );
  }
}
