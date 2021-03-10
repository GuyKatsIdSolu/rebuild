<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CreatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('creators')->insert([
        'id' => 1,
        'user_id' => 1,
        'username' => 'Guy',
        'bio' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
        'store_name' => "Guy Shop",
        'site' => "www.guy.com",
        'chosen_products' => json_encode([
          'face-mask-zuni-s0001',
          'champion-hoodie-s700',
          'lane-seven-4001',
          'gildan-18500b',
          'champion-s600',
          'bella-canvas-ls14004',
          'champion-t-shirt',
          'gildan-500',
          'gildan-500-kids',
          'aop-tote-bag',
          'posters-24-36',
          'posters-36-24',
          'posters-32-48',
          'posters-48-32',
          'canvas-12-12',
          'canvas-16-16',
          'canvas-20-20',
          'canvas-12-18',
          'canvas-18-12',
          'canvas-20-30',
          'canvas-30-20',
          'canvas-36-24',
          'canvas-24-36',
        ]),
        'products_price' => json_encode([
          'face-mask-zuni-s0001'=>10.99,
          'champion-hoodie-s700'=>27.99,
          'lane-seven-4001'=>31.99,
          'gildan-18500b'=>31.95,
          'champion-s600'=>44.99,
          'bella-canvas-ls14004'=>29.99,
          'champion-t-shirt'=>27.99,
          'gildan-500'=>19.99,
          'gildan-500-kids'=>17.99,
          'face-mask-2-layers'=>10.99,
          'face-mask-3-layers'=>10.99,
          'aop-tote-bag'=>23.99,
          'draw-string-bag'=>32.99,
          'posters-24-36'=>13.2,
          'posters-36-24'=>13.2,
          'posters-24-36'=>13.2,
          'posters-32-48'=>13.2,
          'posters-48-32'=>13.2,
          'canvas-12-12'=>8.36,
          'canvas-16-16'=>8.36,
          'canvas-20-20'=>8.36,
          'canvas-12-18'=>8.36,
          'canvas-18-12'=>8.36,
          'canvas-20-30'=>8.36,
          'canvas-30-20'=>8.36,
          'canvas-36-24'=>8.36,
          'canvas-24-36'=>8.36,
        ]),
        'created_at' => date("Y-m-d H:i:s"),
        'updated_at' => date("Y-m-d H:i:s"),
      ]);
    }
}
