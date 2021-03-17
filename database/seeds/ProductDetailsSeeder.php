<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ProductDetailsSeeder extends Seeder
{
  /**
  * Run the database seeds.
  *
  * @return void
  */
  public function run()
  {
    DB::table('product_details')->insert([
      'product_code' => 'champion-hoodie-s700',
      'current_supplier_id' => 3,
      'category_id' => 7,
      'optional_orientation' => json_encode(['square','landscape']),
      'title' => 'Champion hoodie',
      'description' => 'Comfortable, casual and semi fitted, this unisex T-shirt wears well on anyone and will easily become a closet staple. Made from 100% cotton, it wears well on anyone.',
      'html_description' => '<ul><li> Brand - Anvil </li><li> Model - 980 </li><li> Style- Semi-Fitted Unisex T shirt </li><li> Color- White </li><li> Comfortable 100% cotton, Oeko-Tex® Standard 100 Certified </li><li> Machine wash cold, tumble dry low </li></ul>',
      'html_shipping' => '<ul><li> Production Time- Up to 3-4 days </li><li> Est. Domestic Arriva-l Up to 7 days </li><li> Est. International Arrival- Up to 7 - 35 days </li><li> Please review our ‘’Shipping & Returns Policy’’ for further information </li></ul>',
      'html_sizes' => '<ul><li> S –  Chest: 27.5’’, Length 18’’ </li><li> M –  Chest: 28.75’’, Length 20’’ </li><li> L –  Chest: 29.75’’, Length 22’’ </li><li> XL–  Chest: 30.75’’, Length 24’’ </li><li> 2XL – Chest: 32’’, Length 26’’ </li><li> 3XL – Chest: 33’’, Length 28’’ </li></ul>',
      'image_width' => 3300,
      'image_height' => 2347,
      'image_ratio' => 1.4,
      'size' => 'S-3XL',
    ]);
    DB::table('product_details')->insert([
      'product_code' => 'lane-seven-4001',
      'current_supplier_id' => 3,
      'category_id' => 7,
      'optional_orientation' => json_encode(['square','landscape']),
      'title' => 'Lane seven 4001',
      'description' => 'Comfortable, casual and semi fitted, this unisex T-shirt wears well on anyone and will easily become a closet staple. Made from 100% cotton, it wears well on anyone.',
      'html_description' => '<ul><li> Brand - Anvil </li><li> Model - 980 </li><li> Style- Semi-Fitted Unisex T shirt </li><li> Color- White </li><li> Comfortable 100% cotton, Oeko-Tex® Standard 100 Certified </li><li> Machine wash cold, tumble dry low </li></ul>',
      'html_shipping' => '<ul><li> Production Time- Up to 3-4 days </li><li> Est. Domestic Arriva-l Up to 7 days </li><li> Est. International Arrival- Up to 7 - 35 days </li><li> Please review our ‘’Shipping & Returns Policy’’ for further information </li></ul>',
      'html_sizes' => '<ul><li> S –  Chest: 27.5’’, Length 18’’ </li><li> M –  Chest: 28.75’’, Length 20’’ </li><li> L –  Chest: 29.75’’, Length 22’’ </li><li> XL–  Chest: 30.75’’, Length 24’’ </li><li> 2XL – Chest: 32’’, Length 26’’ </li><li> 3XL – Chest: 33’’, Length 28’’ </li></ul>',
      'image_width' => 3500,
      'image_height' => 3000,
      'image_ratio' => 1.4,
      'size' => 'S-3XL',
    ]);
    DB::table('product_details')->insert([
      'product_code' => 'gildan-18500b',
      'current_supplier_id' => 3,
      'category_id' => 7,
      'optional_orientation' => json_encode(['square','landscape']),
      'title' => 'Kids - Gildan 18500B',
      'description' => 'Comfortable, casual and semi fitted, this unisex T-shirt wears well on anyone and will easily become a closet staple. Made from 100% cotton, it wears well on anyone.',
      'html_description' => '<ul><li> Brand - Anvil </li><li> Model - 980 </li><li> Style- Semi-Fitted Unisex T shirt </li><li> Color- White </li><li> Comfortable 100% cotton, Oeko-Tex® Standard 100 Certified </li><li> Machine wash cold, tumble dry low </li></ul>',
      'html_shipping' => '<ul><li> Production Time- Up to 3-4 days </li><li> Est. Domestic Arriva-l Up to 7 days </li><li> Est. International Arrival- Up to 7 - 35 days </li><li> Please review our ‘’Shipping & Returns Policy’’ for further information </li></ul>',
      'html_sizes' => '<ul><li> S –  Chest: 27.5’’, Length 18’’ </li><li> M –  Chest: 28.75’’, Length 20’’ </li><li> L –  Chest: 29.75’’, Length 22’’ </li><li> XL–  Chest: 30.75’’, Length 24’’ </li><li> 2XL – Chest: 32’’, Length 26’’ </li><li> 3XL – Chest: 33’’, Length 28’’ </li></ul>',
      'image_width' => 2700,
      'image_height' => 1800,
      'image_ratio' => 1.5,
      'size' => 'S-3XL',
    ]);
    DB::table('product_details')->insert([
      'product_code' => 'champion-s600',
      'current_supplier_id' => 3,
      'category_id' => 6,
      'optional_orientation' => json_encode(['square','landscape','portrait']),
      'title' => 'Champion s600',
      'description' => 'Comfortable, casual and semi fitted, this unisex T-shirt wears well on anyone and will easily become a closet staple. Made from 100% cotton, it wears well on anyone.',
      'html_description' => '<ul><li> Brand - Anvil </li><li> Model - 980 </li><li> Style- Semi-Fitted Unisex T shirt </li><li> Color- White </li><li> Comfortable 100% cotton, Oeko-Tex® Standard 100 Certified </li><li> Machine wash cold, tumble dry low </li></ul>',
      'html_shipping' => '<ul><li> Production Time- Up to 3-4 days </li><li> Est. Domestic Arriva-l Up to 7 days </li><li> Est. International Arrival- Up to 7 - 35 days </li><li> Please review our ‘’Shipping & Returns Policy’’ for further information </li></ul>',
      'html_sizes' => '<ul><li> S –  Chest: 27.5’’, Length 18’’ </li><li> M –  Chest: 28.75’’, Length 20’’ </li><li> L –  Chest: 29.75’’, Length 22’’ </li><li> XL–  Chest: 30.75’’, Length 24’’ </li><li> 2XL – Chest: 32’’, Length 26’’ </li><li> 3XL – Chest: 33’’, Length 28’’ </li></ul>',
      'image_width' => 4200,
      'image_height' => 5100,
      'image_ratio' => 0.823,
      'size' => 'S-3XL',
    ]);
    DB::table('product_details')->insert([
      'product_code' => 'bella-canvas-ls14004',
      'current_supplier_id' => 3,
      'category_id' => 6,
      'optional_orientation' => json_encode(['square','landscape','portrait']),
      'title' => 'Bella canvas LS14004',
      'description' => 'Comfortable, casual and semi fitted, this unisex T-shirt wears well on anyone and will easily become a closet staple. Made from 100% cotton, it wears well on anyone.',
      'html_description' => '<ul><li> Brand - Anvil </li><li> Model - 980 </li><li> Style- Semi-Fitted Unisex T shirt </li><li> Color- White </li><li> Comfortable 100% cotton, Oeko-Tex® Standard 100 Certified </li><li> Machine wash cold, tumble dry low </li></ul>',
      'html_shipping' => '<ul><li> Production Time- Up to 3-4 days </li><li> Est. Domestic Arriva-l Up to 7 days </li><li> Est. International Arrival- Up to 7 - 35 days </li><li> Please review our ‘’Shipping & Returns Policy’’ for further information </li></ul>',
      'html_sizes' => '<ul><li> S –  Chest: 27.5’’, Length 18’’ </li><li> M –  Chest: 28.75’’, Length 20’’ </li><li> L –  Chest: 29.75’’, Length 22’’ </li><li> XL–  Chest: 30.75’’, Length 24’’ </li><li> 2XL – Chest: 32’’, Length 26’’ </li><li> 3XL – Chest: 33’’, Length 28’’ </li></ul>',
      'image_width' => 3600,
      'image_height' => 4800,
      'image_ratio' => 0.75,
      'size' => 'S-3XL',
    ]);
    DB::table('product_details')->insert([
      'product_code' => 'gildan-18000b',
      'current_supplier_id' => 2,
      'category_id' => 6,
      'optional_orientation' => json_encode(['square','landscape','portrait']),
      'title' => 'Kids - Gildan18000B',
      'description' => 'Comfortable, casual and semi fitted, this unisex T-shirt wears well on anyone and will easily become a closet staple. Made from 100% cotton, it wears well on anyone.',
      'html_description' => '<ul><li> Brand - Anvil </li><li> Model - 980 </li><li> Style- Semi-Fitted Unisex T shirt </li><li> Color- White </li><li> Comfortable 100% cotton, Oeko-Tex® Standard 100 Certified </li><li> Machine wash cold, tumble dry low </li></ul>',
      'html_shipping' => '<ul><li> Production Time- Up to 3-4 days </li><li> Est. Domestic Arriva-l Up to 7 days </li><li> Est. International Arrival- Up to 7 - 35 days </li><li> Please review our ‘’Shipping & Returns Policy’’ for further information </li></ul>',
      'html_sizes' => '<ul><li> S –  Chest: 27.5’’, Length 18’’ </li><li> M –  Chest: 28.75’’, Length 20’’ </li><li> L –  Chest: 29.75’’, Length 22’’ </li><li> XL–  Chest: 30.75’’, Length 24’’ </li><li> 2XL – Chest: 32’’, Length 26’’ </li><li> 3XL – Chest: 33’’, Length 28’’ </li></ul>',
      'image_width' => 3600,
      'image_height' => 4800,
      'image_ratio' => 0.75,
      'size' => 'S-3XL',
    ]);
    DB::table('product_details')->insert([
      'product_code' => 'champion-t-shirt',
      'current_supplier_id' => 3,
      'category_id' => 5,
      'optional_orientation' => json_encode(['square','landscape','portrait']),
      'title' => 'Champion T-shirt',
      'description' => 'Comfortable, casual and semi fitted, this unisex T-shirt wears well on anyone and will easily become a closet staple. Made from 100% cotton, it wears well on anyone.',
      'html_description' => '<ul><li> Brand - Anvil </li><li> Model - 980 </li><li> Style- Semi-Fitted Unisex T shirt </li><li> Color- White </li><li> Comfortable 100% cotton, Oeko-Tex® Standard 100 Certified </li><li> Machine wash cold, tumble dry low </li></ul>',
      'html_shipping' => '<ul><li> Production Time- Up to 3-4 days </li><li> Est. Domestic Arriva-l Up to 7 days </li><li> Est. International Arrival- Up to 7 - 35 days </li><li> Please review our ‘’Shipping & Returns Policy’’ for further information </li></ul>',
      'html_sizes' => '<ul><li> S –  Chest: 27.5’’, Length 18’’ </li><li> M –  Chest: 28.75’’, Length 20’’ </li><li> L –  Chest: 29.75’’, Length 22’’ </li><li> XL–  Chest: 30.75’’, Length 24’’ </li><li> 2XL – Chest: 32’’, Length 26’’ </li><li> 3XL – Chest: 33’’, Length 28’’ </li></ul>',
      'image_width' => 3600,
      'image_height' => 4800,
      'image_ratio' => 0.75,
      'size' => 'S-3XL',
    ]);
    DB::table('product_details')->insert([
      'product_code' => 'gildan-500',
      'current_supplier_id' => 3,
      'category_id' => 5,
      'optional_orientation' => json_encode(['square','landscape','portrait']),
      'title' => 'Gildan 5000',
      'description' => 'Comfortable, casual and semi fitted, this unisex T-shirt wears well on anyone and will easily become a closet staple. Made from 100% cotton, it wears well on anyone.',
      'html_description' => '<ul><li> Brand - Anvil </li><li> Model - 980 </li><li> Style- Semi-Fitted Unisex T shirt </li><li> Color- White </li><li> Comfortable 100% cotton, Oeko-Tex® Standard 100 Certified </li><li> Machine wash cold, tumble dry low </li></ul>',
      'html_shipping' => '<ul><li> Production Time- Up to 3-4 days </li><li> Est. Domestic Arriva-l Up to 7 days </li><li> Est. International Arrival- Up to 7 - 35 days </li><li> Please review our ‘’Shipping & Returns Policy’’ for further information </li></ul>',
      'html_sizes' => '<ul><li> S –  Chest: 27.5’’, Length 18’’ </li><li> M –  Chest: 28.75’’, Length 20’’ </li><li> L –  Chest: 29.75’’, Length 22’’ </li><li> XL–  Chest: 30.75’’, Length 24’’ </li><li> 2XL – Chest: 32’’, Length 26’’ </li><li> 3XL – Chest: 33’’, Length 28’’ </li></ul>',
      'image_width' => 3600,
      'image_height' => 4500,
      'image_ratio' => 0.75,
      'size' => 'S-3XL',
    ]);
    DB::table('product_details')->insert([
      'product_code' => 'gildan-500-kids',
      'current_supplier_id' => 3,
      'category_id' => 5,
      'optional_orientation' => json_encode(['square','landscape','portrait']),
      'title' => 'Gildan 500B',
      'description' => 'Comfortable, casual and semi fitted, this unisex T-shirt wears well on anyone and will easily become a closet staple. Made from 100% cotton, it wears well on anyone.',
      'html_description' => '<ul><li> Brand - Anvil </li><li> Model - 980 </li><li> Style- Semi-Fitted Unisex T shirt </li><li> Color- White </li><li> Comfortable 100% cotton, Oeko-Tex® Standard 100 Certified </li><li> Machine wash cold, tumble dry low </li></ul>',
      'html_shipping' => '<ul><li> Production Time- Up to 3-4 days </li><li> Est. Domestic Arriva-l Up to 7 days </li><li> Est. International Arrival- Up to 7 - 35 days </li><li> Please review our ‘’Shipping & Returns Policy’’ for further information </li></ul>',
      'html_sizes' => '<ul><li> S –  Chest: 27.5’’, Length 18’’ </li><li> M –  Chest: 28.75’’, Length 20’’ </li><li> L –  Chest: 29.75’’, Length 22’’ </li><li> XL–  Chest: 30.75’’, Length 24’’ </li><li> 2XL – Chest: 32’’, Length 26’’ </li><li> 3XL – Chest: 33’’, Length 28’’ </li></ul>',
      'image_width' => 2700,
      'image_height' => 3300,
      'image_ratio' => 0.75,
      'size' => 'S-3XL',
    ]);
    DB::table('product_details')->insert([
      'product_code' => 'face-mask-zuni-s0001',
      'current_supplier_id' => 3,
      'category_id' => 4,
      'optional_orientation' => json_encode(['landscape']),
      'title' => 'Zuni - Face Mask - Black One size',
      'description' => 'Comfortable, casual and semi fitted, this unisex T-shirt wears well on anyone and will easily become a closet staple. Made from 100% cotton, it wears well on anyone.',
      'html_description' => '<ul><li> Brand - Anvil </li><li> Model - 980 </li><li> Style- Semi-Fitted Unisex T shirt </li><li> Color- White </li><li> Comfortable 100% cotton, Oeko-Tex® Standard 100 Certified </li><li> Machine wash cold, tumble dry low </li></ul>',
      'html_shipping' => '<ul><li> Production Time- Up to 3-4 days </li><li> Est. Domestic Arriva-l Up to 7 days </li><li> Est. International Arrival- Up to 7 - 35 days </li><li> Please review our ‘’Shipping & Returns Policy’’ for further information </li></ul>',
      'html_sizes' => '<ul><li> S –  Chest: 27.5’’, Length 18’’ </li><li> M –  Chest: 28.75’’, Length 20’’ </li><li> L –  Chest: 29.75’’, Length 22’’ </li><li> XL–  Chest: 30.75’’, Length 24’’ </li><li> 2XL – Chest: 32’’, Length 26’’ </li><li> 3XL – Chest: 33’’, Length 28’’ </li></ul>',
      'image_width' => 1800,
      'image_height' => 1200,
      'image_ratio' => 1.5,
      'size' => 'S-3XL',
    ]);
    // DB::table('product_details')->insert([
    //   'product_code' => 'face-mask-2-layers',
    //   'current_supplier_id' => 2,
    //   'category_id' => 4,
    //   'optional_orientation' => json_encode(['landscape']),
    //   'title' => 'Face mask 2 layers',
    //   'description' => 'Comfortable, casual and semi fitted, this unisex T-shirt wears well on anyone and will easily become a closet staple. Made from 100% cotton, it wears well on anyone.',
    //   'html_description' => '<ul><li> Brand - Anvil </li><li> Model - 980 </li><li> Style- Semi-Fitted Unisex T shirt </li><li> Color- White </li><li> Comfortable 100% cotton, Oeko-Tex® Standard 100 Certified </li><li> Machine wash cold, tumble dry low </li></ul>',
    //   'html_shipping' => '<ul><li> Production Time- Up to 3-4 days </li><li> Est. Domestic Arriva-l Up to 7 days </li><li> Est. International Arrival- Up to 7 - 35 days </li><li> Please review our ‘’Shipping & Returns Policy’’ for further information </li></ul>',
    //   'html_sizes' => '<ul><li> S –  Chest: 27.5’’, Length 18’’ </li><li> M –  Chest: 28.75’’, Length 20’’ </li><li> L –  Chest: 29.75’’, Length 22’’ </li><li> XL–  Chest: 30.75’’, Length 24’’ </li><li> 2XL – Chest: 32’’, Length 26’’ </li><li> 3XL – Chest: 33’’, Length 28’’ </li></ul>',
    //   'image_width' => 1189,
    //   'image_height' => 814,
    //   'image_ratio' => 1.41,
    //   'size' => 'S-3XL',
    // ]);
    // DB::table('product_details')->insert([
    //   'product_code' => 'face-mask-3-layers',
    //   'current_supplier_id' => 2,
    //   'category_id' => 4,
    //   'optional_orientation' => json_encode(['landscape']),
    //   'title' => 'Face mask 3 layers',
    //   'description' => 'Comfortable, casual and semi fitted, this unisex T-shirt wears well on anyone and will easily become a closet staple. Made from 100% cotton, it wears well on anyone.',
    //   'html_description' => '<ul><li> Brand - Anvil </li><li> Model - 980 </li><li> Style- Semi-Fitted Unisex T shirt </li><li> Color- White </li><li> Comfortable 100% cotton, Oeko-Tex® Standard 100 Certified </li><li> Machine wash cold, tumble dry low </li></ul>',
    //   'html_shipping' => '<ul><li> Production Time- Up to 3-4 days </li><li> Est. Domestic Arriva-l Up to 7 days </li><li> Est. International Arrival- Up to 7 - 35 days </li><li> Please review our ‘’Shipping & Returns Policy’’ for further information </li></ul>',
    //   'html_sizes' => '<ul><li> S –  Chest: 27.5’’, Length 18’’ </li><li> M –  Chest: 28.75’’, Length 20’’ </li><li> L –  Chest: 29.75’’, Length 22’’ </li><li> XL–  Chest: 30.75’’, Length 24’’ </li><li> 2XL – Chest: 32’’, Length 26’’ </li><li> 3XL – Chest: 33’’, Length 28’’ </li></ul>',
    //   'image_width' => 1189,
    //   'image_height' => 814,
    //   'image_ratio' => 1.41,
    //   'size' => 'S-3XL',
    // ]);
    DB::table('product_details')->insert([
      'product_code' => 'aop-tote-bag',
      'current_supplier_id' => 4,
      'category_id' => 3,
      'optional_orientation' => json_encode(['square']),
      'title' => 'AOP Tote Bag',
      'description' => 'Comfortable, casual and semi fitted, this unisex T-shirt wears well on anyone and will easily become a closet staple. Made from 100% cotton, it wears well on anyone.',
      'html_description' => '<ul><li> Brand - Anvil </li><li> Model - 980 </li><li> Style- Semi-Fitted Unisex T shirt </li><li> Color- White </li><li> Comfortable 100% cotton, Oeko-Tex® Standard 100 Certified </li><li> Machine wash cold, tumble dry low </li></ul>',
      'html_shipping' => '<ul><li> Production Time- Up to 3-4 days </li><li> Est. Domestic Arriva-l Up to 7 days </li><li> Est. International Arrival- Up to 7 - 35 days </li><li> Please review our ‘’Shipping & Returns Policy’’ for further information </li></ul>',
      'html_sizes' => '<ul><li> S –  Chest: 27.5’’, Length 18’’ </li><li> M –  Chest: 28.75’’, Length 20’’ </li><li> L –  Chest: 29.75’’, Length 22’’ </li><li> XL–  Chest: 30.75’’, Length 24’’ </li><li> 2XL – Chest: 32’’, Length 26’’ </li><li> 3XL – Chest: 33’’, Length 28’’ </li></ul>',
      'image_width' => 2925,
      'image_height' => 2925,
      'image_ratio' => 1,
      'size' => 'S-3XL',
    ]);
    DB::table('product_details')->insert([
      'product_code' => 'draw-string-bag',
      'current_supplier_id' => 4,
      'category_id' => 3,
      'optional_orientation' => json_encode(['square']),
      'title' => 'Draw string bag',
      'description' => 'Comfortable, casual and semi fitted, this unisex T-shirt wears well on anyone and will easily become a closet staple. Made from 100% cotton, it wears well on anyone.',
      'html_description' => '<ul><li> Brand - Anvil </li><li> Model - 980 </li><li> Style- Semi-Fitted Unisex T shirt </li><li> Color- White </li><li> Comfortable 100% cotton, Oeko-Tex® Standard 100 Certified </li><li> Machine wash cold, tumble dry low </li></ul>',
      'html_shipping' => '<ul><li> Production Time- Up to 3-4 days </li><li> Est. Domestic Arriva-l Up to 7 days </li><li> Est. International Arrival- Up to 7 - 35 days </li><li> Please review our ‘’Shipping & Returns Policy’’ for further information </li></ul>',
      'html_sizes' => '<ul><li> S –  Chest: 27.5’’, Length 18’’ </li><li> M –  Chest: 28.75’’, Length 20’’ </li><li> L –  Chest: 29.75’’, Length 22’’ </li><li> XL–  Chest: 30.75’’, Length 24’’ </li><li> 2XL – Chest: 32’’, Length 26’’ </li><li> 3XL – Chest: 33’’, Length 28’’ </li></ul>',
      'image_width' => 4950,
      'image_height' => 4950,
      'image_ratio' => 1,
      'size' => 'S-3XL',
    ]);
    DB::table('product_details')->insert([
      'product_code' => 'posters-36-24',
      'current_supplier_id' => 1,
      'category_id' => 9,
      'optional_orientation' => json_encode(['landscape']),
      'title' => 'Premium posters 36x24',
      'description' => 'Comfortable, casual and semi fitted, this unisex T-shirt wears well on anyone and will easily become a closet staple. Made from 100% cotton, it wears well on anyone.',
      'html_description' => '<ul><li> Brand - Anvil </li><li> Model - 980 </li><li> Style- Semi-Fitted Unisex T shirt </li><li> Color- White </li><li> Comfortable 100% cotton, Oeko-Tex® Standard 100 Certified </li><li> Machine wash cold, tumble dry low </li></ul>',
      'html_shipping' => '<ul><li> Production Time- Up to 3-4 days </li><li> Est. Domestic Arriva-l Up to 7 days </li><li> Est. International Arrival- Up to 7 - 35 days </li><li> Please review our ‘’Shipping & Returns Policy’’ for further information </li></ul>',
      'html_sizes' => '<ul><li> S –  Chest: 27.5’’, Length 18’’ </li><li> M –  Chest: 28.75’’, Length 20’’ </li><li> L –  Chest: 29.75’’, Length 22’’ </li><li> XL–  Chest: 30.75’’, Length 24’’ </li><li> 2XL – Chest: 32’’, Length 26’’ </li><li> 3XL – Chest: 33’’, Length 28’’ </li></ul>',
      'image_width' => 4500,
      'image_height' => 3000,
      'image_ratio' => 1.5,
      'size' => '36x24',
    ]);
    DB::table('product_details')->insert([
      'product_code' => 'posters-48-32',
      'current_supplier_id' => 1,
      'category_id' => 9,
      'optional_orientation' => json_encode(['landscape']),
      'title' => 'Premium posters 48x32',
      'description' => 'Comfortable, casual and semi fitted, this unisex T-shirt wears well on anyone and will easily become a closet staple. Made from 100% cotton, it wears well on anyone.',
      'html_description' => '<ul><li> Brand - Anvil </li><li> Model - 980 </li><li> Style- Semi-Fitted Unisex T shirt </li><li> Color- White </li><li> Comfortable 100% cotton, Oeko-Tex® Standard 100 Certified </li><li> Machine wash cold, tumble dry low </li></ul>',
      'html_shipping' => '<ul><li> Production Time- Up to 3-4 days </li><li> Est. Domestic Arriva-l Up to 7 days </li><li> Est. International Arrival- Up to 7 - 35 days </li><li> Please review our ‘’Shipping & Returns Policy’’ for further information </li></ul>',
      'html_sizes' => '<ul><li> S –  Chest: 27.5’’, Length 18’’ </li><li> M –  Chest: 28.75’’, Length 20’’ </li><li> L –  Chest: 29.75’’, Length 22’’ </li><li> XL–  Chest: 30.75’’, Length 24’’ </li><li> 2XL – Chest: 32’’, Length 26’’ </li><li> 3XL – Chest: 33’’, Length 28’’ </li></ul>',
      'image_width' => 4500,
      'image_height' => 3000,
      'image_ratio' => 1.5,
      'size' => '48x32',
    ]);
    DB::table('product_details')->insert([
      'product_code' => 'posters-24-36',
      'current_supplier_id' => 1,
      'category_id' => 9,
      'optional_orientation' => json_encode(['portrait']),
      'title' => 'Premium posters 24x36',
      'description' => 'Comfortable, casual and semi fitted, this unisex T-shirt wears well on anyone and will easily become a closet staple. Made from 100% cotton, it wears well on anyone.',
      'html_description' => '<ul><li> Brand - Anvil </li><li> Model - 980 </li><li> Style- Semi-Fitted Unisex T shirt </li><li> Color- White </li><li> Comfortable 100% cotton, Oeko-Tex® Standard 100 Certified </li><li> Machine wash cold, tumble dry low </li></ul>',
      'html_shipping' => '<ul><li> Production Time- Up to 3-4 days </li><li> Est. Domestic Arriva-l Up to 7 days </li><li> Est. International Arrival- Up to 7 - 35 days </li><li> Please review our ‘’Shipping & Returns Policy’’ for further information </li></ul>',
      'html_sizes' => '<ul><li> S –  Chest: 27.5’’, Length 18’’ </li><li> M –  Chest: 28.75’’, Length 20’’ </li><li> L –  Chest: 29.75’’, Length 22’’ </li><li> XL–  Chest: 30.75’’, Length 24’’ </li><li> 2XL – Chest: 32’’, Length 26’’ </li><li> 3XL – Chest: 33’’, Length 28’’ </li></ul>',
      'image_width' => 3000,
      'image_height' => 4500,
      'image_ratio' => 0.66,
      'size' => '24x36',
    ]);
    DB::table('product_details')->insert([
      'product_code' => 'posters-32-48',
      'current_supplier_id' => 1,
      'category_id' => 9,
      'optional_orientation' => json_encode(['portrait']),
      'title' => 'Premium posters 32x48',
      'description' => 'Comfortable, casual and semi fitted, this unisex T-shirt wears well on anyone and will easily become a closet staple. Made from 100% cotton, it wears well on anyone.',
      'html_description' => '<ul><li> Brand - Anvil </li><li> Model - 980 </li><li> Style- Semi-Fitted Unisex T shirt </li><li> Color- White </li><li> Comfortable 100% cotton, Oeko-Tex® Standard 100 Certified </li><li> Machine wash cold, tumble dry low </li></ul>',
      'html_shipping' => '<ul><li> Production Time- Up to 3-4 days </li><li> Est. Domestic Arriva-l Up to 7 days </li><li> Est. International Arrival- Up to 7 - 35 days </li><li> Please review our ‘’Shipping & Returns Policy’’ for further information </li></ul>',
      'html_sizes' => '<ul><li> S –  Chest: 27.5’’, Length 18’’ </li><li> M –  Chest: 28.75’’, Length 20’’ </li><li> L –  Chest: 29.75’’, Length 22’’ </li><li> XL–  Chest: 30.75’’, Length 24’’ </li><li> 2XL – Chest: 32’’, Length 26’’ </li><li> 3XL – Chest: 33’’, Length 28’’ </li></ul>',
      'image_width' => 3000,
      'image_height' => 4500,
      'image_ratio' => 0.66,
      'size' => '32x48',
    ]);
    DB::table('product_details')->insert([
      'product_code' => 'canvas-18-12',
      'current_supplier_id' => 1,
      'category_id' => 8,
      'optional_orientation' => json_encode(['landscape']),
      'title' => 'Canvas 18x12',
      'description' => 'Comfortable, casual and semi fitted, this unisex T-shirt wears well on anyone and will easily become a closet staple. Made from 100% cotton, it wears well on anyone.',
      'html_description' => '<ul><li> Brand - Anvil </li><li> Model - 980 </li><li> Style- Semi-Fitted Unisex T shirt </li><li> Color- White </li><li> Comfortable 100% cotton, Oeko-Tex® Standard 100 Certified </li><li> Machine wash cold, tumble dry low </li></ul>',
      'html_shipping' => '<ul><li> Production Time- Up to 3-4 days </li><li> Est. Domestic Arriva-l Up to 7 days </li><li> Est. International Arrival- Up to 7 - 35 days </li><li> Please review our ‘’Shipping & Returns Policy’’ for further information </li></ul>',
      'html_sizes' => '<ul><li> S –  Chest: 27.5’’, Length 18’’ </li><li> M –  Chest: 28.75’’, Length 20’’ </li><li> L –  Chest: 29.75’’, Length 22’’ </li><li> XL–  Chest: 30.75’’, Length 24’’ </li><li> 2XL – Chest: 32’’, Length 26’’ </li><li> 3XL – Chest: 33’’, Length 28’’ </li></ul>',
      'image_width' => 4500,
      'image_height' => 3000,
      'image_ratio' => 1.5,
      'size' => '18x12',
    ]);
    DB::table('product_details')->insert([
      'product_code' => 'canvas-30-20',
      'current_supplier_id' => 1,
      'category_id' => 8,
      'optional_orientation' => json_encode(['landscape']),
      'title' => 'Canvas 30x20',
      'description' => 'Comfortable, casual and semi fitted, this unisex T-shirt wears well on anyone and will easily become a closet staple. Made from 100% cotton, it wears well on anyone.',
      'html_description' => '<ul><li> Brand - Anvil </li><li> Model - 980 </li><li> Style- Semi-Fitted Unisex T shirt </li><li> Color- White </li><li> Comfortable 100% cotton, Oeko-Tex® Standard 100 Certified </li><li> Machine wash cold, tumble dry low </li></ul>',
      'html_shipping' => '<ul><li> Production Time- Up to 3-4 days </li><li> Est. Domestic Arriva-l Up to 7 days </li><li> Est. International Arrival- Up to 7 - 35 days </li><li> Please review our ‘’Shipping & Returns Policy’’ for further information </li></ul>',
      'html_sizes' => '<ul><li> S –  Chest: 27.5’’, Length 18’’ </li><li> M –  Chest: 28.75’’, Length 20’’ </li><li> L –  Chest: 29.75’’, Length 22’’ </li><li> XL–  Chest: 30.75’’, Length 24’’ </li><li> 2XL – Chest: 32’’, Length 26’’ </li><li> 3XL – Chest: 33’’, Length 28’’ </li></ul>',
      'image_width' => 4500,
      'image_height' => 3000,
      'image_ratio' => 1.5,
      'size' => '30x20',
    ]);
    DB::table('product_details')->insert([
      'product_code' => 'canvas-36-24',
      'current_supplier_id' => 1,
      'category_id' => 8,
      'optional_orientation' => json_encode(['landscape']),
      'title' => 'Canvas 36x24',
      'description' => 'Comfortable, casual and semi fitted, this unisex T-shirt wears well on anyone and will easily become a closet staple. Made from 100% cotton, it wears well on anyone.',
      'html_description' => '<ul><li> Brand - Anvil </li><li> Model - 980 </li><li> Style- Semi-Fitted Unisex T shirt </li><li> Color- White </li><li> Comfortable 100% cotton, Oeko-Tex® Standard 100 Certified </li><li> Machine wash cold, tumble dry low </li></ul>',
      'html_shipping' => '<ul><li> Production Time- Up to 3-4 days </li><li> Est. Domestic Arriva-l Up to 7 days </li><li> Est. International Arrival- Up to 7 - 35 days </li><li> Please review our ‘’Shipping & Returns Policy’’ for further information </li></ul>',
      'html_sizes' => '<ul><li> S –  Chest: 27.5’’, Length 18’’ </li><li> M –  Chest: 28.75’’, Length 20’’ </li><li> L –  Chest: 29.75’’, Length 22’’ </li><li> XL–  Chest: 30.75’’, Length 24’’ </li><li> 2XL – Chest: 32’’, Length 26’’ </li><li> 3XL – Chest: 33’’, Length 28’’ </li></ul>',
      'image_width' => 4500,
      'image_height' => 3000,
      'image_ratio' => 1.5,
      'size' => '36x24',
    ]);
    DB::table('product_details')->insert([
      'product_code' => 'canvas-12-18',
      'current_supplier_id' => 1,
      'category_id' => 8,
      'optional_orientation' => json_encode(['portrait']),
      'title' => 'Canvas 12x18',
      'description' => 'Comfortable, casual and semi fitted, this unisex T-shirt wears well on anyone and will easily become a closet staple. Made from 100% cotton, it wears well on anyone.',
      'html_description' => '<ul><li> Brand - Anvil </li><li> Model - 980 </li><li> Style- Semi-Fitted Unisex T shirt </li><li> Color- White </li><li> Comfortable 100% cotton, Oeko-Tex® Standard 100 Certified </li><li> Machine wash cold, tumble dry low </li></ul>',
      'html_shipping' => '<ul><li> Production Time- Up to 3-4 days </li><li> Est. Domestic Arriva-l Up to 7 days </li><li> Est. International Arrival- Up to 7 - 35 days </li><li> Please review our ‘’Shipping & Returns Policy’’ for further information </li></ul>',
      'html_sizes' => '<ul><li> S –  Chest: 27.5’’, Length 18’’ </li><li> M –  Chest: 28.75’’, Length 20’’ </li><li> L –  Chest: 29.75’’, Length 22’’ </li><li> XL–  Chest: 30.75’’, Length 24’’ </li><li> 2XL – Chest: 32’’, Length 26’’ </li><li> 3XL – Chest: 33’’, Length 28’’ </li></ul>',
      'image_width' => 3000,
      'image_height' => 4500,
      'image_ratio' => 0.66,
      'size' => '12x18',
    ]);
    DB::table('product_details')->insert([
      'product_code' => 'canvas-20-30',
      'current_supplier_id' => 1,
      'category_id' => 8,
      'optional_orientation' => json_encode(['portrait']),
      'title' => 'Canvas 20x30',
      'description' => 'Comfortable, casual and semi fitted, this unisex T-shirt wears well on anyone and will easily become a closet staple. Made from 100% cotton, it wears well on anyone.',
      'html_description' => '<ul><li> Brand - Anvil </li><li> Model - 980 </li><li> Style- Semi-Fitted Unisex T shirt </li><li> Color- White </li><li> Comfortable 100% cotton, Oeko-Tex® Standard 100 Certified </li><li> Machine wash cold, tumble dry low </li></ul>',
      'html_shipping' => '<ul><li> Production Time- Up to 3-4 days </li><li> Est. Domestic Arriva-l Up to 7 days </li><li> Est. International Arrival- Up to 7 - 35 days </li><li> Please review our ‘’Shipping & Returns Policy’’ for further information </li></ul>',
      'html_sizes' => '<ul><li> S –  Chest: 27.5’’, Length 18’’ </li><li> M –  Chest: 28.75’’, Length 20’’ </li><li> L –  Chest: 29.75’’, Length 22’’ </li><li> XL–  Chest: 30.75’’, Length 24’’ </li><li> 2XL – Chest: 32’’, Length 26’’ </li><li> 3XL – Chest: 33’’, Length 28’’ </li></ul>',
      'image_width' => 3000,
      'image_height' => 4500,
      'image_ratio' => 0.66,
      'size' => '20x30',
    ]);
    DB::table('product_details')->insert([
      'product_code' => 'canvas-24-36',
      'current_supplier_id' => 1,
      'category_id' => 8,
      'optional_orientation' => json_encode(['portrait']),
      'title' => 'Canvas 24x36',
      'description' => 'Comfortable, casual and semi fitted, this unisex T-shirt wears well on anyone and will easily become a closet staple. Made from 100% cotton, it wears well on anyone.',
      'html_description' => '<ul><li> Brand - Anvil </li><li> Model - 980 </li><li> Style- Semi-Fitted Unisex T shirt </li><li> Color- White </li><li> Comfortable 100% cotton, Oeko-Tex® Standard 100 Certified </li><li> Machine wash cold, tumble dry low </li></ul>',
      'html_shipping' => '<ul><li> Production Time- Up to 3-4 days </li><li> Est. Domestic Arriva-l Up to 7 days </li><li> Est. International Arrival- Up to 7 - 35 days </li><li> Please review our ‘’Shipping & Returns Policy’’ for further information </li></ul>',
      'html_sizes' => '<ul><li> S –  Chest: 27.5’’, Length 18’’ </li><li> M –  Chest: 28.75’’, Length 20’’ </li><li> L –  Chest: 29.75’’, Length 22’’ </li><li> XL–  Chest: 30.75’’, Length 24’’ </li><li> 2XL – Chest: 32’’, Length 26’’ </li><li> 3XL – Chest: 33’’, Length 28’’ </li></ul>',
      'image_width' => 3000,
      'image_height' => 4500,
      'image_ratio' => 0.66,
      'size' => '24x36',
    ]);
    DB::table('product_details')->insert([
      'product_code' => 'canvas-20-20',
      'current_supplier_id' => 1,
      'category_id' => 8,
      'optional_orientation' => json_encode(['square']),
      'title' => 'Canvas 20x20',
      'description' => 'Comfortable, casual and semi fitted, this unisex T-shirt wears well on anyone and will easily become a closet staple. Made from 100% cotton, it wears well on anyone.',
      'html_description' => '<ul><li> Brand - Anvil </li><li> Model - 980 </li><li> Style- Semi-Fitted Unisex T shirt </li><li> Color- White </li><li> Comfortable 100% cotton, Oeko-Tex® Standard 100 Certified </li><li> Machine wash cold, tumble dry low </li></ul>',
      'html_shipping' => '<ul><li> Production Time- Up to 3-4 days </li><li> Est. Domestic Arriva-l Up to 7 days </li><li> Est. International Arrival- Up to 7 - 35 days </li><li> Please review our ‘’Shipping & Returns Policy’’ for further information </li></ul>',
      'html_sizes' => '<ul><li> S –  Chest: 27.5’’, Length 18’’ </li><li> M –  Chest: 28.75’’, Length 20’’ </li><li> L –  Chest: 29.75’’, Length 22’’ </li><li> XL–  Chest: 30.75’’, Length 24’’ </li><li> 2XL – Chest: 32’’, Length 26’’ </li><li> 3XL – Chest: 33’’, Length 28’’ </li></ul>',
      'image_width' => 4500,
      'image_height' => 4500,
      'image_ratio' => 1,
      'size' => '20x20',
    ]);
    DB::table('product_details')->insert([
      'product_code' => 'canvas-12-12',
      'current_supplier_id' => 1,
      'category_id' => 8,
      'optional_orientation' => json_encode(['square']),
      'title' => 'Canvas 12x12',
      'description' => 'Comfortable, casual and semi fitted, this unisex T-shirt wears well on anyone and will easily become a closet staple. Made from 100% cotton, it wears well on anyone.',
      'html_description' => '<ul><li> Brand - Anvil </li><li> Model - 980 </li><li> Style- Semi-Fitted Unisex T shirt </li><li> Color- White </li><li> Comfortable 100% cotton, Oeko-Tex® Standard 100 Certified </li><li> Machine wash cold, tumble dry low </li></ul>',
      'html_shipping' => '<ul><li> Production Time- Up to 3-4 days </li><li> Est. Domestic Arriva-l Up to 7 days </li><li> Est. International Arrival- Up to 7 - 35 days </li><li> Please review our ‘’Shipping & Returns Policy’’ for further information </li></ul>',
      'html_sizes' => '<ul><li> S –  Chest: 27.5’’, Length 18’’ </li><li> M –  Chest: 28.75’’, Length 20’’ </li><li> L –  Chest: 29.75’’, Length 22’’ </li><li> XL–  Chest: 30.75’’, Length 24’’ </li><li> 2XL – Chest: 32’’, Length 26’’ </li><li> 3XL – Chest: 33’’, Length 28’’ </li></ul>',
      'image_width' => 4500,
      'image_height' => 4500,
      'image_ratio' => 1,
      'size' => '12x12',
    ]);
    DB::table('product_details')->insert([
      'product_code' => 'canvas-16-16',
      'current_supplier_id' => 1,
      'category_id' => 8,
      'optional_orientation' => json_encode(['square']),
      'title' => 'Canvas 16x16',
      'description' => 'Comfortable, casual and semi fitted, this unisex T-shirt wears well on anyone and will easily become a closet staple. Made from 100% cotton, it wears well on anyone.',
      'html_description' => '<ul><li> Brand - Anvil </li><li> Model - 980 </li><li> Style- Semi-Fitted Unisex T shirt </li><li> Color- White </li><li> Comfortable 100% cotton, Oeko-Tex® Standard 100 Certified </li><li> Machine wash cold, tumble dry low </li></ul>',
      'html_shipping' => '<ul><li> Production Time- Up to 3-4 days </li><li> Est. Domestic Arriva-l Up to 7 days </li><li> Est. International Arrival- Up to 7 - 35 days </li><li> Please review our ‘’Shipping & Returns Policy’’ for further information </li></ul>',
      'html_sizes' => '<ul><li> S –  Chest: 27.5’’, Length 18’’ </li><li> M –  Chest: 28.75’’, Length 20’’ </li><li> L –  Chest: 29.75’’, Length 22’’ </li><li> XL–  Chest: 30.75’’, Length 24’’ </li><li> 2XL – Chest: 32’’, Length 26’’ </li><li> 3XL – Chest: 33’’, Length 28’’ </li></ul>',
      'image_width' => 4500,
      'image_height' => 4500,
      'image_ratio' => 1,
      'size' => '16x16',
    ]);
    // DB::table('product_details')->insert([
    //   'product_code' => 'throw-pillow-sewn-16x16',
    //   'current_supplier_id' => 1,
    //   'category_id' => 10,
    //   'optional_orientation' => json_encode(['square']),
    //   'title' => 'Throw Pillow 16x16',
    //   'description' => 'Vibrant Soft 100% Spun Polyester double-sided print throw pillows to update any home',
    //   'html_description' => '<ul> <li> Vibrant printing</li>   <li> Double-sided print</li>   <li> Soft and durable 100% Spun Polyester cover</li>   <li> Include polyester insert</li>  </ul>',
    //   'html_shipping' => '<ul><li> Production Time- Up to 3-4 days </li><li> Est. Domestic Arrival- Up to 7 days </li><li> Est. International Arrival-  7 to 35 days </li><li>Please review our ‘’Shipping & Returns Policy’’ for further information </li></ul>',
    //   'html_sizes' => '  <ul>   <li> 16*16 - 	Width: 16", Height 16" </li>   <li> 18*18 - 	Width: 18", Height 18" </li>   <li> 20*14 - 	Width: 20", Height 14" </li> </ul>',
    //   'image_width' => 3125,
    //   'image_height' => 3125,
    //   'image_ratio' => 1,
    //   'size' => '16"x16"',
    // ]);
  //   DB::table('product_details')->insert([
  //     'product_code' => 'tshirt-anvil-980',
  //     'current_supplier_id' => 2,
  //     'category_id' => 4,
  //     'optional_orientation' => json_encode(['square','landscape','portrait']),
  //     'title' => 'Tshirt Anvil 980',
  //     'description' => 'Comfortable, casual and semi fitted, this unisex T-shirt wears well on anyone and will easily become a closet staple. Made from 100% cotton, it wears well on anyone.',
  //     'html_description' => '<ul><li> Brand - Anvil </li><li> Model - 980 </li><li> Style- Semi-Fitted Unisex T shirt </li><li> Color- White </li><li> Comfortable 100% cotton, Oeko-Tex® Standard 100 Certified </li><li> Machine wash cold, tumble dry low </li></ul>',
  //     'html_shipping' => '<ul><li> Production Time- Up to 3-4 days </li><li> Est. Domestic Arriva-l Up to 7 days </li><li> Est. International Arrival- Up to 7 - 35 days </li><li> Please review our ‘’Shipping & Returns Policy’’ for further information </li></ul>',
  //     'html_sizes' => '<ul><li> S –  Chest: 27.5’’, Length 18’’ </li><li> M –  Chest: 28.75’’, Length 20’’ </li><li> L –  Chest: 29.75’’, Length 22’’ </li><li> XL–  Chest: 30.75’’, Length 24’’ </li><li> 2XL – Chest: 32’’, Length 26’’ </li><li> 3XL – Chest: 33’’, Length 28’’ </li></ul>',
  //     'size' => 'S-3XL',
  //   ]);
  //   DB::table('product_details')->insert([
  //     'product_code' => 'tanktop-gildan-2200',
  //     'current_supplier_id' => 1,
  //     'category_id' => 3,
  //     'optional_orientation' => json_encode(['square','landscape','portrait']),
  //     'title' => 'Unisex Ultra Cotton Tank',
  //     'description' => 'Comfortable 100% ultra cotton preshrunk classic fitted tank.',
  //     'html_description' => '<ul><li> Brand – Gildan </li><li> Model – 2200 </li><li> Style- Classic Fitted Unisex Tank </li><li> Color- White </li><li> Comfortable 100% ultra cotton </li><li> Machine wash cold, tumble dry low </li></ul>',
  //     'html_shipping' => '<ul><li> Production Time- Up to 3-4 days </li><li> Est. Domestic Arriva-l Up to 7 days </li><li> Est. International Arrival- Up to 7 - 35 days </li><li> Please review our ‘’Shipping & Returns Policy’’ for further information </li></ul>',
  //     'html_sizes' => '<ul><li> S – Chest: 18’’, Length 28’’ </li><li> M – Chest: 20’’, Length 29’’  </li><li> L – Chest: 22’’, Length 30’’ </li><li> XL– Chest: 24’’, Length 31’’ </li><li> 2XL – Chest: 26’’, Length 32’’ </li></ul>',
  //     'size' => 'S-2XL',
  //   ]);
  //   DB::table('product_details')->insert([
  //     'product_code' => 'canvas-blkwrp-8x8',
  //     'current_supplier_id' => 1,
  //     'category_id' => 1,
  //     'optional_orientation' => json_encode(['square']),
  //     'title' => 'Canvas Wrap 8x8',
  //     'description' => 'Made from an additive-free cotton-poly blend, our instant-dry canvases make for long lasting, fade resistant prints.',
  //     'html_description' => '<ul> <li> Made with a tight weave ideal for crisp printing of photography and fine art</li> <li> Thickness- 1.25” </li> <li> Side printed edges- Black wrap sides </li>  <li> Care of- UV coating is scratch-resistant, Wipe clean with a damp cloth</li>     <li> Shipped ready to hang</li> </ul>',
  //     'html_shipping' => '<ul>
  //     <li> Production Time- Up to 3-4 days </li>
  //     <li> Est. Domestic Arriva-l Up to 7 days </li>
  //     <li> Est. International Arrival- Up to 7 - 35 days </li>
  //     <li> Please review our ‘’Shipping & Returns Policy’’ for further information </li>
  //     </ul>',
  //     'html_sizes' => '<ul>
  //     <li> 8*8 – Width: 8’’, Height 8’’ </li>
  //     <li> 12*12 – Width: 12’’, Height 12’’ </li>
  //     <li> 16*16 – Width: 16’’, Height 16’’ </li>
  //     </ul>',
  //     'size' => '8"x8"',
  //   ]);
  //   DB::table('product_details')->insert([
  //     'product_code' => 'canvas-blkwrp-12x12',
  //     'current_supplier_id' => 1,
  //     'category_id' => 1,
  //     'optional_orientation' => json_encode(['square']),
  //     'title' => 'Canvas Wrap 12x12',
  //     'description' => 'Made from an additive-free cotton-poly blend, our instant-dry canvases make for long lasting, fade resistant prints.',
  //     'html_description' => '<ul> <li> Made with a tight weave ideal for crisp printing of photography and fine art</li> <li> Thickness- 1.25” </li> <li> Side printed edges- Black wrap sides </li>  <li> Care of- UV coating is scratch-resistant, Wipe clean with a damp cloth</li>     <li> Shipped ready to hang</li> </ul>',
  //     'html_shipping' => '<ul>
  //     <li> Production Time- Up to 3-4 days </li>
  //     <li> Est. Domestic Arriva-l Up to 7 days </li>
  //     <li> Est. International Arrival- Up to 7 - 35 days </li>
  //     <li> Please review our ‘’Shipping & Returns Policy’’ for further information </li>
  //     </ul>',
  //     'html_sizes' => '<ul>
  //     <li> 8*8 – Width: 8’’, Height 8’’ </li>
  //     <li> 12*12 – Width: 12’’, Height 12’’ </li>
  //     <li> 16*16 – Width: 16’’, Height 16’’ </li>
  //     </ul>',
  //     'size' => '12"x12"',
  //   ]);
  //   DB::table('product_details')->insert([
  //     'product_code' => 'canvas-blkwrp-16x16',
  //     'current_supplier_id' => 1,
  //     'category_id' => 1,
  //     'optional_orientation' => json_encode(['square']),
  //     'title' => 'Canvas Wrap 16x16',
  //     'description' => 'Made from an additive-free cotton-poly blend, our instant-dry canvases make for long lasting, fade resistant prints.',
  //     'html_description' => '<ul> <li> Made with a tight weave ideal for crisp printing of photography and fine art</li> <li> Thickness- 1.25” </li> <li> Side printed edges- Black wrap sides </li>  <li> Care of- UV coating is scratch-resistant, Wipe clean with a damp cloth</li>     <li> Shipped ready to hang</li> </ul>',
  //     'html_shipping' => '<ul>
  //     <li> Production Time- Up to 3-4 days </li>
  //     <li> Est. Domestic Arriva-l Up to 7 days </li>
  //     <li> Est. International Arrival- Up to 7 - 35 days </li>
  //     <li> Please review our ‘’Shipping & Returns Policy’’ for further information </li>
  //     </ul>',
  //     'html_sizes' => '<ul>
  //     <li> 8*8 – Width: 8’’, Height 8’’ </li>
  //     <li> 12*12 – Width: 12’’, Height 12’’ </li>
  //     <li> 16*16 – Width: 16’’, Height 16’’ </li>
  //     </ul>',
  //     'size' => '16"x16"',
  //   ]);
  //   DB::table('product_details')->insert([
  //     'product_code' => 'throw-pillow-sewn-18x18',
  //     'current_supplier_id' => 1,
  //     'category_id' => 2,
  //     'optional_orientation' => json_encode(['square']),
  //     'title' => 'Throw Pillow 18x18',
  //     'description' => 'Vibrant Soft 100% Spun Polyester double-sided print throw pillows to update any home',
  //     'html_description' => '<ul> <li> Vibrant printing</li>   <li> Double-sided print</li>   <li> Soft and durable 100% Spun Polyester cover</li>   <li> Include polyester insert</li>  </ul>',
  //     'html_shipping' => '<ul><li> Production Time- Up to 3-4 days </li><li> Est. Domestic Arrival- Up to 7 days </li><li> Est. International Arrival-  7 to 35 days </li><li>Please review our ‘’Shipping & Returns Policy’’ for further information </li></ul>',
  //     'html_sizes' => '<ul><li> 16*16 - 	Width: 16", Height 16" </li>   <li> 18*18 - 	Width: 18", Height 18" </li>   <li> 20*14 - 	Width: 20", Height 14" </li> </ul>',
  //     'size' => '18"x18"',
  //   ]);

  //   DB::table('product_details')->insert([
  //     'product_code' => 'throw-pillow-sewn-20x14',
  //     'current_supplier_id' => 1,
  //     'category_id' => 2,
  //     'optional_orientation' => json_encode(['landscape']),
  //     'title' => 'Throw Pillow 20x24',
  //     'description' => 'Vibrant Soft 100% Spun Polyester double-sided print throw pillows to update any home',
  //     'html_description' => '<ul> <li> Vibrant printing</li>   <li> Double-sided print</li>   <li> Soft and durable 100% Spun Polyester cover</li>   <li> Include polyester insert</li>  </ul>',
  //     'html_shipping' => '<ul><li> Production Time- Up to 3-4 days </li><li> Est. Domestic Arrival- Up to 7 days </li><li> Est. International Arrival-  7 to 35 days </li><li>Please review our ‘’Shipping & Returns Policy’’ for further information </li></ul>',
  //     'html_sizes' => ' <ul>   <li> 16*16 - 	Width: 16", Height 16" </li>   <li> 18*18 - 	Width: 18", Height 18" </li>   <li> 20*14 - 	Width: 20", Height 14" </li> </ul>',
  //     'size' => '20"x24"',
  //   ]);
  }
}
