<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('suppliers')->insert([
        'id' => 1,
        'name' => 'gooten',
      ]);
      DB::table('suppliers')->insert([
        'id' => 2,
        'name' => 'scalablepress',
      ]);
      DB::table('suppliers')->insert([
        'id' => 3,
        'name' => 'awkward style',
      ]);
      DB::table('suppliers')->insert([
        'id' => 4,
        'name' => 'mww',
      ]);
    }
}
