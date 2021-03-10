<?php

use Illuminate\Database\Seeder;

class ProductPropertiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('product_properties')->insert([
        'product_code' => 'tanktop-gildan-2200',
        'name' => 'size',
        'options' => json_encode(['s','m','l','xl']),
      ]);
      DB::table('product_properties')->insert([
        'product_code' => 'tanktop-gildan-2200',
        'name' => 'color',
        'options' => json_encode(['red','blue','green','pink']),
      ]);
    }
}
