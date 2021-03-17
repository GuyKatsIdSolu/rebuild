<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ProductionDetailsSeeder extends Seeder
{
  /**
  * Run the database seeds.
  *
  * @return void
  */
  public function run()
  {
    DB::table('production_details')->insert([
      'product_code' => 'champion-hoodie-s700',
      'supplier_product_code' => 'anvil-fashion-fit-t-shirt',
      'supplier_id' => 3,
      'cost' => 31.94,
      'price' => 39.99,
      'msrp' => 49.99,
      'image_width' => 3300,
      'image_height' => 2347,
      'image_ratio' => 1.4,
      'other' => json_encode([
        'requireProperties'=>[
          [
            'name'=>'size',
            'options'=>[
              's'=>'sml',
              'm'=>'med',
              'l'=>'lrg',
              'xl'=>'xlg',
              '2xl'=>'xxl',
              '3xl'=>'xxxl',
            ]
          ],
          [
            'name'=>'color',
            'options'=>[
              'white'=>'white',
              'black'=>'black',
            ]
          ]
        ]
      ]),
    ]);
    DB::table('production_details')->insert([
      'product_code' => 'lane-seven-4001',
      'supplier_product_code' => 'anvil-fashion-fit-t-shirt',
      'supplier_id' => 3,
      'cost' => 15.89,
      'price' => 22.99,
      'msrp' => 31.99,
      'image_width' => 3500,
      'image_height' => 3000,
      'image_ratio' => 1.4,
      'other' => json_encode([
        'requireProperties'=>[
          [
            'name'=>'size',
            'options'=>[
              's'=>'sml',
              'm'=>'med',
              'l'=>'lrg',
              'xl'=>'xlg',
              '2xl'=>'xxl',
              '3xl'=>'xxxl',
            ]
          ],
          [
            'name'=>'color',
            'options'=>[
              'white'=>'white',
              'black'=>'black',
            ]
          ]
        ]
      ]),
    ]);
    DB::table('production_details')->insert([
      'product_code' => 'gildan-18500b',
      'supplier_product_code' => 'anvil-fashion-fit-t-shirt',
      'supplier_id' => 3,
      'cost' => 18.63,
      'price' => 23.99,
      'msrp' => 31.95,
      'image_width' => 2700,
      'image_height' => 1800,
      'image_ratio' => 1.5,
      'other' => json_encode([
        'requireProperties'=>[
          [
            'name'=>'size',
            'options'=>[
              's'=>'sml',
              'm'=>'med',
              'l'=>'lrg',
              'xl'=>'xlg',
              '2xl'=>'xxl',
              '3xl'=>'xxxl',
            ]
          ],
          [
            'name'=>'color',
            'options'=>[
              'white'=>'white',
              'black'=>'black',
            ]
          ]
        ]
      ]),
    ]);
    DB::table('production_details')->insert([
      'product_code' => 'champion-s600',
      'supplier_product_code' => 'anvil-fashion-fit-t-shirt',
      'supplier_id' => 3,
      'cost' => 24.85,
      'price' => 34.99,
      'msrp' => 44.99,
      'image_width' => 4200,
      'image_height' => 5100,
      'image_ratio' => 0.823,
      'other' => json_encode([
        'requireProperties'=>[
          [
            'name'=>'size',
            'options'=>[
              's'=>'sml',
              'm'=>'med',
              'l'=>'lrg',
              'xl'=>'xlg',
              '2xl'=>'xxl',
              '3xl'=>'xxxl',
            ]
          ],
          [
            'name'=>'color',
            'options'=>[
              'white'=>'white',
              'black'=>'black',
            ]
          ]
        ]
      ]),
    ]);
    DB::table('production_details')->insert([
      'product_code' => 'bella-canvas-ls14004',
      'supplier_product_code' => 'anvil-fashion-fit-t-shirt',
      'supplier_id' => 3,
      'cost' => 14.8,
      'price' => 21.99,
      'msrp' => 29.99,
      'image_width' => 3600,
      'image_height' => 4800,
      'image_ratio' => 0.75,
      'other' => json_encode([
        'requireProperties'=>[
          [
            'name'=>'size',
            'options'=>[
              's'=>'sml',
              'm'=>'med',
              'l'=>'lrg',
              'xl'=>'xlg',
              '2xl'=>'xxl',
              '3xl'=>'xxxl',
            ]
          ],
          [
            'name'=>'color',
            'options'=>[
              'white'=>'white',
              'black'=>'black',
            ]
          ]
        ]
      ]),
    ]);
    DB::table('production_details')->insert([
      'product_code' => 'gildan-18000b',
      'supplier_product_code' => 'anvil-fashion-fit-t-shirt',
      'supplier_id' => 3,
      'cost' => 14.8,
      'price' => 21.99,
      'msrp' => 29.99,
      'image_width' => 3600,
      'image_height' => 4800,
      'image_ratio' => 0.75,
      'other' => json_encode([
        'requireProperties'=>[
          [
            'name'=>'size',
            'options'=>[
              's'=>'sml',
              'm'=>'med',
              'l'=>'lrg',
              'xl'=>'xlg',
              '2xl'=>'xxl',
              '3xl'=>'xxxl',
            ]
          ],
          [
            'name'=>'color',
            'options'=>[
              'white'=>'white',
              'black'=>'black',
            ]
          ]
        ]
      ]),
    ]);
    DB::table('production_details')->insert([
      'product_code' => 'champion-t-shirt',
      'supplier_product_code' => 'anvil-fashion-fit-t-shirt',
      'supplier_id' => 3,
      'cost' => 14.00,
      'price' => 18.99,
      'msrp' => 27.99,
      'image_width' => 3600,
      'image_height' => 4800,
      'image_ratio' => 0.75,
      'other' => json_encode([
        'requireProperties'=>[
          [
            'name'=>'size',
            'options'=>[
              's'=>'sml',
              'm'=>'med',
              'l'=>'lrg',
              'xl'=>'xlg',
              '2xl'=>'xxl',
              '3xl'=>'xxxl',
            ]
          ],
          [
            'name'=>'color',
            'options'=>[
              'white'=>'white',
              'black'=>'black',
            ]
          ]
        ]
      ]),
    ]);
    DB::table('production_details')->insert([
      'product_code' => 'gildan-500',
      'supplier_product_code' => 'anvil-fashion-fit-t-shirt',
      'supplier_id' => 3,
      'cost' => 8.43,
      'price' => 13.99,
      'msrp' => 19.99,
      'image_width' => 3600,
      'image_height' => 4500,
      'image_ratio' => 0.75,
      'other' => json_encode([
        'requireProperties'=>[
          [
            'name'=>'size',
            'options'=>[
              's'=>'sml',
              'm'=>'med',
              'l'=>'lrg',
              'xl'=>'xlg',
              '2xl'=>'xxl',
              '3xl'=>'xxxl',
            ]
          ],
          [
            'name'=>'color',
            'options'=>[
              'white'=>'white',
              'black'=>'black',
            ]
          ]
        ]
      ]),
    ]);
    DB::table('production_details')->insert([
      'product_code' => 'gildan-500-kids',
      'supplier_product_code' => 'anvil-fashion-fit-t-shirt',
      'supplier_id' => 3,
      'cost' => 6.83,
      'price' => 11.99,
      'msrp' => 17.99,
      'image_width' => 2700,
      'image_height' => 3300,
      'image_ratio' => 0.75,
      'other' => json_encode([
        'requireProperties'=>[
          [
            'name'=>'size',
            'options'=>[
              's'=>'sml',
              'm'=>'med',
              'l'=>'lrg',
              'xl'=>'xlg',
              '2xl'=>'xxl',
              '3xl'=>'xxxl',
            ]
          ],
          [
            'name'=>'color',
            'options'=>[
              'white'=>'white',
              'black'=>'black',
            ]
          ]
        ]
      ]),
    ]);
    DB::table('production_details')->insert([
      'product_code' => 'face-mask-zuni-s0001',
      'supplier_product_code' => 'anvil-fashion-fit-t-shirt',
      'supplier_id' => 3,
      'cost' => 5.11,
      'price' => 7.99,
      'msrp' => 10.99,
      'image_width' => 1800,
      'image_height' => 1200,
      'image_ratio' => 1.5,
      'other' => json_encode([
        'requireProperties'=>[]
      ]),
    ]);
    // DB::table('production_details')->insert([
    //   'product_code' => 'face-mask-2-layers',
    //   'supplier_product_code' => 'anvil-fashion-fit-t-shirt',
    //   'supplier_id' => 2,
    //   'cost' => 4.91,
    //   'price' => 7.99,
    //   'msrp' => 10.99,
    //   'image_width' => 1189,
    //   'image_height' => 814,
    //   'image_ratio' => 1.41,
    //   'other' => json_encode([
    //     'requireProperties'=>[]
    //   ]),
    // ]);
    // DB::table('production_details')->insert([
    //   'product_code' => 'face-mask-3-layers',
    //   'supplier_product_code' => 'anvil-fashion-fit-t-shirt',
    //   'supplier_id' => 2,
    //   'cost' => 4.91,
    //   'price' => 7.99,
    //   'msrp' => 10.99,
    //   'image_width' => 1189,
    //   'image_height' => 814,
    //   'image_ratio' => 1.41,
    //   'other' => json_encode([
    //     'requireProperties'=>[]
    //   ]),
    // ]);
    DB::table('production_details')->insert([
      'product_code' => 'aop-tote-bag',
      'supplier_product_code' => 'anvil-fashion-fit-t-shirt',
      'supplier_id' => 4,
      'cost' => 11.29,
      'price' => 16.29,
      'msrp' => 23.99,
      'image_width' => 2925,
      'image_height' => 2925,
      'image_ratio' => 1,
      'other' => json_encode([
        'requireProperties'=>[]
      ]),
    ]);
    // DB::table('production_details')->insert([
    //   'product_code' => 'draw-string-bag',
    //   'supplier_product_code' => 'anvil-fashion-fit-t-shirt',
    //   'supplier_id' => 4,
    //   'cost' => 20.56,
    //   'price' => 25.99,
    //   'msrp' => 32.99,
    //   'image_width' => 4950,
    //   'image_height' => 4950,
    //   'image_ratio' => 1,
    //   'other' => json_encode([
    //     'requireProperties'=>[]
    //   ]),
    // ]);
    DB::table('production_details')->insert([
      'product_code' => 'posters-24-36',
      'supplier_product_code' => 'anvil-fashion-fit-t-shirt',
      'supplier_id' => 1,
      'cost' => 13.2,
      'price' => 13.2,
      'msrp' => 13.2,
      'image_width' => 3600,
      'image_height' => 4800,
      'image_ratio' => 0.66,
      'other' => json_encode([
        'requireProperties'=>[]
      ]),
    ]);
    DB::table('production_details')->insert([
      'product_code' => 'posters-32-48',
      'supplier_product_code' => 'anvil-fashion-fit-t-shirt',
      'supplier_id' => 1,
      'cost' => 13.2,
      'price' => 13.2,
      'msrp' => 13.2,
      'image_width' => 3600,
      'image_height' => 4800,
      'image_ratio' => 0.66,
      'other' => json_encode([
        'requireProperties'=>[]
      ]),
    ]);
    DB::table('production_details')->insert([
      'product_code' => 'posters-36-24',
      'supplier_product_code' => 'anvil-fashion-fit-t-shirt',
      'supplier_id' => 1,
      'cost' => 13.2,
      'price' => 13.2,
      'msrp' => 13.2,
      'image_width' => 3600,
      'image_height' => 4800,
      'image_ratio' => 0.66,
      'other' => json_encode([
        'requireProperties'=>[]
      ]),
    ]);
    DB::table('production_details')->insert([
      'product_code' => 'posters-48-32',
      'supplier_product_code' => 'anvil-fashion-fit-t-shirt',
      'supplier_id' => 1,
      'cost' => 13.2,
      'price' => 13.2,
      'msrp' => 13.2,
      'image_width' => 3600,
      'image_height' => 4800,
      'image_ratio' => 0.66,
      'other' => json_encode([
        'requireProperties'=>[]
      ]),
    ]);
    DB::table('production_details')->insert([
      'product_code' => 'canvas-12-12',
      'supplier_product_code' => 'anvil-fashion-fit-t-shirt',
      'supplier_id' => 1,
      'cost' => 8.36,
      'price' => 8.36,
      'msrp' => 8.36,
      'image_width' => 3600,
      'image_height' => 4800,
      'image_ratio' => 0.66,
      'other' => json_encode([
        'requireProperties'=>[]
      ]),
    ]);
    DB::table('production_details')->insert([
      'product_code' => 'canvas-16-16',
      'supplier_product_code' => 'anvil-fashion-fit-t-shirt',
      'supplier_id' => 1,
      'cost' => 8.36,
      'price' => 8.36,
      'msrp' => 8.36,
      'image_width' => 3600,
      'image_height' => 4800,
      'image_ratio' => 0.66,
      'other' => json_encode([
        'requireProperties'=>[]
      ]),
    ]);
    DB::table('production_details')->insert([
      'product_code' => 'canvas-20-20',
      'supplier_product_code' => 'anvil-fashion-fit-t-shirt',
      'supplier_id' => 1,
      'cost' => 8.36,
      'price' => 8.36,
      'msrp' => 8.36,
      'image_width' => 3600,
      'image_height' => 4800,
      'image_ratio' => 0.66,
      'other' => json_encode([
        'requireProperties'=>[]
      ]),
    ]);
    DB::table('production_details')->insert([
      'product_code' => 'canvas-12-18',
      'supplier_product_code' => 'anvil-fashion-fit-t-shirt',
      'supplier_id' => 1,
      'cost' => 8.36,
      'price' => 8.36,
      'msrp' => 8.36,
      'image_width' => 3600,
      'image_height' => 4800,
      'image_ratio' => 0.66,
      'other' => json_encode([
        'requireProperties'=>[]
      ]),
    ]);
    DB::table('production_details')->insert([
      'product_code' => 'canvas-24-36',
      'supplier_product_code' => 'anvil-fashion-fit-t-shirt',
      'supplier_id' => 1,
      'cost' => 8.36,
      'price' => 8.36,
      'msrp' => 8.36,
      'image_width' => 3600,
      'image_height' => 4800,
      'image_ratio' => 0.66,
      'other' => json_encode([
        'requireProperties'=>[]
      ]),
    ]);
    DB::table('production_details')->insert([
      'product_code' => 'canvas-20-30',
      'supplier_product_code' => 'anvil-fashion-fit-t-shirt',
      'supplier_id' => 1,
      'cost' => 8.36,
      'price' => 8.36,
      'msrp' => 8.36,
      'image_width' => 3600,
      'image_height' => 4800,
      'image_ratio' => 0.66,
      'other' => json_encode([
        'requireProperties'=>[]
      ]),
    ]);
    DB::table('production_details')->insert([
      'product_code' => 'canvas-18-12',
      'supplier_product_code' => 'anvil-fashion-fit-t-shirt',
      'supplier_id' => 1,
      'cost' => 8.36,
      'price' => 8.36,
      'msrp' => 8.36,
      'image_width' => 3600,
      'image_height' => 4800,
      'image_ratio' => 0.66,
      'other' => json_encode([
        'requireProperties'=>[]
      ]),
    ]);
    DB::table('production_details')->insert([
      'product_code' => 'canvas-30-20',
      'supplier_product_code' => 'anvil-fashion-fit-t-shirt',
      'supplier_id' => 1,
      'cost' => 8.36,
      'price' => 8.36,
      'msrp' => 8.36,
      'image_width' => 3600,
      'image_height' => 4800,
      'image_ratio' => 0.66,
      'other' => json_encode([
        'requireProperties'=>[]
      ]),
    ]);
    DB::table('production_details')->insert([
      'product_code' => 'canvas-36-24',
      'supplier_product_code' => 'anvil-fashion-fit-t-shirt',
      'supplier_id' => 1,
      'cost' => 8.36,
      'price' => 8.36,
      'msrp' => 8.36,
      'image_width' => 3600,
      'image_height' => 4800,
      'image_ratio' => 0.66,
      'other' => json_encode([
        'requireProperties'=>[]
      ]),
    ]);
  //   DB::table('production_details')->insert([
  //     'product_code' => 'throw-pillow-sewn-16x16',
  //     'supplier_product_code' => 'ThrowPillow_Sewn_16x16',
  //     'supplier_id' => 1,
  //     'cost' => 9.9,
  //     'price' => 15.99,
  //     'msrp' => 25.99,
  //     'image_width' => 3125,
  //     'image_height' => 3125,
  //     'image_ratio' => 1,
  //     'other' => json_encode([
  //       'requireProperties'=>[]
  //     ]),
  //   ]);
  //   DB::table('production_details')->insert([
  //     'product_code' => 'tshirt-anvil-980',
  //     'supplier_product_code' => 'anvil-fashion-fit-t-shirt',
  //     'supplier_id' => 2,
  //     'cost' => 14.00,
  //     'msrp' => 27.99,
  //     'image_width' => 4500,
  //     'image_height' => 5700,
  //     'image_ratio' => 0.83,
  //     'other' => json_encode([
  //       'type'=>'dtg',
  //       "sides[front][dimensions][width]" => '14',
  //       "sides[front][position][horizontal]" => 'C',
  //       "sides[front][position][offset][top]" => '2.5',
  //       'requireProperties'=>[
  //         [
  //           'name'=>'size',
  //           'options'=>[
  //             's'=>'sml',
  //             'm'=>'med',
  //             'l'=>'lrg',
  //             'xl'=>'xlg',
  //             '2xl'=>'xxl',
  //             '3xl'=>'xxxl',
  //           ]
  //         ],
  //         [
  //           'name'=>'color',
  //           'options'=>[
  //             'white'=>'white',
  //             'black'=>'black',
  //           ]
  //         ]
  //       ]
  //     ]),
  //   ]);
  //   DB::table('production_details')->insert([
  //     'product_code' => 'tshirt-anvil-980',
  //     'supplier_product_code' => 'Apparel-DTG-Tshirt-Anvil-980-{size}-{color}-Unisex-CF',
  //     'supplier_id' => 1,
  //     'cost' => 14.00,
  //     'msrp' => 27.99,
  //     'image_width' => 4500,
  //     'image_height' => 5700,
  //     'image_ratio' => 0.83,
  //     'other' => json_encode([
  //       'requireProperties'=>[
  //         [
  //           'name'=>'size',
  //           'options'=>[
  //             's'=>'S',
  //             'm'=>'M',
  //             'l'=>'L',
  //             'xl'=>'XL',
  //             '2xl'=>'2XL',
  //             '3xl'=>'3XL',
  //           ]
  //         ],
  //         [
  //           'name'=>'color',
  //           'options'=>[
  //             'white'=>'White',
  //             'black'=>'Black',
  //           ]
  //         ]
  //       ]
  //     ]),
  //   ]);
  //   DB::table('production_details')->insert([
  //     'product_code' => 'tanktop-gildan-2200',
  //     'supplier_product_code' => 'Apparel-DTG-TankTop-Gildan-2200-{size}-{color}-Unisex-CF',
  //     'supplier_id' => 1,
  //     'cost' => 14.99,
  //     'msrp' => 21.99,
  //     'image_width' => 3300,
  //     'image_height' => 4800,
  //     'image_ratio' => 0.69,
  //     'other' => json_encode([
  //       'requireProperties'=>[
  //         [
  //           'name'=>'size',
  //           'options'=>[
  //             's'=>'S',
  //             'm'=>'M',
  //             'l'=>'L',
  //             'xl'=>'XL',
  //             '2xl'=>'2XL',
  //             '3xl'=>'3XL',
  //           ]
  //         ],
  //         [
  //           'name'=>'color',
  //           'options'=>[
  //             'white'=>'White',
  //             'black'=>'Black',
  //           ]
  //         ]
  //       ]
  //     ]),
  //   ]);
  //   DB::table('production_details')->insert([
  //     'product_code' => 'canvas-blkwrp-8x8',
  //     'supplier_product_code' => 'CanvsWrp-BlkWrp-8x8',
  //     'supplier_id' => 1,
  //     'cost' => 15.99,
  //     'msrp' => 31.99,
  //     'image_width' => 2400,
  //     'image_height' => 2400,
  //     'image_ratio' => 1,
  //   ]);
  //   DB::table('production_details')->insert([
  //     'product_code' => 'canvas-blkwrp-12x12',
  //     'supplier_product_code' => 'CanvsWrp-BlkWrp-12x12',
  //     'supplier_id' => 1,
  //
  //     'msrp' => 38.99,
  //     'cost' => 22.99,
  //     'image_width' => 3600,
  //     'image_height' => 3600,
  //     'image_ratio' => 1,
  //   ]);
  //   DB::table('production_details')->insert([
  //     'product_code' => 'canvas-blkwrp-16x16',
  //     'supplier_product_code' => 'CanvsWrp-BlkWrp-16x16',
  //     'supplier_id' => 1,
  //
  //     'msrp' => 45.99,
  //     'cost' => 30.99,
  //     'image_width' => 4800,
  //     'image_height' => 4800,
  //     'image_ratio' => 1,
  //   ]);
  //   DB::table('production_details')->insert([
  //     'product_code' => 'throw-pillow-sewn-18x18',
  //     'supplier_product_code' => 'ThrowPillow_Sewn_18x18',
  //     'supplier_id' => 1,
  //
  //     'msrp' => 32.99,
  //     'cost' => 16.99,
  //     'image_width' => 3442,
  //     'image_height' => 3481,
  //     'image_ratio' => 0.99,
  //   ]);
  //
  //   DB::table('production_details')->insert([
  //     'product_code' => 'throw-pillow-sewn-20x14',
  //     'supplier_product_code' => 'ThrowPillow_Sewn_20x24',
  //     'supplier_id' => 1,
  //
  //     'msrp' => 34.99,
  //     'cost' => 17.99,
  //     'image_width' => 3917,
  //     'image_height' => 2745,
  //     'image_ratio' => 1.43,
  //   ]);
  }
}
