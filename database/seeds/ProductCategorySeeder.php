<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('product_categories')->insert([
        'id' => 1,
        'name' => 'Home decor',
        'parent' => 0,
      ]);
      DB::table('product_categories')->insert([
        'id' => 2,
        'name' => 'Wall decor',
        'parent' => 0,
      ]);
      DB::table('product_categories')->insert([
        'id' => 3,
        'name' => 'Bag',
        'parent' => 0,
      ]);
      DB::table('product_categories')->insert([
        'id' => 4,
        'name' => 'Face mask',
        'parent' => 0,
      ]);
      DB::table('product_categories')->insert([
        'id' => 5,
        'name' => 'T shirt',
        'parent' => 0,
      ]);
      DB::table('product_categories')->insert([
        'id' => 6,
        'name' => 'Sweatshirt',
        'parent' => 0,
      ]);
      DB::table('product_categories')->insert([
        'id' => 7,
        'name' => 'Hoodie',
        'parent' => 0,
      ]);
      DB::table('product_categories')->insert([
        'id' => 8,
        'name' => 'Canvas',
        'parent' => 2,
      ]);
      DB::table('product_categories')->insert([
        'id' => 9,
        'name' => 'Posters',
        'parent' => 2,
      ]);
      // DB::table('product_categories')->insert([
      //   'id' => 10,
      //   'name' => 'Pillow',
      //   'parent' => 1,
      // ]);
      // DB::table('product_categories')->insert([
      //   'id' => 8,
      //   'name' => 'Champion hoodie',
      //   'nav_name' => 'Champion hoodie',
      //   'parent' => 7,
      // ]);
      // DB::table('product_categories')->insert([
      //   'id' => 9,
      //   'name' => 'Lane seven 4001',
      //   'nav_name' => 'Lane seven 4001',
      //   'parent' => 7,
      // ]);
      // DB::table('product_categories')->insert([
      //   'id' => 10,
      //   'name' => 'Champion s600',
      //   'nav_name' => 'Champion s600',
      //   'parent' => 6,
      // ]);
      // DB::table('product_categories')->insert([
      //   'id' => 11,
      //   'name' => 'Anvil 1850',
      //   'nav_name' => 'Anvil 1850',
      //   'parent' => 6,
      // ]);
      // DB::table('product_categories')->insert([
      //   'id' => 12,
      //   'name' => 'Champion T shirt',
      //   'nav_name' => 'Champion T shirt',
      //   'parent' => 5,
      // ]);
      // DB::table('product_categories')->insert([
      //   'id' => 13,
      //   'name' => 'Gildan 5000',
      //   'nav_name' => 'Gildan 5000',
      //   'parent' => 5,
      // ]);
      // DB::table('product_categories')->insert([
      //   'id' => 14,
      //   'name' => '2 layers',
      //   'nav_name' => '2 layers',
      //   'parent' => 4,
      // ]);
      // DB::table('product_categories')->insert([
      //   'id' => 15,
      //   'name' => '3 layers',
      //   'nav_name' => '3 layers',
      //   'parent' => 4,
      // ]);
      // DB::table('product_categories')->insert([
      //   'id' => 16,
      //   'name' => 'AOP Tote Bag',
      //   'nav_name' => 'AOP Tote Bag',
      //   'parent' => 3,
      // ]);
      // DB::table('product_categories')->insert([
      //   'id' => 17,
      //   'name' => 'Laptop sleeve',
      //   'nav_name' => 'Laptop sleeve',
      //   'parent' => 3,
      // ]);
      // DB::table('product_categories')->insert([
      //   'id' => 18,
      //   'name' => 'Draw string bag',
      //   'nav_name' => 'Draw string bag',
      //   'parent' => 3,
      // ]);
      // DB::table('product_categories')->insert([
      //   'id' => 19,
      //   'name' => 'Accessory pouch',
      //   'nav_name' => 'Accessory pouch',
      //   'parent' => 3,
      // ]);
      // DB::table('product_categories')->insert([
      //   'id' => 20,
      //   'name' => 'Premium posters',
      //   'nav_name' => 'Premium posters',
      //   'parent' => 2,
      // ]);
      // DB::table('product_categories')->insert([
      //   'id' => 21,
      //   'name' => 'Canvas gallery wraps',
      //   'nav_name' => 'Canvas gallery wraps',
      //   'parent' => 2,
      // ]);
      // DB::table('product_categories')->insert([
      //   'id' => 22,
      //   'name' => 'Throw Pillow',
      //   'nav_name' => 'Throw Pillow',
      //   'parent' => 1,
      // ]);
      // DB::table('product_categories')->insert([
      //   'id' => 23,
      //   'name' => 'Lumber pillow',
      //   'nav_name' => 'Lumber pillow',
      //   'parent' => 1,
      // ]);
    }
}
