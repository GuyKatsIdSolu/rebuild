<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ImageSeeder extends Seeder
{
  /**
  * Run the database seeds.
  *
  * @return void
  */
  public function run()
  {
    // DB::table('images')->insert(
    //   [
    //     'id' => 1,
    //     'creator_id' => 1,
    //     'status' => 'approved',
    //     'name' => Str::random(10),
    //     'description' => Str::random(10),
    //     'tags' => Str::random(10),
    //     'width' => 1000,
    //     'height' => 1000,
    //     'ratio' => 1,
    //     'created_at' => date("Y-m-d H:i:s"),
    //     'updated_at' => date("Y-m-d H:i:s"),
    //   ]
    // );
    // DB::table('images')->insert(
    //   [
    //     'id' => 2,
    //     'creator_id' => 1,
    //     'status' => 'notApproved',
    //     'name' => Str::random(10),
    //     'description' => Str::random(10),
    //     'tags' => Str::random(10),
    //     'width' => 1000,
    //     'height' => 1000,
    //     'ratio' => 1,
    //     'created_at' => date("Y-m-d H:i:s"),
    //     'updated_at' => date("Y-m-d H:i:s"),
    //   ]
    // );
  }
}
