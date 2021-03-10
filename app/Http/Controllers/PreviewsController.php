<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderItem as OrderItem;
use App\Models\ProductTemplate as ProductTemplate;
use App\Models\Creator;
use App\Models\Image;
use App\Models\Store;
use App\Models\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Jobs\TransloaditJob;
use App\Jobs\TransloaditResults;
use Illuminate\Support\Facades\DB;
use Hash;
use Auth;
use App\Mail\OrderShipped;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use App\Models\Product;
use GuzzleHttp;
use GuzzleHttp\Client;
use Storage;
use Cart;
use Jenssegers\Agent\Agent;
use transloadit\Transloadit;

class PreviewsController extends Controller
{
  function get_preview_image_external($product, $images_array, $texts_array, $reso, $sup_template = NULL, $variance = NULL, $bg = NULL, $resize_method, $which_previews = null) {
      if (!$sup_template) {
          $sup_template = $product;
      }
      if ($variance)
          $variance = json_decode($variance);
      if (!$bg)
          $bg = '#ffffff';
      $project_name = 0;
      if (isset($product->project))
          $project_name = $product->project->id;
      $GLOBALS['reso'] = $reso;
      $product_code = $product->product_code;
      $products_dir_path = config('app.storage_dir') . '/templates_static_images/' . $project_name . '/products/' . $product->id;
      $temp_dir = config('app.storage_dir') . '/temp/';
      $temp_dir_url = url('storage/temp').'/';
      $fonts_dir = public_path() . '/assets/admin/fonts/';
      $fred_scripts_dir = app_path() . '/Include/get_preview/FredImageMagickScripts/';
      $uniqid = uniqid();
      $temp_preview_base_image_path = $temp_dir . $product_code . "_$uniqid";
      $temp_preview_image_url = $temp_dir_url . $product_code . "_$uniqid";
      $returned_array = array('path' => $temp_preview_base_image_path . '.jpg', 'url' => $temp_preview_image_url . '.jpg');
      $pages_path_string = '';
      $pages_number = $sup_template->basic_template->pages_number;
      $product_width = $product_height = $ratio_distance = $rotated = 0;
      $ratio_for_smallest;
      $img;
      $old_resize_method = $resize_method;
  //    $resize_method = 'stretch';
      $base_image;
      $preview_number;
      $is_first_img = true;
      $resolution_requierd = (int) $sup_template->basic_template->resolution;
      if ($resolution_requierd == 0 || $resolution_requierd == '') {
          $resolution_requierd = 72;
      }
  //    for ($i = 1; $i <= $pages_number; $i++) {
      for ($i = 1; $i <= 1; $i++) {
          $page = 'page_' . $i;
          $page_path = $temp_preview_base_image_path . '_' . $page . '.jpg';
  //        if (strpos('x' . $product_code, 'tshirt'))
  //            $page_path = $temp_preview_base_image_path . '_' . $page . '.png';
          $ratio_for_smallest = min([$sup_template->basic_template->page_1_width, $sup_template->basic_template->page_1_height]) / $reso / 2;
          if ($ratio_for_smallest < 1)
              $ratio_for_smallest = 1;
          $product_width = $sup_template->basic_template->page_1_width / $ratio_for_smallest;
          $product_height = $sup_template->basic_template->page_1_height / $ratio_for_smallest;
          $product_image_x = 0; //$sup_template->basic_template->page_1_x / $ratio_for_smallest;
          $product_image_y = 0; //$sup_template->basic_template->page_1_y / $ratio_for_smallest;



          $product_ratio = $product_width / $product_height;
          $j = 1;

          for ($j = 1; $j < 10; $j++) {
              if (isset($product['attributes'][$page . '_image_' . $j . '_width']) && isset($images_array[$j])) {



                  if ($product['attributes'][$page . '_image_' . $j . '_width'] != '') {
                      $image = 'image_' . $j;
                      $img_path = $products_dir_path . '/' . $page . '/' . $image . "/" . $images_array[$j] . '.jpg';
                      $old_img_path = $img_path;
                      if (strpos('x' . $images_array[$j], '/')) {
                          $img_path = $images_array[$j];
                      }
                      if (!Storage::cloud()->exists($img_path) && Storage::cloud()->exists(str_replace('jpg', 'png', $img_path)))
                          $img_path = str_replace('jpg', 'png', $img_path);
                      if (!Storage::cloud()->exists($img_path))
                          continue;
                      if ($old_img_path == $img_path || $old_img_path == str_replace('jpg', 'png', $img_path)) {
                          $resize_method = 'stretch';
                      }
                      $image_width = $product['attributes'][$page . '_' . $image . '_width'] / $ratio_for_smallest;
                      $image_height = $product['attributes'][$page . '_' . $image . '_height'] / $ratio_for_smallest;
                      $image_x = $product['attributes'][$page . '_' . $image . '_x'] / $ratio_for_smallest;
                      $image_y = $product['attributes'][$page . '_' . $image . '_y'] / $ratio_for_smallest;
  //                    var_die($product_width . 'x' . $product_height . ' ' .  $sup_template->basic_template->page_1_width . 'x' .  $sup_template->basic_template->page_1_height);

                      $bg_color = 'white';
                      if (!$is_first_img) {
                          $base_image = $img;
                      }
                      $img = new \Imagick();
                      $img->readImageBlob(Storage::cloud()->get($img_path));


                      if ($sup_template->basic_template->our_category->rotate == 1 && ($img->getImageWidth() / $img->getImageHeight() > $img->getImageHeight() / $img->getImageWidth())) {
  //                        $img_ratio = $img->getImageWidth() / $img->getImageHeight();
  //                        $img->rotateimage(new ImagickPixel('none'), 90);
  //                        $rotated = 1;
                      }
                      $img->setImageFormat('jpg');
  //                    $img->setImageUnits(imagick::RESOLUTION_PIXELSPERINCH);
  //                    $img->setImageResolution($resolution_requierd, $resolution_requierd);
  //                    if (abs($image_width / $image_width - $img->getimagewidth() / $img->getimageheight()) < 0.1 || $resize_method) {
                      switch ($resize_method) {
                          case 'fit':
  //                            $image = Image::make(Storage::cloud()->get($img_path));
  //                            $image->fit((int) $image_width, (int) $image_height);
  //                            Storage::cloud()->put($page_path, (string) $image->encode(), 'public');
  //                            $img = new \Imagick();
  //                            $img->readImageBlob(Storage::cloud()->get($page_path));
  //                            var_die($image_width.' '.$image_height);
                              $img->resizeImage($image_width, $image_height, Imagick::FILTER_BOX, 0, 1);

                              break;
                          case 'crop':
                              $img->resizeImage($image_width, $image_height, Imagick::FILTER_BOX, 1);
                              break;
                          case 'stretch':
                              $img->resizeImage($image_width, $image_height, Imagick::FILTER_BOX, 0);
                              break;
                          default:
                              $img->resizeImage($image_width, $image_height, Imagick::FILTER_BOX, 0);
                              break;
                      }
  //                    } else {
  //                        $img->resizeImage($image_width, $image_height, Imagick::FILTER_BOX, 1, true);
  //                    }


                      $image_x = $image_x + (($image_width - $img->getimagewidth()) / 2);
                      $image_y = $image_y + (($image_height - $img->getimageheight()) / 2);
                      if ($is_first_img && $bg) {
                          $product_image_x = $product_image_x + (($product_width - $img->getimagewidth()) / 2);
                          $product_image_y = $product_image_y + (($product_height - $img->getimageheight()) / 2);
                          $bg_layer = new \Imagick();
                          $bg_layer->newImage($product_width, $product_height, new ImagickPixel($bg));
                          $bg_layer->setImageFormat('jpg');
                          $bg_layer->compositeImage($img, Imagick::COMPOSITE_DEFAULT, $image_x, $image_y, Imagick::CHANNEL_ALPHA);
                          $img = $bg_layer;
                      }




                      if ($is_first_img && !$bg) {// background image
                          $img_ratio = $img->getImageWidth() / $img->getImageHeight();
                          $ratio_distance = abs(1 - ($product_ratio / $img_ratio));
  //                        if ($ratio_distance < 0.1 || $resize_method) {
                          switch ($resize_method) {
                              case 'fit':
  //                            $image = Image::make(Storage::cloud()->get($img_path));
  //                            $image->fit((int) $image_width, (int) $image_height);
  //                            Storage::cloud()->put($page_path, (string) $image->encode(), 'public');
  //                            $img = new \Imagick();
  //                            $img->readImageBlob(Storage::cloud()->get($page_path));
  //                            var_die($image_width.' '.$image_height);
                                  $img->resizeImage($image_width, $image_height, Imagick::FILTER_BOX, 0, 1);

                                  break;
                              case 'crop':
                                  $img->resizeImage($image_width, $image_height, Imagick::FILTER_BOX, 1);
                                  break;
                              case 'stretch':
                                  $img->resizeImage($image_width, $image_height, Imagick::FILTER_BOX, 0);
                                  break;
                              default:
                                  $img->resizeImage($image_width, $image_height, Imagick::FILTER_BOX, 0);
                                  break;
                          }
  //                        } else {
  //                            $img->resizeImage($product_width, $product_height, Imagick::FILTER_BOX, 1, true);
  //                            Storage::cloud()->put($page_path, (string) $img->encode(), 'public');
  //                            // Resized image
  //                            $image = Image::make(Storage::cloud()->get($img_path));
  //                            $image->resize($product_width, $product_height, function ($constraint) {
  //                                $constraint->aspectRatio();
  //                            });
  //                            // Canvas image
  //                            $canvas = Image::canvas($product_width, $product_height)->fill('#ffffff');
  //                            $canvas->insert($image, 'center');
  //                            Storage::cloud()->put($page_path, (string) $canvas->encode(), 'public');
  //                            $img = new \Imagick();
  //                            $img->readImageBlob(Storage::cloud()->get($page_path));
  //                        }
                      } else if (!$is_first_img) {
                          $base_image->setImageColorspace($img->getImageColorspace());
                          $base_image->compositeImage($img, $img->getImageCompose(), $image_x, $image_y);
                          $img = $base_image;
                      }

                      $is_first_img = false;
  //                    $img->writeimage($page_path);
                  }
                  $resize_method = $old_resize_method;
              }
          }
  //        header('Content-Type: image/jpeg');
  //        echo $img;
  //        die();

          for ($j = 1; $j < 10; $j++) {
              if (isset($product['attributes'][$page . '_text_' . $j . '_x']) && isset($texts_array[$j])) {
                  if ($product['attributes'][$page . '_text_' . $j . '_width'] != '') {
                      $text_name = $page . '_text_' . $j;
                      $text_obj = new ImagickDraw();
  //                    $text = 'First Name';
                      $text = $texts_array[$j];
                      if (preg_match("/\p{Hebrew}/u", $text)) {
                          $text = utf8_strrev($texts_array[$j]);
                      }
                      $font_size = $product['attributes'][$text_name . '_font_size_in_pt'] / $ratio_for_smallest; //300ppi
  //                    $font_size_in_px = $product['attributes'][$text_name . '_font_size_in_pt'] * $reso / 400; //300ppi
                      $text_obj->setFontSize(get_font_size_by_product_code($product_code, $font_size));
                      if (file_exists($fonts_dir . $product['attributes'][$text_name . '_font'] . '.ttf'))
                          $text_obj->setFont($fonts_dir . $product['attributes'][$text_name . '_font'] . '.ttf');
                      $text_obj->setTextEncoding('UTF-8');
                      $text_color = $product['attributes'][$text_name . '_color']; //get_color_text($product['attributes'][$text_name . '_color'], $images_array[0]);
                      if (isset($text_color[0]))
                          if ($text_color[0] != '#')
                              $text_color = '#' . $text_color;
                      $text_obj->setFillColor($text_color);
                      $text_place_holder_width = $product['attributes'][$text_name . '_width'] / $ratio_for_smallest;
                      $text_place_holder_height = $product['attributes'][$text_name . '_height'];
                      $metrics = $img->queryFontMetrics($text_obj, $text);
                      $text_width = $metrics['textWidth'];
                      $text_height = $metrics['textHeight'];
                      $text_x = ($text_place_holder_width / 2) - ($text_width / 2);
                      if (isset($product['attributes'][$page . '_text_' . $j . '_alignment'])) {
                          if ($product['attributes'][$page . '_text_' . $j . '_alignment'] == 'right')
                              $text_x = $text_place_holder_width - $text_width;
                          if ($product['attributes'][$page . '_text_' . $j . '_alignment'] == 'left')
                              $text_x = 0;
                      }
                      $text_y = (($text_place_holder_height / 2) + ($text_height / 2)) / $ratio_for_smallest;
  //                    var_die($ratio_for_smallest);
                      $img->annotateImage($text_obj, $product['attributes'][$text_name . '_x'] / $ratio_for_smallest + $text_x, $product['attributes'][$text_name . '_y'] / $ratio_for_smallest + $text_y, 0, $text);

  //                    $img->writeimage($page_path);
                  }
              }
          }
  //        header('Content-Type: image/jpeg');
  //        echo $img;
  //        die();
  //        if ($sup_template->basic_template->our_category) {
  //            if ($sup_template->basic_template->our_category->rotate == 1 && ($img->getImageWidth() / $img->getImageHeight() > $img->getImageHeight() / $img->getImageWidth())) {
  //                $img_ratio = $img->getImageWidth() / $img->getImageHeight();
  //                $img->rotateimage(new ImagickPixel('none'), 90);
  //                $rotated = 1;
  //            }
  //        }
  //        $img_ratio = $img->getImageWidth() / $img->getImageHeight();
  //
  //        $ratio_distance = abs(1 - ($product_ratio / $img_ratio));
  //        if ($ratio_distance < 0.1) {
  //            $img->resizeImage($product_width_after_bleed, $product_height_after_bleed, Imagick::FILTER_BOX , 1);
  //        } else {
  //            $img->resizeImage($product_width_after_bleed, $product_height_after_bleed, Imagick::FILTER_BOX , 1, true);
  //            $img->writeImage($page_path);
  //            if (strpos('x' . $product_code, 'tshirt') || strpos('x' . $product_code, 'tshirt')) {
  //                exec($fred_scripts_dir . "aspect " . $product_width_after_bleed . "x" . $product_height_after_bleed . " -m pad -c none -g north " . $page_path . ' ' . $page_path . ' 2>&1', $out, $returnval);
  //            } else {
  //                exec($fred_scripts_dir . "aspect " . $product_width_after_bleed . "x" . $product_height_after_bleed . " -m pad -c black " . $page_path . ' ' . $page_path . ' 2>&1', $out, $returnval);
  //            }
  //            $img = new Imagick($page_path);
  //        }
  //        if (strpos('x' . $product_code, 'tshirt'))
  //            $img->evaluateImage(Imagick::EVALUATE_MULTIPLY, 0.7, Imagick::CHANNEL_ALPHA);

          Storage::cloud()->put($page_path, (string) $img, 'public');
  //        header('Content-Type: image/jpeg');
  //        echo $img;
  //        die();
  //
  //        var_die($page_path); //daniel



          $is_more_then_one_page_preview = add_gooten_mask($page_path, $product_code, $temp_preview_base_image_path . '.jpg', $reso, $variance, $which_previews);



          if ($rotated && !strpos('x' . strtolower($sup_template->product_code), 'phone')) {
              $img = new Imagick($temp_preview_base_image_path . '.jpg');
              $img->rotateimage(new ImagickPixel('none'), 270);
              Storage::cloud()->put($temp_preview_base_image_path . '.jpg', (string) $img, 'public');
          }
          $preview_number = $is_more_then_one_page_preview;
  //        if (!$is_more_then_one_page_preview)
          break;
      }
      for ($index = 2; $index <= $preview_number; $index++) {
          $returned_array['url_' . $index] = $temp_preview_image_url . '_' . $index . '.jpg';
          // Resized image
  //        $image = Image::make(Storage::cloud()->get($temp_preview_base_image_path . '_' . $index . '.jpg'));
  //
  //
  //
  //        $image->resize($reso, $reso, function ($constraint) {
  //            $constraint->aspectRatio();
  //        });
  //        // Canvas image
  //        $canvas = Image::canvas($reso, $reso)->fill('#ffffff');
  //        $canvas->insert($image, 'center');
  //        Storage::cloud()->put($temp_preview_base_image_path . '_' . $index . '.jpg', (string) $canvas->encode(), 'public');
  //        exec($fred_scripts_dir . "aspect $reso" . "x$reso -m pad -c white " . $temp_preview_base_image_path . '_' . $index . '.jpg' . ' ' . $temp_preview_base_image_path . '_' . $index . '.jpg' . ' 2>&1', $out, $returnval);
      }
  //    var_die($temp_preview_base_image_path . '.jpg');
  //    if (strpos('x' . $product_code, 'Tshirt'))
  //        exec($fred_scripts_dir . "aspect $reso" . "x$reso -m pad -c white " . $temp_preview_base_image_path . '.png' . ' ' . $temp_preview_base_image_path . '.jpg' . ' 2>&1', $out, $returnval);
  //    else {
      // Resized image
  //    $image = Image::make(Storage::cloud()->get($temp_preview_base_image_path . '.jpg'));
  //    $image->resize($reso, $reso, function ($constraint) {
  //        $constraint->aspectRatio();
  //    });
  //    // Canvas image
  //    $canvas = Image::canvas($reso, $reso)->fill('#ffffff');
  //    $canvas->insert($image, 'center');
  //    Storage::cloud()->put($temp_preview_base_image_path . '.jpg', (string) $canvas->encode(), 'public');
  //    exec($fred_scripts_dir . "aspect $reso" . "x$reso -m pad -c white " . $temp_preview_base_image_path . '.jpg' . ' ' . $temp_preview_base_image_path . '.jpg' . ' 2>&1', $out, $returnval);
  //    }
      return $returned_array;
  }

  function mm_to_px($resolution, $mm) {
      $px = (($resolution * $mm) / (25.4));
      return $px;
  }

  function utf8_strrev($str) {
      preg_match_all('/./us', $str, $ar);
      return implode(array_reverse($ar[0]));
  }

  function remove_str_from_head_and_tail($search, $str) {
      while (substr($str, -1, 1) == $search)
          $str = substr($str, 0, -1);
      while (substr($str, 0, 1) == $search)
          $str = substr($str, 1);
      return $str;
  }

  function get_color_text($text_color_field, $selected_bg_image_number) {
      $text_color_field_as_array = explode(',', $text_color_field);
      $default_color = '';
      $text_color_asoc_array = array();
      foreach ($text_color_field_as_array as $value) {
          if (!strpos('x' . $value, '->')) {
              $default_color = remove_str_from_head_and_tail(' ', $value);
          }
          $key_and_value = explode('->', $value);
          $text_color_asoc_array[remove_str_from_head_and_tail(' ', $key_and_value[0])] = remove_str_from_head_and_tail(' ', $key_and_value[1]);
      }
      if (isset($text_color_asoc_array[$selected_bg_image_number])) {
          return $text_color_asoc_array[$selected_bg_image_number];
      }
      return $default_color;
  }

  function add_gooten_mask($filename, $product_code, $out_file, $reso, $variance, $which_previews) {
      $fred_scripts_dir = app_path() . '/Include/get_preview/FredImageMagickScripts/';
      $overlays_dir = config('app.storage_dir') . '/overlays/';
      $product_code_original = $product_code;
      //echo $product_code;
      //die();
      $base = new \Imagick();
      $base->readImageBlob(Storage::cloud()->get($filename));
      if (strpos('x' . $product_code, 'Tshirt-Gildan'))
          $product_code = 'tshirt_gildan';
      if (strpos('x' . $product_code, 'ToteBag') || $product_code == 'EverythingBag')
          $product_code = 'tote_bag';
      if (strpos('x' . $product_code, 'AdjustableTote'))
          $product_code = 'adjustable_tote';
      if (strpos('x' . $product_code, 'DuvetCover'))
          $product_code = 'duvet_cover';
      if (strpos('x' . $product_code, 'Tshirt-Anvil'))
          $product_code = 'tshirt_Anvil';
  //    if (strpos('x' . $product_code, 'CanvsWrp-BlkWrp-') || strpos('x' . $product_code, 'canvas-blk-wrp-'))
  //        $product_code = 'canvas';
      switch ($product_code) {
          case 'throw-pillow-zipper-16x16':
          case 'accessorypouch-135x9':
          case 'accessorypouch-95x6':
          case 'coaster-375x375-6set':
          case 'throw-pillow-suede-16x16-zippered':
          case 'throw-pillow-white-faux-linen-16x16-zippered':
          case 'notebook-55x725-spiral-94':
              $mask_path = $overlays_dir . $product_code . ".png";
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
              $w = $base->getImageWidth();
              $h = $base->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $base->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);
              $base->writeImage($out_file);


              return 0;
              break;
          case 'FlatCard-4x8-Matte-Single-10Pack':
          case 'BusinessCardBlackOneSide':
              $base->rotateimage(new ImagickPixel('none'), 13);
              $mask_path = $overlays_dir . $product_code . ".png";
              $mask = $base;
              $base = new Imagick($mask_path);
              $w = $base->getImageWidth();
              $h = $base->getImageHeight();
              $mask->resizeImage(780, 780, Imagick::FILTER_BOX, 1, TRUE);
              $base->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 210, 385, Imagick::CHANNEL_ALPHA);
              $base->writeImage($out_file);
              return 1;
              break;
          case 'accessorypouch-85x6':
              $first = $base;
              $mask_path = $overlays_dir . $product_code . '.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
              $mask->setImageOpacity(0.5);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));
              $size = $reso / 1.15;
              $first->resizeImage($size, $size, Imagick::FILTER_BOX, 1, false);

              $white_bg->compositeImage($first, Imagick::COMPOSITE_DEFAULT, $reso / 15.5, $reso / $ratio / 25, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');

              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);
              Storage::cloud()->put($out_file, (string) $white_bg, 'public');
              header('Content-Type: image/jpeg');
              echo $white_bg;
              die();

              return 1;
              break;
          case 'accessorypouch-125x85':
              $first = clone $base;
              $mask_path = $overlays_dir . $product_code . '.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
              $overlay_1 = fit_mask($first, $mask);
              Storage::cloud()->put($out_file, (string) $overlay_1, 'public');
              $second = clone $base;
              $mask_path = $overlays_dir . $product_code . '-2.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.3);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));
              $size = $reso / 1.1;
              $second->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);
              $white_bg->compositeImage($second, Imagick::COMPOSITE_DEFAULT, $reso / 20, $reso / $ratio / 2.95, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');
              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);
  //            header('Content-Type: image/jpeg');
  //              echo $white_bg;
  //             die();

              Storage::cloud()->put(str_replace('.jpg', '_2.jpg', $out_file), (string) $white_bg, 'public');
              return 2;
          case 'totebag-13x13':
          case 'totebag-18x18':
          case 'totebag-16x16':
              $first = $base;
              $mask_path = $overlays_dir . $product_code . '.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
              $overlay_1 = fit_mask($first, $mask);
              Storage::cloud()->put($out_file, (string) $overlay_1, 'public');
              $second = clone $base;
              $mask_path = $overlays_dir . $product_code . '-2.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.8);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));
              $size = $reso / 1.01;
              $second->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);
              $white_bg->compositeImage($second, Imagick::COMPOSITE_DEFAULT, $reso / 60, $reso / $ratio / -200, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');
              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);
  //            header('Content-Type: image/jpeg');
  //              echo $white_bg;
  //             die();

              Storage::cloud()->put(str_replace('.jpg', '_2.jpg', $out_file), (string) $white_bg, 'public');
              return 2;
              break;
          case 'waterbottle-aluminum-silver-screwonelid-7x3-600ml':
              // $base->rotateimage(new ImagickPixel('none'), 13);
              $mask_path = $overlays_dir . $product_code . ".png";
              $mask = $base;
              $base = new Imagick($mask_path);
              $w = $base->getImageWidth();
              $h = $base->getImageHeight();
              $mask->resizeImage(2250, 2250, Imagick::FILTER_BOX, 1, TRUE);
              $base->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 220, 4500, Imagick::CHANNEL_ALPHA);

              $base->writeImage($out_file);
              return 1;
              break;

          case 'coaster-375x375-4set':
          case 'coaster-375x375-6set':
              $base->resizeImage(485, 485, Imagick::FILTER_BOX, 1, TRUE);
              $base->rotateimage(new ImagickPixel('none'), -10);
              $ratio = 1.29;
              $white_bg = new \Imagick();
              $white_bg->newImage(768, 596, new ImagickPixel('white'));
              $white_bg->compositeImage($base, Imagick::COMPOSITE_DEFAULT, 2, 0, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');

              $base = new Imagick($filename);
              break;
  //        case 'canvas':
  //            $product_code = $product_code_original;
  //
  //            exec($fred_scripts_dir . 'imageborder -s ' . $reso / 6 . ' -b 3 -m white -p 100 -r white -t 0 -e edge ' . $filename . ' ' . $filename . ' 2>&1', $out, $returnval);
  //            exec($fred_scripts_dir . '3Dcover -s "1%" -a -30 -sc "#C4C7C0" ' . $filename . ' ' . $filename . ' 2>&1', $out, $returnval);
  ////            var_die($filename);
  //            $base = new Imagick($filename);
  //            break;
          //case 'sherpa-blanket-50x60':
          //  exec($fred_scripts_dir . 'imageborder -s ' . $reso / 150 . ' -b 3 -m white -p 100 -r white -t 0 -e edge ' . $filename . ' ' . $filename . ' 2>&1', $out, $returnval);
          //  $base = new Imagick($filename);
          // break;
          case 'accessorypouch-125x85':
              exec($fred_scripts_dir . 'imageborder -s ' . $reso / 24 . ' -b 3 -m white -p 100 -r white -t 0 -e edge ' . $filename . ' ' . $filename . ' 2>&1', $out, $returnval);
              $base = new Imagick($filename);
              break;
          case 'mug-aluminum-14oz-white':
              exec($fred_scripts_dir . 'imageborder -s ' . $reso / 6 . ' -b 3 -m white -p 100 -r white -t 0 -e edge ' . $filename . ' ' . $filename . ' 2>&1', $out, $returnval);
              $base = new Imagick($filename);
              break;
          case 'mug-aluminum-14oz-silver':
              exec($fred_scripts_dir . 'imageborder -s ' . $reso / 6 . ' -b 3 -m white -p 100 -r white -t 0 -e edge ' . $filename . ' ' . $filename . ' 2>&1', $out, $returnval);
              $base = new Imagick($filename);
              break;
          case 'porcelain-ornaments-round-gold-string-3':
              exec($fred_scripts_dir . 'imageborder -s ' . $reso / 6.5 . ' -b 3 -m white -p 100 -r white -t 0 -e edge ' . $filename . ' ' . $filename . ' 2>&1', $out, $returnval);
              $base = new Imagick($filename);
              break;
          case 'cinch-sack-back-pack':
  //            exec($fred_scripts_dir . 'imageborder -s ' . $reso / 70 . ' -b 3 -m white -p 100 -r white -t 0 -e edge ' . $filename . ' ' . $filename . ' 2>&1', $out, $returnval);
  //            $base = new Imagick($filename);
              break;
          case 'laundry-bag-18x32':
              exec($fred_scripts_dir . 'imageborder -s ' . $reso / 20 . ' -b 3 -m white -p 100 -r white -t 0 -e edge ' . $filename . ' ' . $filename . ' 2>&1', $out, $returnval);
              $base = new Imagick($filename);
              break;
          case 'laundry-bag-28x36':
              exec($fred_scripts_dir . 'imageborder -s ' . $reso / 40 . ' -b 3 -m white -p 100 -r white -t 0 -e edge ' . $filename . ' ' . $filename . ' 2>&1', $out, $returnval);
              $base = new Imagick($filename);
              break;
          case 'framed_8x10_black_gloss':
              exec($fred_scripts_dir . 'imageborder -s ' . $reso / 3.1 . ' -b 3 -m white -p 100 -r white -t 0 -e edge ' . $filename . ' ' . $filename . ' 2>&1', $out, $returnval);
              $base = new Imagick($filename);
              break;
          case 'framed_11x14_black_gloss':
              exec($fred_scripts_dir . 'imageborder -s ' . $reso / 4 . ' -b 3 -m white -p 100 -r white -t 0 -e edge ' . $filename . ' ' . $filename . ' 2>&1', $out, $returnval);
              $base = new Imagick($filename);
              break;
          case 'table-top-canvas-blk-wrp-5x7':
              exec($fred_scripts_dir . 'imageborder -s ' . $reso / 12 . ' -b 3 -m white -p 100 -r white -t 0 -e edge ' . $filename . ' ' . $filename . ' 2>&1', $out, $returnval);
              $base = new Imagick($filename);
              break;
          case 'table-top-canvas-blk-wrp-8x10':
              exec($fred_scripts_dir . 'imageborder -s ' . $reso / 13 . ' -b 3 -m white -p 100 -r white -t 0 -e edge ' . $filename . ' ' . $filename . ' 2>&1', $out, $returnval);
              $base = new Imagick($filename);
              break;
          case 'throw-pillow-sewn-20x20':
              exec($fred_scripts_dir . 'imageborder -s ' . $reso / 150 . ' -b 3 -m white -p 100 -r white -t 0 -e edge ' . $filename . ' ' . $filename . ' 2>&1', $out, $returnval);
              $base = new Imagick($filename);
              break;
          case 'throw-pillow-zipper-20x20':
              exec($fred_scripts_dir . 'imageborder -s ' . $reso / 150 . ' -b 3 -m white -p 100 -r white -t 0 -e edge ' . $filename . ' ' . $filename . ' 2>&1', $out, $returnval);
              $base = new Imagick($filename);
              break;
          case 'throw-pillow-zipper-26x26':
              exec($fred_scripts_dir . 'imageborder -s ' . $reso / 150 . ' -b 3 -m white -p 100 -r white -t 0 -e edge ' . $filename . ' ' . $filename . ' 2>&1', $out, $returnval);
              $base = new Imagick($filename);
              break;
          case 'throw-pillow-sewn-26x26':
              exec($fred_scripts_dir . 'imageborder -s ' . $reso / 150 . ' -b 3 -m white -p 100 -r white -t 0 -e edge ' . $filename . ' ' . $filename . ' 2>&1', $out, $returnval);
              $base = new Imagick($filename);
              break;
          case 'throw-pillow-sewn-14x14':
              exec($fred_scripts_dir . 'imageborder -s ' . $reso / 150 . ' -b 3 -m white -p 100 -r white -t 0 -e edge ' . $filename . ' ' . $filename . ' 2>&1', $out, $returnval);
              $base = new Imagick($filename);
              break;
          case 'compact-mirror-225x225-square':
              exec($fred_scripts_dir . 'imageborder -s ' . $reso / 7 . ' -b 3 -m white -p 100 -r white -t 0 -e edge ' . $filename . ' ' . $filename . ' 2>&1', $out, $returnval);
              $base = new Imagick($filename);
              break;

          case 'beach-towel-36x72':
              $first = $base;
              $mask_path = $overlays_dir . $product_code . '.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
              $overlay_1 = fit_mask($first, $mask);
              Storage::cloud()->put($out_file, (string) $overlay_1, 'public');


              $second = clone $overlay_1;
              $mask_path = $overlays_dir . $product_code . '-2.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.3);
              $second->resizeImage($reso, $reso, Imagick::FILTER_BOX, 1, TRUE);

              $w = $second->getImageWidth();
              $h = $second->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $second->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);

  //            header('Content-Type: image/jpeg');
  //              echo $second;
  //             die();

              Storage::cloud()->put(str_replace('.jpg', '_2.jpg', $out_file), (string) $second, 'public');

              return 2;
          case 'canvas-blkwrp-16x16':
              $first = $base;
              $second = new \Imagick();
              $second->readImageBlob(Storage::cloud()->get($filename));

              $mask_path = $overlays_dir . $product_code . '.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.5);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));

              $size = $reso / 1.16;
              $second->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);

              $white_bg->compositeImage($second, Imagick::COMPOSITE_DEFAULT, $reso / 15, $reso / $ratio / 14, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');


              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);
              Storage::cloud()->put($out_file, (string) $white_bg, 'public');

  //            header('Content-Type: image/jpeg');
  //              echo $white_bg;
  //             die();

              $mask_path = $overlays_dir . $product_code . '-2.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.5);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));

              $size = $reso / 2.18;
              $second->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);

              $white_bg->compositeImage($second, Imagick::COMPOSITE_DEFAULT, $reso / 3.7, $reso / $ratio / 37, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');


              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);

  //            header('Content-Type: image/jpeg');
  //              echo $white_bg;
  //             die();

              Storage::cloud()->put(str_replace('.jpg', '_2.jpg', $out_file), (string) $white_bg, 'public');

              return 2;
          case 'mousepad-779x925':
              $first = $base;
              $second = new \Imagick();
              $second->readImageBlob(Storage::cloud()->get($filename));

              $mask_path = $overlays_dir . $product_code . '.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.5);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));

              $size = $reso / 1.19;
              $second->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);

              $white_bg->compositeImage($second, Imagick::COMPOSITE_DEFAULT, $reso / 15, $reso / $ratio / 7.1, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');


              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);
              Storage::cloud()->put($out_file, (string) $white_bg, 'public');

  //            header('Content-Type: image/jpeg');
  //              echo $white_bg;
  //             die();

              $mask_path = $overlays_dir . $product_code . '-2.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.5);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));

              $size = $reso / 2.05;
              $second->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);

              $white_bg->compositeImage($second, Imagick::COMPOSITE_DEFAULT, $reso / 2.2, $reso / $ratio / 2.42, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');


              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);

  //            header('Content-Type: image/jpeg');
  //              echo $white_bg;
  //             die();

              Storage::cloud()->put(str_replace('.jpg', '_2.jpg', $out_file), (string) $white_bg, 'public');

              return 2;
          case 'mug-11oz':
              $first = $base;

              $second = new \Imagick();
              $second->readImageBlob(Storage::cloud()->get($filename));

              $mask_path = $overlays_dir . $product_code . '.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.5);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));

              $size = $reso / 1.38;
              $first->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);

              $white_bg->compositeImage($first, Imagick::COMPOSITE_DEFAULT, $reso / 7.2, $reso / $ratio / 2.85, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');


              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);
              Storage::cloud()->put($out_file, (string) $white_bg, 'public');

  //            header('Content-Type: image/jpeg');
  //            echo $white_bg;
  //            die();

              $mask_path = $overlays_dir . $product_code . '-2.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.5);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));

              $size = $reso / 0.78;
              $second->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);

              $white_bg->compositeImage($second, Imagick::COMPOSITE_DEFAULT, $reso / -4.2, $reso / $ratio / 4.8, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');


              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);

  //            header('Content-Type: image/jpeg');
  //            echo $white_bg;
  //            die();

              Storage::cloud()->put(str_replace('.jpg', '_2.jpg', $out_file), (string) $white_bg, 'public');

              return 2;
          case 'canvas-blkwrp-12x12':
              $first = $base;
              $second = new \Imagick();
              $second->readImageBlob(Storage::cloud()->get($filename));

              $mask_path = $overlays_dir . $product_code . '.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.5);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));

              $size = $reso / 1.45;
              $second->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);

              $white_bg->compositeImage($second, Imagick::COMPOSITE_DEFAULT, $reso / 6.4, $reso / $ratio / 6.4, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');


              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);
              Storage::cloud()->put($out_file, (string) $white_bg, 'public');

  //            header('Content-Type: image/jpeg');
  //              echo $white_bg;
  //             die();

              $mask_path = $overlays_dir . $product_code . '-2.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.5);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));

              $size = $reso / 2.55;
              $second->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);

              $white_bg->compositeImage($second, Imagick::COMPOSITE_DEFAULT, $reso / 3.2, $reso / $ratio / 13, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');


              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);

  //            header('Content-Type: image/jpeg');
  //              echo $white_bg;
  //             die();

              Storage::cloud()->put(str_replace('.jpg', '_2.jpg', $out_file), (string) $white_bg, 'public');

              return 2;
          case 'canvas-blkwrp-8x8':
              $first = $base;
              $second = new \Imagick();
              $second->readImageBlob(Storage::cloud()->get($filename));

              $mask_path = $overlays_dir . $product_code . '.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.5);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));

              $size = $reso / 2.13;
              $second->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);

              $white_bg->compositeImage($second, Imagick::COMPOSITE_DEFAULT, $reso / 3.76, $reso / $ratio / 3.69, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');


              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);
              Storage::cloud()->put($out_file, (string) $white_bg, 'public');

  //            header('Content-Type: image/jpeg');
  //              echo $white_bg;
  //             die();

              $mask_path = $overlays_dir . $product_code . '-2.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.5);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));

              $size = $reso / 3.4;
              $second->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);

              $white_bg->compositeImage($second, Imagick::COMPOSITE_DEFAULT, $reso / 2.8, $reso / $ratio / 26, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');


              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);

  //            header('Content-Type: image/jpeg');
  //              echo $white_bg;
  //             die();

              Storage::cloud()->put(str_replace('.jpg', '_2.jpg', $out_file), (string) $white_bg, 'public');

              return 2;
          case 'canvas-blk-wrap-10x8':
              $first = $base;
              $second = new \Imagick();
              $second->readImageBlob(Storage::cloud()->get($filename));

              $mask_path = $overlays_dir . $product_code . '.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.5);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));

              $size = $reso / 1.29;
              $second->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);

              $white_bg->compositeImage($second, Imagick::COMPOSITE_DEFAULT, $reso / 8.7, $reso / $ratio / 5.3, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');


              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);
              Storage::cloud()->put($out_file, (string) $white_bg, 'public');

  //            header('Content-Type: image/jpeg');
  //              echo $white_bg;
  //             die();

              $mask_path = $overlays_dir . $product_code . '-2.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.5);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));

              $size = $reso / 3.1;
              $second->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);

              $white_bg->compositeImage($second, Imagick::COMPOSITE_DEFAULT, $reso / 3.02, $reso / $ratio / 3.59, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');


              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);

  //            header('Content-Type: image/jpeg');
  //              echo $white_bg;
  //             die();

              Storage::cloud()->put(str_replace('.jpg', '_2.jpg', $out_file), (string) $white_bg, 'public');

              return 2;
          case 'canvswrp-blkwrp-16x12':
              $first = $base;
              $second = new \Imagick();
              $second->readImageBlob(Storage::cloud()->get($filename));

              $mask_path = $overlays_dir . $product_code . '.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.5);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));

              $size = $reso / 1.18;
              $second->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);

              $white_bg->compositeImage($second, Imagick::COMPOSITE_DEFAULT, $reso / 13, $reso / $ratio / 5.45, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');


              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);
              Storage::cloud()->put($out_file, (string) $white_bg, 'public');

  //            header('Content-Type: image/jpeg');
  //              echo $white_bg;
  //             die();

              $mask_path = $overlays_dir . $product_code . '-2.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.5);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));

              $size = $reso / 1.67;
              $second->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);

              $white_bg->compositeImage($second, Imagick::COMPOSITE_DEFAULT, $reso / 4.9, $reso / $ratio / 9.5, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');


              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);

  //            header('Content-Type: image/jpeg');
  //              echo $white_bg;
  //             die();

              Storage::cloud()->put(str_replace('.jpg', '_2.jpg', $out_file), (string) $white_bg, 'public');

              return 2;
          case 'canvas-blk-wrap-20x10':
              $first = $base;
              $second = new \Imagick();
              $second->readImageBlob(Storage::cloud()->get($filename));

              $mask_path = $overlays_dir . $product_code . '.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.5);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));

              $size = $reso / 1.15;
              $second->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);

              $white_bg->compositeImage($second, Imagick::COMPOSITE_DEFAULT, $reso / 15.3, $reso / $ratio / 3.53, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');


              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);
              Storage::cloud()->put($out_file, (string) $white_bg, 'public');

  //            header('Content-Type: image/jpeg');
  //              echo $white_bg;
  //             die();

              $mask_path = $overlays_dir . $product_code . '-2.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.5);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));

              $size = $reso / 1.33;
              $second->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);

              $white_bg->compositeImage($second, Imagick::COMPOSITE_DEFAULT, $reso / 7.8, $reso / $ratio / 4.8, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');


              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);

  //            header('Content-Type: image/jpeg');
  //              echo $white_bg;
  //             die();

              Storage::cloud()->put(str_replace('.jpg', '_2.jpg', $out_file), (string) $white_bg, 'public');

              return 2;
          case 'canvas-blk-wrp-16x24':
              $first = $base;
              $second = new \Imagick();
              $second->readImageBlob(Storage::cloud()->get($filename));

              $mask_path = $overlays_dir . $product_code . '.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.5);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));

              $size = $reso / 1.115;
              $second->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);

              $white_bg->compositeImage($second, Imagick::COMPOSITE_DEFAULT, $reso / 19, $reso / $ratio / 4.9, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');


              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);
              Storage::cloud()->put($out_file, (string) $white_bg, 'public');

  //            header('Content-Type: image/jpeg');
  //              echo $white_bg;
  //             die();

              $mask_path = $overlays_dir . $product_code . '-2.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.5);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));

              $size = $reso / 1.35;
              $second->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);

              $white_bg->compositeImage($second, Imagick::COMPOSITE_DEFAULT, $reso / 8, $reso / $ratio / 10, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');


              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);

  //            header('Content-Type: image/jpeg');
  //              echo $white_bg;
  //             die();

              Storage::cloud()->put(str_replace('.jpg', '_2.jpg', $out_file), (string) $white_bg, 'public');

              return 2;
          case 'phonecase-samsunggalaxy-note-7-finish':
              $second = new \Imagick();
              $second->readImageBlob(Storage::cloud()->get($filename));
              $third = new \Imagick();
              $third->readImageBlob(Storage::cloud()->get($filename));

              $first = $base;
              $mask_path = $overlays_dir . $product_code . ".png";
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
              $w = $first->getImageWidth();
              $h = $first->getImageHeight();
              $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $first->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);
              Storage::cloud()->put($out_file, (string) $first, 'public');

  //            header('Content-Type: image/jpeg');
  //              echo $first;
  //             die();


              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($overlays_dir . $product_code . '-2.png'));
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));

              $second->resizeImage($reso / 1.5, $reso / 1.5, Imagick::FILTER_BOX, 1, TRUE);

              $white_bg->compositeImage($second, Imagick::COMPOSITE_DEFAULT, $reso / 2.02, $reso / $ratio / 3.8, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');


              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);
              Storage::cloud()->put(str_replace('.jpg', '_3.jpg', $out_file), (string) $white_bg, 'public');

  //            header('Content-Type: image/jpeg');
  //              echo $white_bg;
  //             die();

              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($overlays_dir . $product_code . '-3.png'));
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));

              $third->resizeImage($reso / 1.35, $reso / 1.35, Imagick::FILTER_BOX, 1, TRUE);

              $white_bg->compositeImage($third, Imagick::COMPOSITE_DEFAULT, $reso / 3.53, $reso / $ratio / 6, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');


              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);
              Storage::cloud()->put(str_replace('.jpg', '_2.jpg', $out_file), (string) $white_bg, 'public');

  //                        header('Content-Type: image/jpeg');
  //              echo $white_bg;
  //             die();

              return 3;
          case 'phonecase-samsunggalaxy-s7-finish':
          case 'phonecase-samsunggalaxy-s7-edge-finish':
              $first = $base;
              $mask_path = $overlays_dir . $product_code . '.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
              $overlay_1 = fit_mask($first, $mask);
              Storage::cloud()->put($out_file, (string) $overlay_1, 'public');
              $second = clone $overlay_1;
              $third = clone $overlay_1;
              $mask_path = $overlays_dir . $product_code . '-2.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.3);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));
              $size = $reso / 1.54;
              $second->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);
              $white_bg->compositeImage($second, Imagick::COMPOSITE_DEFAULT, $reso / 2.84, $reso / $ratio / 3.13, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');
              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);
  //            header('Content-Type: image/jpeg');
  //              echo $white_bg;
  //             die();
              Storage::cloud()->put(str_replace('.jpg', '_3.jpg', $out_file), (string) $white_bg, 'public');
              $mask_path = $overlays_dir . $product_code . '-3.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.3);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));
              $size = $reso / 1.26;
              $third->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);
              $white_bg->compositeImage($third, Imagick::COMPOSITE_DEFAULT, $reso / 11.8, $reso / $ratio / 7.5, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');
              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);

  //            header('Content-Type: image/jpeg');
  //              echo $white_bg;
  //             die();
              Storage::cloud()->put(str_replace('.jpg', '_2.jpg', $out_file), (string) $white_bg, 'public');
              return 3;
              break;
          case 'phonecase-galaxys8-plus-finish':
              $first = $base;
              $mask_path = $overlays_dir . $product_code . '.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
              $overlay_1 = fit_mask($first, $mask);
              Storage::cloud()->put($out_file, (string) $overlay_1, 'public');
              $second = clone $overlay_1;
              $third = clone $overlay_1;
              $mask_path = $overlays_dir . $product_code . '-2.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.3);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));
              $size = $reso / 1.4;
              $second->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);
              $white_bg->compositeImage($second, Imagick::COMPOSITE_DEFAULT, $reso / 3.06, $reso / $ratio / 3.9, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');
              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);
  //            header('Content-Type: image/jpeg');
  //              echo $white_bg;
  //             die();
              Storage::cloud()->put(str_replace('.jpg', '_3.jpg', $out_file), (string) $white_bg, 'public');
              $mask_path = $overlays_dir . $product_code . '-3.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.3);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));
              $size = $reso / 1.21;
              $third->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);
              $white_bg->compositeImage($third, Imagick::COMPOSITE_DEFAULT, $reso / 15, $reso / $ratio / 9.8, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');
              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);

  //            header('Content-Type: image/jpeg');
  //              echo $white_bg;
  //             die();
              Storage::cloud()->put(str_replace('.jpg', '_2.jpg', $out_file), (string) $white_bg, 'public');
              return 3;
          case 'phonecase-galaxys8-finish':
              $first = $base;
              $mask_path = $overlays_dir . $product_code . '.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
              $overlay_1 = fit_mask($first, $mask);
              Storage::cloud()->put($out_file, (string) $overlay_1, 'public');
              $second = clone $overlay_1;
              $third = clone $overlay_1;
              $mask_path = $overlays_dir . $product_code . '-2.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.3);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));
              $size = $reso / 1.49;
              $second->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);
              $white_bg->compositeImage($second, Imagick::COMPOSITE_DEFAULT, $reso / 2.72, $reso / $ratio / 3.16, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');
              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);
  //            header('Content-Type: image/jpeg');
  //              echo $white_bg;
  //             die();
              Storage::cloud()->put(str_replace('.jpg', '_3.jpg', $out_file), (string) $white_bg, 'public');
              $mask_path = $overlays_dir . $product_code . '-3.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.3);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));
              $size = $reso / 1.2;
              $third->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);
              $white_bg->compositeImage($third, Imagick::COMPOSITE_DEFAULT, $reso / 15.9, $reso / $ratio / 10.5, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');
              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);

  //            header('Content-Type: image/jpeg');
  //              echo $white_bg;
  //             die();
              Storage::cloud()->put(str_replace('.jpg', '_2.jpg', $out_file), (string) $white_bg, 'public');
              return 3;
              break;
          case 'phonecase-samsung-galaxy-s9':
              $first = $base;
              $mask_path = $overlays_dir . $product_code . '.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
              $overlay_1 = fit_mask($first, $mask);
              Storage::cloud()->put($out_file, (string) $overlay_1, 'public');
              $second = clone $overlay_1;
              $third = clone $overlay_1;
              $mask_path = $overlays_dir . $product_code . '-2.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.3);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));
              $size = $reso / 1.72;
              $second->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);
              $white_bg->compositeImage($second, Imagick::COMPOSITE_DEFAULT, $reso / 2.34, $reso / $ratio / 3.8, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');
              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);
  //            header('Content-Type: image/jpeg');
  //              echo $white_bg;
  //             die();
              Storage::cloud()->put(str_replace('.jpg', '_3.jpg', $out_file), (string) $white_bg, 'public');
              $mask_path = $overlays_dir . $product_code . '-3.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.3);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));
              $size = $reso / 1.125;
              $third->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);
              $white_bg->compositeImage($third, Imagick::COMPOSITE_DEFAULT, $reso / 100, $reso / $ratio / 25, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');
              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);

  //            header('Content-Type: image/jpeg');
  //              echo $white_bg;
  //             die();
              Storage::cloud()->put(str_replace('.jpg', '_2.jpg', $out_file), (string) $white_bg, 'public');
              return 3;
          case 'phonecase-samsung-galaxy-s9-plus':
              $first = $base;
              $mask_path = $overlays_dir . $product_code . '.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
              $overlay_1 = fit_mask($first, $mask);
              Storage::cloud()->put($out_file, (string) $overlay_1, 'public');
              $second = clone $overlay_1;
              $third = clone $overlay_1;
              $mask_path = $overlays_dir . $product_code . '-2.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.3);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));
              $size = $reso / 1.58;
              $second->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);
              $white_bg->compositeImage($second, Imagick::COMPOSITE_DEFAULT, $reso / 2.47, $reso / $ratio / 3.9, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');
              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);
  //            header('Content-Type: image/jpeg');
  //              echo $white_bg;
  //             die();
              Storage::cloud()->put(str_replace('.jpg', '_3.jpg', $out_file), (string) $white_bg, 'public');
              $mask_path = $overlays_dir . $product_code . '-3.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.3);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));
              $size = $reso / 1.09;
              $third->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);
              $white_bg->compositeImage($third, Imagick::COMPOSITE_DEFAULT, $reso / 43, $reso / $ratio / 40, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');
              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);

  //            header('Content-Type: image/jpeg');
  //              echo $white_bg;
  //             die();
              Storage::cloud()->put(str_replace('.jpg', '_2.jpg', $out_file), (string) $white_bg, 'public');
              return 3;
          case 'phonecase-samsungs6-edge-finish':
              $second = new \Imagick();
              $second->readImageBlob(Storage::cloud()->get($filename));
              $third = new \Imagick();
              $third->readImageBlob(Storage::cloud()->get($filename));

              $first = $base;
              $mask_path = $overlays_dir . $product_code . ".png";
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
              $w = $first->getImageWidth();
              $h = $first->getImageHeight();
              $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              $first->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);
              Storage::cloud()->put($out_file, (string) $first, 'public');

  //            header('Content-Type: image/jpeg');
  //              echo $first;
  //             die();


              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($overlays_dir . $product_code . '-2.png'));
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));

              $second->resizeImage($reso / 1.6, $reso / 1.6, Imagick::FILTER_BOX, 1, TRUE);

              $white_bg->compositeImage($second, Imagick::COMPOSITE_DEFAULT, $reso / 2.1, $reso / $ratio / 3.3, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');


              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);
              Storage::cloud()->put(str_replace('.jpg', '_3.jpg', $out_file), (string) $white_bg, 'public');

  //            header('Content-Type: image/jpeg');
  //              echo $white_bg;
  //             die();

              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($overlays_dir . $product_code . '-3.png'));
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));

              $third->resizeImage($reso / 1.3, $reso / 1.3, Imagick::FILTER_BOX, 1, TRUE);

              $white_bg->compositeImage($third, Imagick::COMPOSITE_DEFAULT, $reso / 4.1, $reso / $ratio / 8, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');


              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);
              Storage::cloud()->put(str_replace('.jpg', '_2.jpg', $out_file), (string) $white_bg, 'public');

  //            header('Content-Type: image/jpeg');
  //              echo $white_bg;
  //            die();

              return 3;
          case 'phonecase-samsungs6-finish':
              $second = new \Imagick();
              $second->readImageBlob(Storage::cloud()->get($filename));
              $third = new \Imagick();
              $third->readImageBlob(Storage::cloud()->get($filename));

              $first = $base;
              $mask_path = $overlays_dir . $product_code . ".png";
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
              $w = $first->getImageWidth();
              $h = $first->getImageHeight();
              $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              $first->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);
              Storage::cloud()->put($out_file, (string) $first, 'public');

  //            header('Content-Type: image/jpeg');
  //            echo $first;
  //            die();


              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($overlays_dir . $product_code . '-2.png'));
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));

              $second->resizeImage($reso / 1.6, $reso / 1.6, Imagick::FILTER_BOX, 1, TRUE);

              $white_bg->compositeImage($second, Imagick::COMPOSITE_DEFAULT, $reso / 2.1, $reso / $ratio / 3, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');


              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);
              Storage::cloud()->put(str_replace('.jpg', '_3.jpg', $out_file), (string) $white_bg, 'public');

  //            header('Content-Type: image/jpeg');
  //              echo $white_bg;
  //             die();

              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($overlays_dir . $product_code . '-3.png'));
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));
              $size = $reso / 1.35;
              $third->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);

              $white_bg->compositeImage($third, Imagick::COMPOSITE_DEFAULT, $reso / 3.92, $reso / $ratio / 6, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');


              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);
              Storage::cloud()->put(str_replace('.jpg', '_2.jpg', $out_file), (string) $white_bg, 'public');

  //            header('Content-Type: image/jpeg');
  //            echo $white_bg;
  //            die();

              return 3;
          case 'phonecase-iphone-6-tough-finish':
          case 'phonecase-iphone-6s-tough-finish':
              $first = $base;
              $mask_path = $overlays_dir . $product_code . '.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
              $overlay_1 = fit_mask($first, $mask);
              Storage::cloud()->put($out_file, (string) $overlay_1, 'public');
              $second = clone $overlay_1;
              $third = clone $overlay_1;
              $mask_path = $overlays_dir . $product_code . '-2.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.3);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));
              $size = $reso / 1.76;
              $second->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);
              $white_bg->compositeImage($second, Imagick::COMPOSITE_DEFAULT, $reso / 16.4, $reso / $ratio / 2.55, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');
              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);
  //            header('Content-Type: image/jpeg');
  //              echo $white_bg;
  //             die();
              Storage::cloud()->put(str_replace('.jpg', '_3.jpg', $out_file), (string) $white_bg, 'public');
              $mask_path = $overlays_dir . $product_code . '-3.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.3);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));
              $size = $reso / 1.32;
              $third->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);
              $white_bg->compositeImage($third, Imagick::COMPOSITE_DEFAULT, $reso / 14.8, $reso / $ratio / 7.0, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');
              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);

  //            header('Content-Type: image/jpeg');
  //              echo $white_bg;
  //             die();
              Storage::cloud()->put(str_replace('.jpg', '_2.jpg', $out_file), (string) $white_bg, 'public');
              return 3;
              break;
          case 'phonecase-samsung-s6-edge-tough-finish':
          case 'phonecase-samsung-s6-tough-finish':
              $first = $base;
              $mask_path = $overlays_dir . $product_code . '.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
              $overlay_1 = fit_mask($first, $mask);
              Storage::cloud()->put($out_file, (string) $overlay_1, 'public');
              $second = clone $overlay_1;
              $third = clone $overlay_1;
              $mask_path = $overlays_dir . $product_code . '-2.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.3);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));
              $size = $reso / 1.46;
              $second->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);
              $white_bg->compositeImage($second, Imagick::COMPOSITE_DEFAULT, $reso / 2.2, $reso / $ratio / 3.43, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');
              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);
  //            header('Content-Type: image/jpeg');
  //              echo $white_bg;
  //             die();
              Storage::cloud()->put(str_replace('.jpg', '_3.jpg', $out_file), (string) $white_bg, 'public');
              $mask_path = $overlays_dir . $product_code . '-3.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.3);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));
              $size = $reso / 1.26;
              $third->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);
              $white_bg->compositeImage($third, Imagick::COMPOSITE_DEFAULT, $reso / 4.2, $reso / $ratio / 7.5, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');
              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);
  //
  //            header('Content-Type: image/jpeg');
  //              echo $white_bg;
  //             die();
              Storage::cloud()->put(str_replace('.jpg', '_2.jpg', $out_file), (string) $white_bg, 'public');
              return 3;
          case 'phonecase-iphonex-finish':
              $first = $base;
              $mask_path = $overlays_dir . $product_code . '.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
              $overlay_1 = fit_mask($first, $mask);
              Storage::cloud()->put($out_file, (string) $overlay_1, 'public');
              $second = clone $overlay_1;
              $third = clone $overlay_1;
              $mask_path = $overlays_dir . $product_code . '-2.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.3);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));
              $size = $reso / 1.23;
              $second->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);
              $white_bg->compositeImage($second, Imagick::COMPOSITE_DEFAULT, $reso / 14, $reso / $ratio / 6.9, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');
              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);
  //            header('Content-Type: image/jpeg');
  //              echo $white_bg;
  //             die();
              Storage::cloud()->put(str_replace('.jpg', '_3.jpg', $out_file), (string) $white_bg, 'public');
              $mask_path = $overlays_dir . $product_code . '-3.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.3);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));
              $size = $reso / 1.48;
              $third->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);
              $white_bg->compositeImage($third, Imagick::COMPOSITE_DEFAULT, $reso / 45, $reso / $ratio / 3.3, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');
              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);

  //            header('Content-Type: image/jpeg');
  //              echo $white_bg;
  //             die();
              Storage::cloud()->put(str_replace('.jpg', '_2.jpg', $out_file), (string) $white_bg, 'public');
              return 3;
          case 'phonecase-iphone8-finish':
              $first = $base;
              $mask_path = $overlays_dir . $product_code . '.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
              $overlay_1 = fit_mask($first, $mask);
              Storage::cloud()->put($out_file, (string) $overlay_1, 'public');
              $second = clone $overlay_1;
              $third = clone $overlay_1;
              $mask_path = $overlays_dir . $product_code . '-2.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.3);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));
              $size = $reso / 1.35;
              $second->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);
              $white_bg->compositeImage($second, Imagick::COMPOSITE_DEFAULT, $reso / 8.8, $reso / $ratio / 6.1, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');
              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);
  //            header('Content-Type: image/jpeg');
  //              echo $white_bg;
  //             die();
              Storage::cloud()->put(str_replace('.jpg', '_3.jpg', $out_file), (string) $white_bg, 'public');
              $mask_path = $overlays_dir . $product_code . '-3.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.3);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));
              $size = $reso / 1.7;
              $third->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);
              $white_bg->compositeImage($third, Imagick::COMPOSITE_DEFAULT, $reso / 15.7, $reso / $ratio / 2.73, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');
              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);

  //            header('Content-Type: image/jpeg');
  //            echo $white_bg;
  //            die();
              Storage::cloud()->put(str_replace('.jpg', '_2.jpg', $out_file), (string) $white_bg, 'public');
              return 3;
          case 'phonecase-iphone8-plus-finish':
              $first = $base;
              $mask_path = $overlays_dir . $product_code . '.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
              $overlay_1 = fit_mask($first, $mask);
              Storage::cloud()->put($out_file, (string) $overlay_1, 'public');
              $second = clone $overlay_1;
              $third = clone $overlay_1;
              $mask_path = $overlays_dir . $product_code . '-2.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.3);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));
              $size = $reso / 1.3;
              $second->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);
              $white_bg->compositeImage($second, Imagick::COMPOSITE_DEFAULT, $reso / 10.2, $reso / $ratio / 6.5, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');
              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);
  //            header('Content-Type: image/jpeg');
  //              echo $white_bg;
  //             die();
              Storage::cloud()->put(str_replace('.jpg', '_3.jpg', $out_file), (string) $white_bg, 'public');
              $mask_path = $overlays_dir . $product_code . '-3.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.5);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));
              $size = $reso / 1.43;
              $third->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);
              $white_bg->compositeImage($third, Imagick::COMPOSITE_DEFAULT, $reso / 1000, $reso / $ratio / 3.65, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');
              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);

  //            header('Content-Type: image/jpeg');
  //              echo $white_bg;
  //             die();
              Storage::cloud()->put(str_replace('.jpg', '_2.jpg', $out_file), (string) $white_bg, 'public');
              return 3;
          case 'phonecase-iphone7-plus-finish':
              $first = $base;
              $mask_path = $overlays_dir . $product_code . '.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
              $overlay_1 = fit_mask($first, $mask);
              Storage::cloud()->put($out_file, (string) $overlay_1, 'public');
              $second = clone $overlay_1;
              $third = clone $overlay_1;
              $mask_path = $overlays_dir . $product_code . '-2.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.3);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));
              $size = $reso / 1.34;
              $second->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);
              $white_bg->compositeImage($second, Imagick::COMPOSITE_DEFAULT, $reso / 9.3, $reso / $ratio / 5.8, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');
              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);
  //            header('Content-Type: image/jpeg');
  //              echo $white_bg;
  //             die();
              Storage::cloud()->put(str_replace('.jpg', '_3.jpg', $out_file), (string) $white_bg, 'public');
              $mask_path = $overlays_dir . $product_code . '-3.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.3);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));
              $size = $reso / 1.555;
              $third->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);
              $white_bg->compositeImage($third, Imagick::COMPOSITE_DEFAULT, $reso / 23, $reso / $ratio / 3.27, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');
              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);

  //            header('Content-Type: image/jpeg');
  //              echo $white_bg;
  //             die();
              Storage::cloud()->put(str_replace('.jpg', '_2.jpg', $out_file), (string) $white_bg, 'public');
              return 3;
          case 'phonecase-iphone7-finish':
              $first = $base;
              $mask_path = $overlays_dir . $product_code . '.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
              $overlay_1 = fit_mask($first, $mask);
              Storage::cloud()->put($out_file, (string) $overlay_1, 'public');
              $second = clone $overlay_1;
              $third = clone $overlay_1;
              $mask_path = $overlays_dir . $product_code . '-2.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.3);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));
              $size = $reso / 1.31;
              $second->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);
              $white_bg->compositeImage($second, Imagick::COMPOSITE_DEFAULT, $reso / 10, $reso / $ratio / 6.1, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');
              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);
  //            header('Content-Type: image/jpeg');
  //              echo $white_bg;
  //             die();
              Storage::cloud()->put(str_replace('.jpg', '_3.jpg', $out_file), (string) $white_bg, 'public');
              $mask_path = $overlays_dir . $product_code . '-3.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.3);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));
              $size = $reso / 1.66;
              $third->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);
              $white_bg->compositeImage($third, Imagick::COMPOSITE_DEFAULT, $reso / 30, $reso / $ratio / 2.6, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');
              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);

  //            header('Content-Type: image/jpeg');
  //              echo $white_bg;
  //             die();
              Storage::cloud()->put(str_replace('.jpg', '_2.jpg', $out_file), (string) $white_bg, 'public');
              return 3;
          case 'phonecase-iphone-6s-plus-regular-finish':
          case 'phonecase-iphone-6s-plus-tough-finish':
          case 'phonecase-iphone-6-plus-tough-finish':
              $first = $base;
              $mask_path = $overlays_dir . $product_code . '.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
              $overlay_1 = fit_mask($first, $mask);
              Storage::cloud()->put($out_file, (string) $overlay_1, 'public');
              $second = clone $overlay_1;
              $third = clone $overlay_1;
              $mask_path = $overlays_dir . $product_code . '-2.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.3);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));
              $size = $reso / 1.35;
              $second->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);
              $white_bg->compositeImage($second, Imagick::COMPOSITE_DEFAULT, $reso / 8.7, $reso / $ratio / 5.9, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');
              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);
  //            header('Content-Type: image/jpeg');
  //              echo $white_bg;
  //             die();
              Storage::cloud()->put(str_replace('.jpg', '_3.jpg', $out_file), (string) $white_bg, 'public');
              $mask_path = $overlays_dir . $product_code . '-3.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.3);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));
              $size = $reso / 1.58;
              $third->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);
              $white_bg->compositeImage($third, Imagick::COMPOSITE_DEFAULT, $reso / 23.0, $reso / $ratio / 3.2, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');
              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);

  //            header('Content-Type: image/jpeg');
  //              echo $white_bg;
  //             die();
              Storage::cloud()->put(str_replace('.jpg', '_2.jpg', $out_file), (string) $white_bg, 'public');
              return 3;
              break;
          case 'phonecase-iphone-6s-regular-finish':
          case 'phonecase-iphone6-finish':
              $product_code = 'phonecase-iphone-6s-regular-finish';
              $second = new \Imagick();
              $second->readImageBlob(Storage::cloud()->get($filename));
              $third = new \Imagick();
              $third->readImageBlob(Storage::cloud()->get($filename));

              $first = $base;
              $mask_path = $overlays_dir . $product_code . ".png";
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
              $w = $first->getImageWidth();
              $h = $first->getImageHeight();
              $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              $first->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);
              Storage::cloud()->put($out_file, (string) $first, 'public');

  //            header('Content-Type: image/jpeg');
  //            echo $first;
  //            die();



              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($overlays_dir . $product_code . '-2.png'));
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));

              $second->resizeImage($reso / 1.8, $reso / 1.8, Imagick::FILTER_BOX, 1, TRUE);

              $white_bg->compositeImage($second, Imagick::COMPOSITE_DEFAULT, $reso / 6.35, $reso / $ratio / 2.5, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');


              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);
              Storage::cloud()->put(str_replace('.jpg', '_3.jpg', $out_file), (string) $white_bg, 'public');

  //            header('Content-Type: image/jpeg');
  //            echo $white_bg;
  //            die();

              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($overlays_dir . $product_code . '-3.png'));
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));

              $third->resizeImage($reso / 1.3, $reso / 1.3, Imagick::FILTER_BOX, 1, TRUE);

              $white_bg->compositeImage($third, Imagick::COMPOSITE_DEFAULT, $reso / 5.3, $reso / $ratio / 6.5, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');


              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);
              Storage::cloud()->put(str_replace('.jpg', '_2.jpg', $out_file), (string) $white_bg, 'public');

  //            header('Content-Type: image/jpeg');
  //              echo $white_bg;
  //            die();
              return 3;
          case 'canvas-blk-wrap-16x20':
              $first = $base;
              $second = new \Imagick();
              $second->readImageBlob(Storage::cloud()->get($filename));

              $mask_path = $overlays_dir . $product_code . '.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.5);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));

              $size = $reso / 1.14;
              $second->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);

              $white_bg->compositeImage($second, Imagick::COMPOSITE_DEFAULT, $reso / 6.7, $reso / $ratio / 15.5, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');


              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);
              Storage::cloud()->put($out_file, (string) $white_bg, 'public');

  //            header('Content-Type: image/jpeg');
  //              echo $white_bg;
  //             die();

              $mask_path = $overlays_dir . $product_code . '-2.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.5);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));

              $size = $reso / 2.28;
              $second->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);

              $white_bg->compositeImage($second, Imagick::COMPOSITE_DEFAULT, $reso / 3.04, $reso / $ratio / 6.9, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');


              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);

  //            header('Content-Type: image/jpeg');
  //              echo $white_bg;
  //             die();

              Storage::cloud()->put(str_replace('.jpg', '_2.jpg', $out_file), (string) $white_bg, 'public');

              return 2;
          case 'canvswrp-blkwrp-12x18':
              $first = $base;
              $second = new \Imagick();
              $second->readImageBlob(Storage::cloud()->get($filename));

              $mask_path = $overlays_dir . $product_code . '.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.5);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));

              $size = $reso / 1.15;
              $second->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);

              $white_bg->compositeImage($second, Imagick::COMPOSITE_DEFAULT, $reso / 4.8, $reso / $ratio / 16, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');


              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);
              Storage::cloud()->put($out_file, (string) $white_bg, 'public');

  //            header('Content-Type: image/jpeg');
  //              echo $white_bg;
  //             die();

              $mask_path = $overlays_dir . $product_code . '-2.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.5);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));

              $size = $reso / 2.5;
              $second->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);

              $white_bg->compositeImage($second, Imagick::COMPOSITE_DEFAULT, $reso / 2.79, $reso / $ratio / 5.55, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');


              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);

  //            header('Content-Type: image/jpeg');
  //              echo $white_bg;
  //             die();

              Storage::cloud()->put(str_replace('.jpg', '_2.jpg', $out_file), (string) $white_bg, 'public');

              return 2;
          case 'canvswrp-blkwrp-11x14':
              $first = $base;
              $second = new \Imagick();
              $second->readImageBlob(Storage::cloud()->get($filename));

              $mask_path = $overlays_dir . $product_code . '.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.5);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));

              $size = $reso / 1.2;
              $second->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);

              $white_bg->compositeImage($second, Imagick::COMPOSITE_DEFAULT, $reso / 5.8, $reso / $ratio / 11.9, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');


              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);

              Storage::cloud()->put($out_file, (string) $white_bg, 'public');

  //            header('Content-Type: image/jpeg');
  //              echo $white_bg;
  //             die();

              $mask_path = $overlays_dir . $product_code . '-2.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.5);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));

              $size = $reso / 3.1;
              $second->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);

              $white_bg->compositeImage($second, Imagick::COMPOSITE_DEFAULT, $reso / 2.59, $reso / $ratio / 3.98, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');


              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);

  //            header('Content-Type: image/jpeg');
  //              echo $white_bg;
  //             die();

              Storage::cloud()->put(str_replace('.jpg', '_2.jpg', $out_file), (string) $white_bg, 'public');

              return 2;
          case 'wood-print-7x5':

              $first = $base;
              $second = new \Imagick();
              $second->readImageBlob(Storage::cloud()->get($filename));
              $third = new \Imagick();
              $third->readImageBlob(Storage::cloud()->get($filename));


              $mask_path = $overlays_dir . $product_code . ".png";
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
              $w = $first->getImageWidth();
              $h = $first->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $first->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);
              Storage::cloud()->put($out_file, (string) $first, 'public');

              $mask_path = $overlays_dir . $product_code . '-2.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));

              $second->resizeImage($reso / 2.6, $reso / 2.6, Imagick::FILTER_BOX, 1, TRUE);

              $white_bg->compositeImage($second, Imagick::COMPOSITE_DEFAULT, $reso / 3.25, $reso / $ratio / 3.76, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');


              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);
              Storage::cloud()->put(str_replace('.jpg', '_2.jpg', $out_file), (string) $white_bg, 'public');


              $mask_path = $overlays_dir . $product_code . '-3.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));

              $third->resizeImage($reso / 12, $reso / 12, Imagick::FILTER_BOX, 1, TRUE);

              $white_bg->compositeImage($third, Imagick::COMPOSITE_DEFAULT, $reso / 2.14, $reso / $ratio / 3.02, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');


              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);
              Storage::cloud()->put($out_file, (string) $white_bg, 'public');


              //header('Content-Type: image/jpeg');
              // echo $white_bg;
              //die();
              return 3;
          case 'floormat-36x24-nonslip':
              $first = $base;
              $mask_path = $overlays_dir . $product_code . '.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
              $overlay_1 = fit_mask($first, $mask);
              Storage::cloud()->put($out_file, (string) $overlay_1, 'public');


              $second = clone $overlay_1;
              $mask_path = $overlays_dir . $product_code . '-2.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.3);
              $second->resizeImage($reso, $reso, Imagick::FILTER_BOX, 1, TRUE);

              $w = $second->getImageWidth();
              $h = $second->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $second->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);

  //            header('Content-Type: image/jpeg');
  //              echo $second;
  //             die();

              Storage::cloud()->put(str_replace('.jpg', '_2.jpg', $out_file), (string) $second, 'public');

              return 2;

          case 'throw-pillow-sewn-16x16':
          case 'throw-pillow-sewn-18x18':

              $first = $base;
              $mask_path = $overlays_dir . $product_code . '.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
              $overlay_1 = fit_mask($first, $mask);
              Storage::cloud()->put($out_file, (string) $overlay_1, 'public');

  //header('Content-Type: image/jpeg');
  //            echo $overlay_1;
  //            die();

              $second = clone $overlay_1;
              $mask_path = $overlays_dir . $product_code . '-2.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.3);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));


              $size = $reso / 1.74;
              $second->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);

              $white_bg->compositeImage($second, Imagick::COMPOSITE_DEFAULT, $reso / 5.05, $reso / $ratio / 7.5, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');


              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);
              Storage::cloud()->put(str_replace('.jpg', '_2.jpg', $out_file), (string) $white_bg, 'public');

  //                header('Content-Type: image/jpeg');
  //                echo $white_bg;
  //                die();

              return 2;
              break;
          case 'throw-pillow-sewn-20x14':

              $first = $base;
              $mask_path = $overlays_dir . $product_code . '.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
              $overlay_1 = fit_mask($first, $mask);
              Storage::cloud()->put($out_file, (string) $overlay_1, 'public');



              $second = clone $base;
              $third = clone $base;
              $mask_path = $overlays_dir . $product_code . '-2.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.3);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));


              $size = $reso / 1.20;
              $second->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);

              $white_bg->compositeImage($second, Imagick::COMPOSITE_DEFAULT, $reso / 9.5, $reso / $ratio / 4.9, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');


              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);
              Storage::cloud()->put(str_replace('.jpg', '_2.jpg', $out_file), (string) $white_bg, 'public');

  //            header('Content-Type: image/jpeg');
  //            echo $white_bg;
  //            die();

              $mask_path = $overlays_dir . $product_code . '-mail.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.8);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $reso = 650;
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));

              $size = $reso / 2.2;
              $third->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);
              $third->setImageOpacity(0.7);

              $white_bg->compositeImage($third, Imagick::COMPOSITE_DEFAULT, $reso / 5.6, $reso / $ratio / 5.5, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');


              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);
              Storage::cloud()->put(str_replace('.jpg', '_mail.jpg', $out_file), (string) $white_bg, 'public');

  //            header('Content-Type: image/jpeg');
  //            echo $white_bg;
  //            die();

              return 2;
              break;
          case 'Mug-11oz':

          case 'Mug-15oz':
          case 'mug-15oz':


              $second = new \Imagick();
              $second->readImageBlob(Storage::cloud()->get($filename));
              exec($fred_scripts_dir . "cylinderize -m vertical -r " . (int) ($reso / 4.4) . " -l " . ($reso / 1.7) . " -w 100 -p 6 -d both -e 2.5 -a -75 -v background -b none -f none " . $filename . ' ' . $filename . ' 2>&1', $out, $returnval);
              exec($fred_scripts_dir . 'aspect ' . $reso . 'x' . $reso . ' -m pad -c white ' . $filename . ' ' . $filename . ' 2>&1', $out, $returnval);

              $first = $base;

              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($overlays_dir . 'Mug.png'));
              $w = $first->getImageWidth();
              $h = $first->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $first->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);
              Storage::cloud()->put($out_file, (string) $first, 'public');

              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($overlays_dir . 'Mug-2.png'));
              $second->resizeImage($reso / 1.48, $reso / 1.48, Imagick::FILTER_BOX, 1, TRUE);
              $ratio = $second->getImageWidth() / $second->getImageHeight();
              $white_bg = new \Imagick();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));
              $white_bg->compositeImage($second, Imagick::COMPOSITE_DEFAULT, $reso * 0.16, $reso / $ratio * 0.13, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');


              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);
              Storage::cloud()->put(str_replace('.jpg', '_2.jpg', $out_file), (string) $white_bg, 'public');

  //            header('Content-Type: image/jpeg');
  //            echo $white_bg;
  //            die();

              return 2;


          case 'Mug-White-11oz':
          case 'Mug-Ceramic-11oz-White':
          case 'StandardMug-FullImage-11oz':

              $w = $base->getImageWidth();
              $h = $base->getImageHeight();


              exec($fred_scripts_dir . "cylinderize -m vertical -r " . (int) ($reso / 4.4) . " -l " . ($reso / 1.7) . " -w 100 -p 6 -d both -e 2.5 -a -40 -v background -b none -f none " . $filename . ' ' . $filename . ' 2>&1', $out, $returnval);
              exec($fred_scripts_dir . 'aspect ' . $reso . 'x' . $reso . ' -m pad -c white ' . $filename . ' ' . $filename . ' 2>&1', $out, $returnval);
              $base = new Imagick($filename);
              $product_code = 'Mug';

              break;
          case 'tshirt_Anvil':


              $second = new \Imagick();
              $second->readImageBlob(Storage::cloud()->get($filename));

              $first = $base;
              $mask_path = $overlays_dir . $product_code_original . ".png";
              $base = new Imagick($mask_path);
              $first = $base;
              $w = $base->getImageWidth();
              $h = $base->getImageHeight();
              $first->resizeImage(470, 470, Imagick::FILTER_BOX, 1, TRUE);
  //    $base->resizeImage($reso, $reso, Imagick::FILTER_BOX , 1, true);
              $base->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 290, 210, Imagick::CHANNEL_ALPHA);
              $base->writeImage($out_file);





              $second->resizeImage($reso / 2.6, $reso / 2.6, Imagick::FILTER_BOX, 1, TRUE);



              $second->writeImage(str_replace('.jpg', '_2.jpg', $out_file));


              // header('Content-Type: image/jpeg');
              // echo $white_bg;
              // die();
              return 2;




              return 1;
              break;
          case 'fb-cover-photo':
              Storage::cloud()->put($out_file, (string) $base, 'public');
              return 1;
              break;
          case 'tshirt-anvil-980'://daniel sunday work and fun !!!! good luck!!
              $counter = 0;
              if (!$which_previews)
                  $which_previews = [1, 2, 3, 4];
              if (in_array('4', $which_previews)) {
                  $first = clone $base;
                  $white_bg = new \Imagick();
                  $white_bg->newImage(1000, 1000, new ImagickPixel('white'));
                  $white_bg->setImageFormat('jpg');
                  $first->resizeImage(1000, 1000, Imagick::FILTER_BOX, 1, 1);
                  $x = (1000 - $first->getImageWidth()) / 2;
                  $white_bg->compositeImage($first, Imagick::COMPOSITE_DEFAULT, $x, 0);
                  if (count($which_previews) == 1) {
                      Storage::cloud()->put($out_file, (string) $white_bg, 'public');
                      return 1;
                  }
                  Storage::cloud()->put(str_replace('.jpg', '_4.jpg', $out_file), (string) $white_bg, 'public');

                  $counter++;
              }

              $img_trans = clone $base;
              $img_trans->setimageformat('png');
              $img_trans->transparentPaintImage(
                      '#ffffff', 0, 7000, false
              );
              $img_trans->evaluateImage(Imagick::EVALUATE_MULTIPLY, 0.8, Imagick::CHANNEL_ALPHA);

              $img = $img_trans;
              if (in_array('1', $which_previews)) {
                  $first = clone $img_trans;
                  $mask = new \Imagick();
                  $mask->readImageBlob(Storage::cloud()->get($overlays_dir . $product_code_original . '-' . $variance->color . ".png"));
                  $ratio = $mask->getImageWidth() / $mask->getImageHeight();
                  $mask->resizeImage($reso, $reso, Imagick::FILTER_BOX, 1, 1);
                  $size = $reso / 2.3;
                  $first->resizeImage($size, $size, Imagick::FILTER_BOX, 1, 1);
                  $mask->compositeImage($first, Imagick::COMPOSITE_DEFAULT, $reso / 3.03, $reso / $ratio / 5.4, Imagick::CHANNEL_ALPHA);
                  $mask->setImageFormat('jpg');
                  Storage::cloud()->put($out_file, (string) $mask, 'public');
                  $counter++;
              }
              if (in_array('2', $which_previews)) {
                  $second = clone $img_trans;
                  $mask = new \Imagick();
                  $mask->readImageBlob(Storage::cloud()->get($overlays_dir . $product_code_original . '-' . $variance->color . "-2.jpg"));
                  $ratio = $mask->getImageWidth() / $mask->getImageHeight();
                  $mask->resizeImage($reso, $reso, Imagick::FILTER_BOX, 1, 1);
                  $size = $reso / 2.45;
                  $second->resizeImage($size, $size, Imagick::FILTER_BOX, 1, 1);
                  $mask->compositeImage($second, Imagick::COMPOSITE_DEFAULT, $reso / 2.78, $reso / $ratio / 6.1, Imagick::CHANNEL_ALPHA);
                  $mask->setImageFormat('jpg');
                  if (count($which_previews) == 1) {
                      Storage::cloud()->put($out_file, (string) $mask, 'public');
                      return 1;
                  }
                  Storage::cloud()->put(str_replace('.jpg', '_2.jpg', $out_file), (string) $mask, 'public');
                  $counter++;
              }
              if (in_array('3', $which_previews)) {
                  $third = clone $img_trans;
                  $mask = new \Imagick();
                  $mask->readImageBlob(Storage::cloud()->get($overlays_dir . $product_code_original . '-' . $variance->color . "-3.jpg"));
                  $ratio = $mask->getImageWidth() / $mask->getImageHeight();
                  $mask->resizeImage($reso, $reso, Imagick::FILTER_BOX, 1, 1);
                  $size = $reso / 2.8;
                  $third->resizeImage($size, $size, Imagick::FILTER_BOX, 1, 1);
                  $mask->compositeImage($third, Imagick::COMPOSITE_DEFAULT, $reso / 2.9, $reso / $ratio / 5.1, Imagick::CHANNEL_ALPHA);
                  $mask->setImageFormat('jpg');
                  if (count($which_previews) == 1) {
                      Storage::cloud()->put($out_file, (string) $mask, 'public');
                      return 1;
                  }
                  Storage::cloud()->put(str_replace('.jpg', '_3.jpg', $out_file), (string) $mask, 'public');
                  $counter++;
              }
  //            if (!in_array('1', $which_previews) && count($which_previews) == 1) {
  //                for ($index = 0; $index < 4; $index++) {
  //                    if (Storage::cloud()->has(str_replace('.jpg', "_$index.jpg", $out_file)))
  //                        Storage::cloud()->put($out_file, Storage::cloud()->get(str_replace('.jpg', "_$index.jpg", $out_file)), 'public');
  //                }
  //            }
  //            header('Content-Type: image/jpeg');
  //            echo $mask;
  //            die();


              return $counter;
              break;
          case 'long-sleeve-alstyle-1304':
              $counter = 0;
              if (!$which_previews)
                  $which_previews = [1, 2];
              if (in_array('2', $which_previews)) {
                  $first = clone $base;
                  $white_bg = new \Imagick();
                  $white_bg->newImage(1000, 1000, new ImagickPixel('white'));
                  $white_bg->setImageFormat('jpg');
                  $first->resizeImage(1000, 1000, Imagick::FILTER_BOX, 1, 1);
                  $x = (1000 - $first->getImageWidth()) / 2;
                  $white_bg->compositeImage($first, Imagick::COMPOSITE_DEFAULT, $x, 0);
                  if (count($which_previews) == 1) {
                      Storage::cloud()->put($out_file, (string) $white_bg, 'public');
                      return 1;
                  }
                  Storage::cloud()->put(str_replace('.jpg', '_2.jpg', $out_file), (string) $white_bg, 'public');

                  $counter++;
              }

              $img_trans = clone $base;
              $img_trans->setimageformat('png');
              $img_trans->transparentPaintImage(
                      '#ffffff', 0, 7000, false
              );
              $img_trans->evaluateImage(Imagick::EVALUATE_MULTIPLY, 0.7, Imagick::CHANNEL_ALPHA);

              $img = $img_trans;
              if (in_array('1', $which_previews)) {
                  $first = clone $img_trans;
                  $mask = new \Imagick();
                  $mask->readImageBlob(Storage::cloud()->get($overlays_dir . $product_code_original . '-' . $variance->color . ".jpg"));
                  $ratio = $mask->getImageWidth() / $mask->getImageHeight();
                  $mask->resizeImage($reso, $reso, Imagick::FILTER_BOX, 1, 1);
                  $size = $reso / 2.4;
                  $first->resizeImage($size, $size, Imagick::FILTER_BOX, 1, 1);
                  $mask->compositeImage($first, Imagick::COMPOSITE_DEFAULT, $reso / 3.03, $reso / $ratio / 4.6, Imagick::CHANNEL_ALPHA);
                  $mask->setImageFormat('jpg');
                  Storage::cloud()->put($out_file, (string) $mask, 'public');
                  $counter++;
              }
              return $counter;
              break;
          case 'tank-top-gildan-2200':
              $counter = 0;
              if (!$which_previews)
                  $which_previews = [1, 2];
              if (in_array('2', $which_previews)) {
                  $first = clone $base;
                  $white_bg = new \Imagick();
                  $white_bg->newImage(1000, 1000, new ImagickPixel('white'));
                  $white_bg->setImageFormat('jpg');
                  $first->resizeImage(1000, 1000, Imagick::FILTER_BOX, 1, 1);
                  $x = (1000 - $first->getImageWidth()) / 2;
                  $white_bg->compositeImage($first, Imagick::COMPOSITE_DEFAULT, $x, 0);
                  if (count($which_previews) == 1) {
                      Storage::cloud()->put($out_file, (string) $white_bg, 'public');
                      return 1;
                  }
                  Storage::cloud()->put(str_replace('.jpg', '_2.jpg', $out_file), (string) $white_bg, 'public');

                  $counter++;
              }

              $img_trans = clone $base;
              $img_trans->setimageformat('png');
              $img_trans->transparentPaintImage(
                      '#ffffff', 0, 7000, false
              );
              $img_trans->evaluateImage(Imagick::EVALUATE_MULTIPLY, 0.7, Imagick::CHANNEL_ALPHA);

              $img = $img_trans;
              if (in_array('1', $which_previews)) {
                  $first = clone $img_trans;
                  $mask = new \Imagick();
                  $mask->readImageBlob(Storage::cloud()->get($overlays_dir . $product_code_original . '-' . $variance->color . ".jpg"));
                  $ratio = $mask->getImageWidth() / $mask->getImageHeight();
                  $mask->resizeImage($reso, $reso, Imagick::FILTER_BOX, 1, 1);
                  $size = $reso / 2.3;
                  $first->resizeImage($size, $size, Imagick::FILTER_BOX, 1, 1);
                  $mask->compositeImage($first, Imagick::COMPOSITE_DEFAULT, $reso / 2.83, $reso / $ratio / 3.5, Imagick::CHANNEL_ALPHA);
                  $mask->setImageFormat('jpg');
                  Storage::cloud()->put($out_file, (string) $mask, 'public');
                  $counter++;
              }
              return $counter;
              break;
          case 'sweatshirt-gildan-18000':
              $counter = 0;
              if (!$which_previews)
                  $which_previews = [1, 2];
              if (in_array('2', $which_previews)) {
                  $first = clone $base;
                  $white_bg = new \Imagick();
                  $white_bg->newImage(1000, 1000, new ImagickPixel('white'));
                  $white_bg->setImageFormat('jpg');
                  $first->resizeImage(1000, 1000, Imagick::FILTER_BOX, 1, 1);
                  $x = (1000 - $first->getImageWidth()) / 2;
                  $white_bg->compositeImage($first, Imagick::COMPOSITE_DEFAULT, $x, 0);
                  if (count($which_previews) == 1) {
                      Storage::cloud()->put($out_file, (string) $white_bg, 'public');
                      return 1;
                  }
                  Storage::cloud()->put(str_replace('.jpg', '_2.jpg', $out_file), (string) $white_bg, 'public');

                  $counter++;
              }

              $img_trans = clone $base;
              $img_trans->setimageformat('png');
              $img_trans->transparentPaintImage(
                      '#ffffff', 0, 7000, false
              );
              $img_trans->evaluateImage(Imagick::EVALUATE_MULTIPLY, 0.7, Imagick::CHANNEL_ALPHA);

              $img = $img_trans;
              if (in_array('1', $which_previews)) {
                  $first = clone $img_trans;
                  $mask = new \Imagick();
                  $mask->readImageBlob(Storage::cloud()->get($overlays_dir . $product_code_original . '-' . $variance->color . ".jpg"));
                  $ratio = $mask->getImageWidth() / $mask->getImageHeight();
                  $mask->resizeImage($reso, $reso, Imagick::FILTER_BOX, 1, 1);
                  $size = $reso / 2;
                  $first->resizeImage($size, $size, Imagick::FILTER_BOX, 1, 1);
                  $mask->compositeImage($first, Imagick::COMPOSITE_DEFAULT, $reso / 3.34, $reso / $ratio / 3.9, Imagick::CHANNEL_ALPHA);
                  $mask->setImageFormat('jpg');
                  Storage::cloud()->put($out_file, (string) $mask, 'public');
                  $counter++;
              }
              return $counter;
              break;
          case 'hoodie-gildan-18500':
              $counter = 0;
              if (!$which_previews)
                  $which_previews = [1, 2];
              if (in_array('2', $which_previews)) {
                  $first = clone $base;
                  $white_bg = new \Imagick();
                  $white_bg->newImage(1000, 1000, new ImagickPixel('white'));
                  $white_bg->setImageFormat('jpg');
                  $first->resizeImage(1000, 1000, Imagick::FILTER_BOX, 1, 1);
                  $x = (1000 - $first->getImageWidth()) / 2;
                  $white_bg->compositeImage($first, Imagick::COMPOSITE_DEFAULT, $x, 0);
                  if (count($which_previews) == 1) {
                      Storage::cloud()->put($out_file, (string) $white_bg, 'public');
                      return 1;
                  }
                  Storage::cloud()->put(str_replace('.jpg', '_2.jpg', $out_file), (string) $white_bg, 'public');

                  $counter++;
              }

              $img_trans = clone $base;
              $img_trans->setimageformat('png');
              $img_trans->transparentPaintImage(
                      '#ffffff', 0, 7000, false
              );
              $img_trans->evaluateImage(Imagick::EVALUATE_MULTIPLY, 0.7, Imagick::CHANNEL_ALPHA);

              $img = $img_trans;
              if (in_array('1', $which_previews)) {
                  $first = clone $img_trans;
                  $mask = new \Imagick();
                  $mask->readImageBlob(Storage::cloud()->get($overlays_dir . $product_code_original . '-' . $variance->color . ".jpg"));
                  $ratio = $mask->getImageWidth() / $mask->getImageHeight();
                  $mask->resizeImage($reso, $reso, Imagick::FILTER_BOX, 1, 1);
                  $size = $reso / 2.1;
                  $first->resizeImage($size, $size, Imagick::FILTER_BOX, 1, 1);
                  $mask->compositeImage($first, Imagick::COMPOSITE_DEFAULT, $reso / 3.23, $reso / $ratio / 2.5, Imagick::CHANNEL_ALPHA);
                  $mask->setImageFormat('jpg');
                  Storage::cloud()->put($out_file, (string) $mask, 'public');
                  $counter++;
              }
              return $counter;
              break;
          case 'infant-basic'://daniel sunday work and fun !!!! good luck!!
              Storage::cloud()->put(str_replace('.jpg', '_3.jpg', $out_file), (string) $base, 'public');

              $img_trans = $base;
              $img_trans->setimageformat('png');
              $img_trans->transparentPaintImage(
                      '#ffffff', 0, 7000, false
              );
              $img_trans->evaluateImage(Imagick::EVALUATE_MULTIPLY, 0.8, Imagick::CHANNEL_ALPHA);


              $img = $img_trans;
              $shirt_overlay = Image::make(Storage::cloud()->get($overlays_dir . $product_code_original . '-' . $variance->color . ".jpg"));
              $size = 630;
              $img->adaptiveResizeImage($size, $size, true);
              $shirt_overlay->insert($img->getImageBlob(), 'top-left', 283, 180);
              Storage::cloud()->put($out_file, (string) $shirt_overlay->encode(), 'public');
  //            header('Content-Type: image/jpeg');
  //            echo $shirt_overlay->encode('jpg');
  //            die();
              $shirt_overlay = Image::make(Storage::cloud()->get($overlays_dir . $product_code_original . '-' . $variance->color . "-2.jpg"));

  //            $size = 320;
  //            $img->adaptiveResizeImage($size, $size, true);
  //            $img->rotateimage(new ImagickPixel('none'), 5);
  //            $shirt_overlay->insert($img->getImageBlob(), 'top-left', 400, 410);
              $size = 240;
              $img->adaptiveResizeImage($size, $size, true);
              $img->rotateimage(new ImagickPixel('none'), -10);
              $shirt_overlay->insert($img->getImageBlob(), 'top-left', 460, 430);
              Storage::cloud()->put(str_replace('.jpg', '_2.jpg', $out_file), (string) $shirt_overlay->encode(), 'public');
  //
  //            $img = $img_trans;
  //            $shirt_overlay = Image::make(Storage::cloud()->get($overlays_dir . $product_code_original . '-' . $variance->color . "-3.jpg"));
  //            $size = 400;
  //            $img->adaptiveResizeImage($size, $size, true);
  //            $shirt_overlay->insert($img->getImageBlob(), 'top-left', 420, 270);
  //            Storage::cloud()->put(str_replace('.jpg', '_2.jpg', $out_file), (string) $shirt_overlay->encode(), 'public');
  //            header('Content-Type: image/jpeg');
  //            echo $shirt_overlay->encode('jpg');
  //            die();

              return 3;
              break;
          case 'tshirt-anvil-939':
              $mask_path = $overlays_dir . $product_code_original . '-' . $variance->color . ".png";
              $base = new Imagick($mask_path);
              $mask = new Imagick($filename);

              $w = $base->getImageWidth();
              $h = $base->getImageHeight();
              $mask->resizeImage(550, 550, Imagick::FILTER_BOX, 1, TRUE);
  //    $base->resizeImage($reso, $reso, Imagick::FILTER_BOX , 1, true);
              $base->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 250, 200, Imagick::CHANNEL_ALPHA);

  //            header('Content-Type: image/jpeg');
  //            echo $base;
  //            die();

              $base->writeImage($out_file);
              return 1;
              break;
          case 'tshirt-gildan-5000':
              $mask_path = $overlays_dir . $product_code_original . '-' . $variance->color . ".png";
              $base = new Imagick($mask_path);
              $mask = new Imagick($filename);

              $w = $base->getImageWidth();
              $h = $base->getImageHeight();
              $mask->resizeImage(550, 550, Imagick::FILTER_BOX, 1, TRUE);
  //    $base->resizeImage($reso, $reso, Imagick::FILTER_BOX , 1, true);
              $base->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 230, 180, Imagick::CHANNEL_ALPHA);

  //            header('Content-Type: image/jpeg');
  //            echo $base;
  //            die();

              $base->writeImage($out_file);
              return 1;
              break;
          case 'tshirt-gildan-64000':
              $mask_path = $overlays_dir . $product_code_original . '-' . $variance->color . ".png";
              $base = new Imagick($mask_path);
              $mask = new Imagick($filename);

              $w = $base->getImageWidth();
              $h = $base->getImageHeight();
              $mask->resizeImage(550, 550, Imagick::FILTER_BOX, 1, TRUE);
  //    $base->resizeImage($reso, $reso, Imagick::FILTER_BOX , 1, true);
              $base->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 250, 250, Imagick::CHANNEL_ALPHA);

  //            header('Content-Type: image/jpeg');
  //            echo $base;
  //            die();

              $base->writeImage($out_file);
              return 1;
              break;
          case 'tshirt-gildan-64000l':
              $mask_path = $overlays_dir . $product_code_original . '-' . $variance->color . ".png";
              $base = new Imagick($mask_path);
              $mask = new Imagick($filename);

              $w = $base->getImageWidth();
              $h = $base->getImageHeight();
              $mask->resizeImage(550, 550, Imagick::FILTER_BOX, 1, TRUE);
  //    $base->resizeImage($reso, $reso, Imagick::FILTER_BOX , 1, true);
              $base->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 240, 150, Imagick::CHANNEL_ALPHA);

  //            header('Content-Type: image/jpeg');
  //            echo $base;
  //            die();

              $base->writeImage($out_file);
              return 1;
              break;
          case 'tshirt-gildan-gd10':
              $mask_path = $overlays_dir . $product_code_original . '-' . $variance->color . ".png";
              $base = new Imagick($mask_path);
              $mask = new Imagick($filename);

              $w = $base->getImageWidth();
              $h = $base->getImageHeight();
              $mask->resizeImage(550, 550, Imagick::FILTER_BOX, 1, TRUE);
  //    $base->resizeImage($reso, $reso, Imagick::FILTER_BOX , 1, true);
              $base->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 240, 230, Imagick::CHANNEL_ALPHA);

  //            header('Content-Type: image/jpeg');
  //            echo $base;
  //            die();

              $base->writeImage($out_file);
              return 1;
              break;
          case 'tshirt-gildan-gd78':
              $mask_path = $overlays_dir . $product_code_original . '-' . $variance->color . ".png";
              $base = new Imagick($mask_path);
              $mask = new Imagick($filename);

              $w = $base->getImageWidth();
              $h = $base->getImageHeight();
              $mask->resizeImage(500, 500, Imagick::FILTER_BOX, 1, TRUE);
  //    $base->resizeImage($reso, $reso, Imagick::FILTER_BOX , 1, true);
              $base->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 260, 350, Imagick::CHANNEL_ALPHA);

  //            header('Content-Type: image/jpeg');
  //            echo $base;
  //            die();

              $base->writeImage($out_file);
              return 1;
              break;
          case 'tanktop-bella-8800':
              $mask_path = $overlays_dir . $product_code_original . '-' . $variance->color . ".png";
              $base = new Imagick($mask_path);
              $mask = new Imagick($filename);

              $w = $base->getImageWidth();
              $h = $base->getImageHeight();
              $mask->resizeImage(720, 720, Imagick::FILTER_BOX, 1, TRUE);

              $base->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 180, 280, Imagick::CHANNEL_ALPHA);



              $base->writeImage($out_file);
              return 1;
              break;
          case 'tanktop-bella-3480':
              $mask_path = $overlays_dir . $product_code_original . '-' . $variance->color . ".png";
              $base = new Imagick($mask_path);
              $mask = new Imagick($filename);

              $w = $base->getImageWidth();
              $h = $base->getImageHeight();
              $mask->resizeImage(720, 720, Imagick::FILTER_BOX, 1, TRUE);

              $base->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 180, 450, Imagick::CHANNEL_ALPHA);



              $base->writeImage($out_file);
              return 1;
              break;
          case 'tanktop-gildan-gd12':
              $mask_path = $overlays_dir . $product_code_original . '-' . $variance->color . ".png";
              $base = new Imagick($mask_path);
              $mask = new Imagick($filename);

              $w = $base->getImageWidth();
              $h = $base->getImageHeight();
              $mask->resizeImage(500, 500, Imagick::FILTER_BOX, 1, TRUE);

              $base->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 255, 330, Imagick::CHANNEL_ALPHA);



              $base->writeImage($out_file);
              return 1;
              break;
          case 'hoodie-aa-5495'://new apparel
              $mask_path = $overlays_dir . $product_code_original . '-' . $variance->color . ".png";
              $base = new Imagick($mask_path);
              $mask = new Imagick($filename);

              $w = $base->getImageWidth();
              $h = $base->getImageHeight();
              $mask->resizeImage(400, 400, Imagick::FILTER_LANCZOS, 1, TRUE);
  //    $base->resizeImage($reso, $reso, Imagick::FILTER_LANCZOS, 1, true);
              $base->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 340, 300, Imagick::CHANNEL_ALPHA);

  //            header('Content-Type: image/jpeg');
  //            echo $base;
  //            die();

              $base->writeImage($out_file);
              return 1;
              break;
          case 'hoodie-aa-5497'://new apparel
              $mask_path = $overlays_dir . $product_code_original . '-' . $variance->color . ".png";
              $base = new Imagick($mask_path);
              $mask = new Imagick($filename);

              $w = $base->getImageWidth();
              $h = $base->getImageHeight();
              $mask->resizeImage(550, 550, Imagick::FILTER_LANCZOS, 1, TRUE);
  //    $base->resizeImage($reso, $reso, Imagick::FILTER_LANCZOS, 1, true);
              $base->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 230, 240, Imagick::CHANNEL_ALPHA);

  //            header('Content-Type: image/jpeg');
  //            echo $base;
  //            die();

              $base->writeImage($out_file);
              return 1;
              break;
          case 'hoodie-aa-3909'://new apparel
              $mask_path = $overlays_dir . $product_code_original . '-' . $variance->color . ".png";
              $base = new Imagick($mask_path);
              $mask = new Imagick($filename);

              $w = $base->getImageWidth();
              $h = $base->getImageHeight();
              $mask->resizeImage(630, 630, Imagick::FILTER_LANCZOS, 1, TRUE);
  //    $base->resizeImage($reso, $reso, Imagick::FILTER_LANCZOS, 1, true);
              $base->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 280, 290, Imagick::CHANNEL_ALPHA);

  //            header('Content-Type: image/jpeg');
  //            echo $base;
  //            die();

              $base->writeImage($out_file);
              return 1;
              break;
          case 'hoodie-aa-awd-jh001'://new apparel
              $mask_path = $overlays_dir . $product_code_original . '-' . $variance->color . ".png";
              $base = new Imagick($mask_path);
              $mask = new Imagick($filename);

              $w = $base->getImageWidth();
              $h = $base->getImageHeight();
              $mask->resizeImage(540, 540, Imagick::FILTER_LANCZOS, 1, TRUE);
  //    $base->resizeImage($reso, $reso, Imagick::FILTER_LANCZOS, 1, true);
              $base->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 250, 250, Imagick::CHANNEL_ALPHA);

  //            header('Content-Type: image/jpeg');
  //            echo $base;
  //            die();

              $base->writeImage($out_file);
              return 1;
              break;
          case 'hoodie-aa-awd-jh001f'://new apparel
              $mask_path = $overlays_dir . $product_code_original . '-' . $variance->color . ".png";
              $base = new Imagick($mask_path);
              $mask = new Imagick($filename);

              $w = $base->getImageWidth();
              $h = $base->getImageHeight();
              $mask->resizeImage(420, 450, Imagick::FILTER_LANCZOS, 1, TRUE);
  //    $base->resizeImage($reso, $reso, Imagick::FILTER_LANCZOS, 1, true);
              $base->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 282, 270, Imagick::CHANNEL_ALPHA);

  //            header('Content-Type: image/jpeg');
  //            echo $base;
  //            die();

              $base->writeImage($out_file);
              return 1;
              break;
          case 'hoodie-aa-awd-jh050'://new apparel
              $mask_path = $overlays_dir . $product_code_original . '-' . $variance->color . ".png";
              $base = new Imagick($mask_path);
              $mask = new Imagick($filename);

              $w = $base->getImageWidth();
              $h = $base->getImageHeight();
              $mask->resizeImage(520, 570, Imagick::FILTER_LANCZOS, 1, TRUE);
  //    $base->resizeImage($reso, $reso, Imagick::FILTER_LANCZOS, 1, true);
              $base->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 225, 250, Imagick::CHANNEL_ALPHA);

  //            header('Content-Type: image/jpeg');
  //            echo $base;
  //            die();

              $base->writeImage($out_file);
              return 1;
              break;
          case 'tshirt-aa-2007'://new apparel
              $mask_path = $overlays_dir . $product_code_original . '-' . $variance->color . ".png";
              $base = new Imagick($mask_path);
              $mask = new Imagick($filename);

              $w = $base->getImageWidth();
              $h = $base->getImageHeight();
              $mask->resizeImage(430, 2000, Imagick::FILTER_LANCZOS, 1, TRUE);
  //    $base->resizeImage($reso, $reso, Imagick::FILTER_LANCZOS, 1, true);
              $base->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 240, 150, Imagick::CHANNEL_ALPHA);

  //            header('Content-Type: image/jpeg');
  //            echo $base;
  //            die();

              $base->writeImage($out_file);
              return 1;
              break;
          case 'infantclothing-aa-4001'://new apparel
              $mask_path = $overlays_dir . $product_code_original . '-' . $variance->color . ".png";
              $base = new Imagick($mask_path);
              $mask = new Imagick($filename);

              $w = $base->getImageWidth();
              $h = $base->getImageHeight();
              $mask->resizeImage(750, 1100, Imagick::FILTER_LANCZOS, 1, TRUE);
  //    $base->resizeImage($reso, $reso, Imagick::FILTER_LANCZOS, 1, true);
              $base->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 580, 350, Imagick::CHANNEL_ALPHA);

  //            header('Content-Type: image/jpeg');
  //            echo $base;
  //            die();
          case 'infant-lat-3322'://new apparel
              $mask_path = $overlays_dir . $product_code_original . '-' . $variance->color . ".png";
              $base = new Imagick($mask_path);
              $mask = new Imagick($filename);

              $w = $base->getImageWidth();
              $h = $base->getImageHeight();
              $mask->resizeImage(430, 400, Imagick::FILTER_LANCZOS, 1, TRUE);
  //    $base->resizeImage($reso, $reso, Imagick::FILTER_LANCZOS, 1, true);
              $base->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 270, 280, Imagick::CHANNEL_ALPHA);

  //            header('Content-Type: image/jpeg');
  //            echo $base;
  //            die();

              $base->writeImage($out_file);
              return 1;
              break;
          case 'infant-lat-4411'://new apparel
              $mask_path = $overlays_dir . $product_code_original . '-' . $variance->color . ".png";
              $base = new Imagick($mask_path);
              $mask = new Imagick($filename);

              $w = $base->getImageWidth();
              $h = $base->getImageHeight();
              $mask->resizeImage(430, 400, Imagick::FILTER_LANCZOS, 1, TRUE);
  //    $base->resizeImage($reso, $reso, Imagick::FILTER_LANCZOS, 1, true);
              $base->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 270, 150, Imagick::CHANNEL_ALPHA);

  //            header('Content-Type: image/jpeg');
  //            echo $base;
  //            die();

              $base->writeImage($out_file);
              return 1;
              break;
          case 'infant-basic'://new apparel
              $mask_path = $overlays_dir . $product_code_original . '-' . $variance->color . ".png";
              $base = new Imagick($mask_path);
              $mask = new Imagick($filename);

              $w = $base->getImageWidth();
              $h = $base->getImageHeight();
              $mask->resizeImage(430, 400, Imagick::FILTER_LANCZOS, 1, TRUE);
  //    $base->resizeImage($reso, $reso, Imagick::FILTER_LANCZOS, 1, true);
              $base->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 270, 150, Imagick::CHANNEL_ALPHA);

  //            header('Content-Type: image/jpeg');
  //            echo $base;
  //            die();

              $base->writeImage($out_file);
              return 1;
              break;
          case 'infant-lat-4424'://new apparel
              $mask_path = $overlays_dir . $product_code_original . '-' . $variance->color . ".png";
              $base = new Imagick($mask_path);
              $mask = new Imagick($filename);

              $w = $base->getImageWidth();
              $h = $base->getImageHeight();
              $mask->resizeImage(400, 400, Imagick::FILTER_LANCZOS, 1, TRUE);
  //    $base->resizeImage($reso, $reso, Imagick::FILTER_LANCZOS, 1, true);
              $base->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 280, 180, Imagick::CHANNEL_ALPHA);

  //            header('Content-Type: image/jpeg');
  //            echo $base;
  //            die();

              $base->writeImage($out_file);
              return 1;
              break;
          case 'tshirt-long-sleeve-bb453'://new apparel
              $mask_path = $overlays_dir . $product_code_original . '-' . $variance->color . ".png";
              $base = new Imagick($mask_path);
              $mask = new Imagick($filename);

              $w = $base->getImageWidth();
              $h = $base->getImageHeight();
              $mask->resizeImage(450, 450, Imagick::FILTER_LANCZOS, 1, TRUE);
  //    $base->resizeImage($reso, $reso, Imagick::FILTER_LANCZOS, 1, true);
              $base->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 335, 120, Imagick::CHANNEL_ALPHA);

  //            header('Content-Type: image/jpeg');
  //            echo $base;
  //            die();

              $base->writeImage($out_file);
              return 1;
              break;
          case 'youthappareltee-gildan-5000b'://new apparel
              $mask_path = $overlays_dir . $product_code_original . '-' . $variance->color . ".png";
              $base = new Imagick($mask_path);
              $mask = new Imagick($filename);

              $w = $base->getImageWidth();
              $h = $base->getImageHeight();
              $mask->resizeImage(300, 300, Imagick::FILTER_LANCZOS, 1, TRUE);
  //    $base->resizeImage($reso, $reso, Imagick::FILTER_LANCZOS, 1, true);
              $base->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 320, 350, Imagick::CHANNEL_ALPHA);

  //            header('Content-Type: image/jpeg');
  //            echo $base;
  //            die();

              $base->writeImage($out_file);
              return 1;
              break;
          case 'youthapparel-aa-2201'://new apparel
              $mask_path = $overlays_dir . $product_code_original . '-' . $variance->color . ".png";
              $base = new Imagick($mask_path);
              $mask = new Imagick($filename);

              $w = $base->getImageWidth();
              $h = $base->getImageHeight();
              $mask->resizeImage(200, 240, Imagick::FILTER_LANCZOS, 1, TRUE);
  //    $base->resizeImage($reso, $reso, Imagick::FILTER_LANCZOS, 1, true);
              $base->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 350, 200, Imagick::CHANNEL_ALPHA);

  //            header('Content-Type: image/jpeg');
  //            echo $base;
  //            die();

              $base->writeImage($out_file);
              return 1;
              break;
          case 'youth-hoodie-gildan-18500b'://new apparel
              $mask_path = $overlays_dir . $product_code_original . '-' . $variance->color . ".png";
              $base = new Imagick($mask_path);
              $mask = new Imagick($filename);

              $w = $base->getImageWidth();
              $h = $base->getImageHeight();
              $mask->resizeImage(320, 280, Imagick::FILTER_LANCZOS, 1, TRUE);
  //    $base->resizeImage($reso, $reso, Imagick::FILTER_LANCZOS, 1, true);
              $base->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 320, 320, Imagick::CHANNEL_ALPHA);

  //            header('Content-Type: image/jpeg');
  //            echo $base;
  //            die();

              $base->writeImage($out_file);
              return 1;
              break;
          case 'youth-apparel-lat-6101'://new apparel
              $mask_path = $overlays_dir . $product_code_original . '-' . $variance->color . ".png";
              $base = new Imagick($mask_path);
              $mask = new Imagick($filename);

              $w = $base->getImageWidth();
              $h = $base->getImageHeight();
              $mask->resizeImage(340, 340, Imagick::FILTER_LANCZOS, 1, TRUE);
  //    $base->resizeImage($reso, $reso, Imagick::FILTER_LANCZOS, 1, true);
              $base->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 320, 200, Imagick::CHANNEL_ALPHA);

  //            header('Content-Type: image/jpeg');
  //            echo $base;
  //            die();

              $base->writeImage($out_file);
              return 1;
              break;
          case 'youth-apparel-gildan-64000b'://new apparel
              $mask_path = $overlays_dir . $product_code_original . '-' . $variance->color . ".png";
              $base = new Imagick($mask_path);
              $mask = new Imagick($filename);

              $w = $base->getImageWidth();
              $h = $base->getImageHeight();
              $mask->resizeImage(490, 590, Imagick::FILTER_LANCZOS, 1, TRUE);
  //    $base->resizeImage($reso, $reso, Imagick::FILTER_LANCZOS, 1, true);
              $base->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 235, 180, Imagick::CHANNEL_ALPHA);

  //            header('Content-Type: image/jpeg');
  //            echo $base;
  //            die();

              $base->writeImage($out_file);
              return 1;
              break;
          case 'youth-apparel-hoodie-awd-jh001b'://new apparel
              $mask_path = $overlays_dir . $product_code_original . '-' . $variance->color . ".png";
              $base = new Imagick($mask_path);
              $mask = new Imagick($filename);

              $w = $base->getImageWidth();
              $h = $base->getImageHeight();
              $mask->resizeImage(400, 400, Imagick::FILTER_LANCZOS, 1, TRUE);
  //    $base->resizeImage($reso, $reso, Imagick::FILTER_LANCZOS, 1, true);
              $base->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 290, 220, Imagick::CHANNEL_ALPHA);

  //            header('Content-Type: image/jpeg');
  //            echo $base;
  //            die();

              $base->writeImage($out_file);
              return 1;
              break;
          case 'youth-apparel-sweatshirt-awd-jh030b'://new apparel
              $mask_path = $overlays_dir . $product_code_original . '-' . $variance->color . ".png";
              $base = new Imagick($mask_path);
              $mask = new Imagick($filename);

              $w = $base->getImageWidth();
              $h = $base->getImageHeight();
              $mask->resizeImage(400, 400, Imagick::FILTER_LANCZOS, 1, TRUE);
  //    $base->resizeImage($reso, $reso, Imagick::FILTER_LANCZOS, 1, true);
              $base->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 275, 220, Imagick::CHANNEL_ALPHA);

  //            header('Content-Type: image/jpeg');
  //            echo $base;
  //            die();

              $base->writeImage($out_file);
              return 1;
              break;
          case 'toddler-lat-3321'://new apparel
              $mask_path = $overlays_dir . $product_code_original . '-' . $variance->color . ".png";
              $base = new Imagick($mask_path);
              $mask = new Imagick($filename);

              $w = $base->getImageWidth();
              $h = $base->getImageHeight();
              $mask->resizeImage(400, 400, Imagick::FILTER_LANCZOS, 1, TRUE);
  //    $base->resizeImage($reso, $reso, Imagick::FILTER_LANCZOS, 1, true);
              $base->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 310, 250, Imagick::CHANNEL_ALPHA);

  //            header('Content-Type: image/jpeg');
  //            echo $base;
  //            die();

              $base->writeImage($out_file);
              return 1;
              break;
          case 'toddlerclothing-aa-2105'://new apparel
              $mask_path = $overlays_dir . $product_code_original . '-' . $variance->color . ".png";
              $base = new Imagick($mask_path);
              $mask = new Imagick($filename);

              $w = $base->getImageWidth();
              $h = $base->getImageHeight();
              $mask->resizeImage(350, 350, Imagick::FILTER_LANCZOS, 1, TRUE);
  //    $base->resizeImage($reso, $reso, Imagick::FILTER_LANCZOS, 1, true);
              $base->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 370, 200, Imagick::CHANNEL_ALPHA);

  //            header('Content-Type: image/jpeg');
  //            echo $base;
  //            die();

              $base->writeImage($out_file);
              return 1;
              break;
          case 'shower-curtain-71x74':
              $first = $base;
              $second = new \Imagick();
              $second->readImageBlob(Storage::cloud()->get($filename));

              $mask_path = $overlays_dir . $product_code . '.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.5);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));

              $size = $reso / 0.97;
              $first->resizeImage($size, $size, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($first, Imagick::COMPOSITE_DEFAULT, $reso / 600, $reso / $ratio / 60, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');


              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);
              Storage::cloud()->put($out_file, (string) $white_bg, 'public');

  //            header('Content-Type: image/jpeg');
  //              echo $white_bg;
  //             die();

              $mask_path = $overlays_dir . $product_code . '-2.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.5);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));

              $size = $reso / 1.2;
              $second->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);

              $white_bg->compositeImage($second, Imagick::COMPOSITE_DEFAULT, $reso / 5, -20, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');


              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);

  //            header('Content-Type: image/jpeg');
  //              echo $white_bg;
  //             die();

              Storage::cloud()->put(str_replace('.jpg', '_2.jpg', $out_file), (string) $white_bg, 'public');

              return 2;
              break;
          case 'laptop-cover-8':
              $first = $base;
              $mask_path = $overlays_dir . $product_code . '.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
              Storage::cloud()->put($out_file, (string) fit_mask($first, $mask), 'public');
              return 1;
              break;
          case 'laptop-cover-10':
              $first = $base;
              $second = $base;
              $mask_path = $overlays_dir . $product_code . '.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
              $overlay_1 = fit_mask($first, $mask);
              Storage::cloud()->put($out_file, (string) $overlay_1, 'public');
              $third = clone $overlay_1;
              $mask_path = $overlays_dir . $product_code . '-2.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.3);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));
              $size = $reso / 1.16;
              $second->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);
              $white_bg->compositeImage($second, Imagick::COMPOSITE_DEFAULT, $reso / 7.2, $reso / $ratio / 12, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');
              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);
  //            header('Content-Type: image/jpeg');
  //              echo $white_bg;
  //             die();

              Storage::cloud()->put(str_replace('.jpg', '_2.jpg', $out_file), (string) $white_bg, 'public');
              return 2;
              break;
          case 'laptop-cover-13':
              $first = $base;
              $second = clone $base;
              $mask_path = $overlays_dir . $product_code . '.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
              $overlay_1 = fit_mask($first, $mask);
              Storage::cloud()->put($out_file, (string) $overlay_1, 'public');
              $mask_path = $overlays_dir . $product_code . '-2.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.3);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));
              $size = $reso / 1.19;
              $second->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);
              $white_bg->compositeImage($second, Imagick::COMPOSITE_DEFAULT, $reso / 6.4, $reso / $ratio / 11, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');
              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);
  //            header('Content-Type: image/jpeg');
  //              echo $white_bg;
  //             die();

              Storage::cloud()->put(str_replace('.jpg', '_2.jpg', $out_file), (string) $white_bg, 'public');
              return 2;
          case 'laptop-cover-15':
              $first = $base;
              $second = clone $base;
              $mask_path = $overlays_dir . $product_code . '.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
              $overlay_1 = fit_mask($first, $mask);
              Storage::cloud()->put($out_file, (string) $overlay_1, 'public');
              $mask_path = $overlays_dir . $product_code . '-2.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.3);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));
              $size = $reso / 1.20;
              $second->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);
              $white_bg->compositeImage($second, Imagick::COMPOSITE_DEFAULT, $reso / 6.1, $reso / $ratio / 13, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');
              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);
  //            header('Content-Type: image/jpeg');
  //            echo $white_bg;
  //            die();

              Storage::cloud()->put(str_replace('.jpg', '_2.jpg', $out_file), (string) $white_bg, 'public');
              return 2;
          case 'laptop-cover-17':
              $first = $base;
              $second = clone $base;
              $mask_path = $overlays_dir . $product_code . '.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
              $overlay_1 = fit_mask($first, $mask);
              Storage::cloud()->put($out_file, (string) $overlay_1, 'public');
              $mask_path = $overlays_dir . $product_code . '-2.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.3);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));
              $size = $reso / 1.13;
              $second->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);
              $white_bg->compositeImage($second, Imagick::COMPOSITE_DEFAULT, $reso / 8.9, $reso / $ratio / -100, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');
              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);
  //            header('Content-Type: image/jpeg');
  //            echo $white_bg;
  //            die();

              Storage::cloud()->put(str_replace('.jpg', '_2.jpg', $out_file), (string) $white_bg, 'public');
              return 2;
          case 'metal-ornament-single':
          case 'metal-ornament-double':
              $first = $base;
              $mask_path = $overlays_dir . $product_code . '.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
              Storage::cloud()->put($out_file, (string) fit_mask($first, $mask), 'public');
              return 1;
              break;
          case 'dog-bed-fleece-18x28':
          case 'dog-bed-fleece-30x40':
          case 'dog-bed-fleece-40x50':
          case 'dog-bed-outdoor-18x28':
          case 'dog-bed-outdoor-30x40':
          case 'dog-bed-outdoor-40x50':
          case 'dog-bed-outdoor-40x50':
          case 'dog-bed-outdoor-40x50':
          case 'dog-bed-outdoor-40x50':
              $first = $base;
              $mask_path = $overlays_dir . $product_code . '.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
              Storage::cloud()->put($out_file, (string) fit_mask($first, $mask), 'public');
              return 1;
              break;
          case 'baby-beanie-0-6m-front':
              $first = $base;
              $mask_path = $overlays_dir . $product_code . '.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
              $overlay_1 = fit_mask($first, $mask);
              Storage::cloud()->put($out_file, (string) $overlay_1, 'public');
              $second = clone $overlay_1;
              $third = clone $overlay_1;
              $mask_path = $overlays_dir . $product_code . '-2.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.3);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));
              $size = $reso / 1.6;
              $second->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);
              $white_bg->compositeImage($second, Imagick::COMPOSITE_DEFAULT, $reso / 2.4, $reso / $ratio / -45, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');
              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);
  //            header('Content-Type: image/jpeg');
  //              echo $white_bg;
  //             die();

              Storage::cloud()->put(str_replace('.jpg', '_2.jpg', $out_file), (string) $white_bg, 'public');
              return 2;
              break;
          case 'pet-bowl-cat-156x225':
              $imagick = $base;
              $mask_path = $overlays_dir . $product_code . '.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));

              $points = array(
                  //0.2, 0.0, 0.0, 1.0
                  0.4, 0.6, 0.0, 1.0
              );

              $imagick->setimagebackgroundcolor("#fad888");
              $imagick->setImageVirtualPixelMethod(\Imagick::VIRTUALPIXELMETHOD_EDGE);
              $imagick->distortImage(\Imagick::DISTORTION_BARREL, $points, true);

              header('Content-Type: image/jpeg');
              echo $imagick;
              die();

              Storage::cloud()->put($out_file, (string) fit_mask($first, $mask), 'public');
              return 1;
              break;
          case 'greet-fold-5x7-dull-single-5-pack':
          case 'greet-fold-5x7-dull-single-10-pack':
              $first = $base;
              $second = clone $base;
              $mask_path = $overlays_dir . $product_code . '.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
              Storage::cloud()->put($out_file, (string) fit_mask($first, $mask), 'public');

              $mask_path = $overlays_dir . $product_code . '-2.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.3);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));
              $size = $reso / 1.527;
              $second->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);
              $second->rotateimage(new ImagickPixel('none'), 6.8);
              $white_bg->compositeImage($second, Imagick::COMPOSITE_DEFAULT, $reso / 2.95, $reso / $ratio / 5.4, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');
              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);
  //            header('Content-Type: image/jpeg');
  //              echo $white_bg;
  //             die();

              Storage::cloud()->put(str_replace('.jpg', '_2.jpg', $out_file), (string) $white_bg, 'public');
              return 2;
          case 'baby-fleece-blanket-15x12-Single':
              $first = $base;
              $mask_path = $overlays_dir . $product_code . '.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
              $overlay_1 = fit_mask($first, $mask);
              Storage::cloud()->put($out_file, (string) $overlay_1, 'public');
              $second = clone $overlay_1;

              $mask_path = $overlays_dir . $product_code . '-2.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.3);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));
              $size = $reso / 1;
              $second->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);
              $white_bg->compositeImage($second, Imagick::COMPOSITE_DEFAULT, $reso / 5.9, 0, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');
              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);
  //            header('Content-Type: image/jpeg');
  //              echo $white_bg;
  //             die();

              Storage::cloud()->put(str_replace('.jpg', '_2.jpg', $out_file), (string) $white_bg, 'public');
              return 2;
          case 'baby-sherpa-blanket-30x40':
              $first = $base;
              $second = clone $base;
              $third = clone $base;
              $mask_path = $overlays_dir . $product_code . '.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
              $overlay_1 = fit_mask($first, $mask);
              Storage::cloud()->put($out_file, (string) $overlay_1, 'public');

              $mask_path = $overlays_dir . $product_code . '-2.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.3);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));
              $size = $reso / 1.6;
              $second->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);
              $white_bg->compositeImage($second, Imagick::COMPOSITE_DEFAULT, $reso / 3.7, $reso / $ratio / 4.5, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');
              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);
  //            header('Content-Type: image/jpeg');
  //              echo $white_bg;
  //             die();

              Storage::cloud()->put(str_replace('.jpg', '_2.jpg', $out_file), (string) $white_bg, 'public');

              $mask_path = $overlays_dir . $product_code . '-3.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.3);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));
              $size = $reso / 1.83;
              $third->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);
              $third->rotateimage(new ImagickPixel('none'), 90);
              $white_bg->compositeImage($third, Imagick::COMPOSITE_DEFAULT, $reso / 5, $reso / $ratio / 2.25, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');
              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);
  //            header('Content-Type: image/jpeg');
  //              echo $white_bg;
  //             die();

              Storage::cloud()->put(str_replace('.jpg', '_3.jpg', $out_file), (string) $white_bg, 'public');
              return 3;
          case 'crib-sheet-28x52':
              $first = clone $base;
              $mask_path = $overlays_dir . $product_code . '.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
              $overlay_1 = fit_mask($first, $mask);
              Storage::cloud()->put($out_file, (string) $overlay_1, 'public');


              $second = clone $base;
              $mask_path = $overlays_dir . $product_code . '-2.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.3);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));
              $size = $reso / 0.8;
              $second->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);
              $white_bg->compositeImage($second, Imagick::COMPOSITE_DEFAULT, $reso / 25, $reso / $ratio / -8.5, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');
              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);
  //            header('Content-Type: image/jpeg');
  //              echo $white_bg;
  //             die();
              Storage::cloud()->put(str_replace('.jpg', '_2.jpg', $out_file), (string) $white_bg, 'public');
              return 2;
          case 'table-cloth-70x90':
              $first = $base;
              $mask_path = $overlays_dir . $product_code . '.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.5);
              Storage::cloud()->put($out_file, (string) fit_mask($first, $mask), 'public');
  //            header('Content-Type: image/jpeg');
  //            echo $white_bg;
  //            die();
              return 1;
              break;
          case 'shower-curtain-70x90':
              $first = $base;
              $mask_path = $overlays_dir . $product_code . '.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.5);
              Storage::cloud()->put($out_file, (string) fit_mask($first, $mask), 'public');
  //            header('Content-Type: image/jpeg');
  //            echo $white_bg;
  //            die();
              return 1;
              break;
          case 'AccessoryPouch-125x85':
              $first = $base;
              $mask_path = $overlays_dir . $product_code . '.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
              Storage::cloud()->put($out_file, (string) fit_mask($first, $mask), 'public');
              return 1;
              break;
          case 'puzzle-tin-10x14':
              $first = $base;
              $second = clone $base;
              $third = clone $base;
              $mask_path = $overlays_dir . $product_code . '.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
              $overlay_1 = fit_mask($first, $mask);
              Storage::cloud()->put($out_file, (string) $overlay_1, 'public');

              $mask_path = $overlays_dir . $product_code . '-2.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.3);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));
              $size = $reso / 1.07;
              $second->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);
              $white_bg->compositeImage($second, Imagick::COMPOSITE_DEFAULT, $reso / 7, $reso / $ratio / 15, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');
              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);
  //            header('Content-Type: image/jpeg');
  //            echo $white_bg;
  //            die();

              Storage::cloud()->put(str_replace('.jpg', '_2.jpg', $out_file), (string) $white_bg, 'public');

              $mask_path = $overlays_dir . $product_code . '-3.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.3);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));
              $size = $reso / 1.08;
              $third->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);
              $third->rotateimage(new ImagickPixel('none'), 90);
              $white_bg->compositeImage($third, Imagick::COMPOSITE_DEFAULT, $reso / 25, $reso / $ratio / 8, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');
              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);
  //            header('Content-Type: image/jpeg');
  //            echo $white_bg;
  //            die();

              Storage::cloud()->put(str_replace('.jpg', '_3.jpg', $out_file), (string) $white_bg, 'public');
              return 3;
          case 'shower-curtain-71x74':
              $first = $base;
              $mask_path = $overlays_dir . $product_code . '.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.5);
              Storage::cloud()->put($out_file, (string) fit_mask($first, $mask), 'public');
  //            header('Content-Type: image/jpeg');
  //            echo $white_bg;
  //            die();
              return 1;
              break;
  //        case 'shower-curtain-70x90':
  //            $first = $base;
  //            $mask_path = $overlays_dir . $product_code . '.png';
  //            $mask = new \Imagick();
  //            $mask->readImageBlob(Storage::cloud()->get($mask_path));
  ////            $mask->setImageOpacity(0.5);
  //            $white_bg = new \Imagick();
  //            $ratio = $mask->getImageWidth() / $mask->getImageHeight();
  //            $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));
  //            $size = $reso / 1.02;
  //            $first->resizeImage($size, $size, Imagick::FILTER_BOX, 1, true);
  //
  //
  //            $white_bg->compositeImage($first, Imagick::COMPOSITE_DEFAULT, $reso / 25, $reso / $ratio / 50, Imagick::CHANNEL_ALPHA);
  //            $white_bg->setImageFormat('jpg');
  //
  //            $w = $white_bg->getImageWidth();
  //            $h = $white_bg->getImageHeight();
  //            if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
  //                $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
  //            else
  //                $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
  //            $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);
  //
  //            Storage::cloud()->put($out_file, (string) $white_bg, 'public');
  //
  ////            header('Content-Type: image/jpeg');
  ////            echo $white_bg;
  ////            die();
  //
  //            return 1;
  //            break;
          case 'sherpa-blanket-60x80':
              $first = $base;
              $mask_path = $overlays_dir . $product_code . '.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
              $mask->rotateimage(new ImagickPixel('none'), 90);
              $overlay_1 = fit_mask($first, $mask);
              $overlay_1->rotateimage(new ImagickPixel('none'), -90);
              $second = clone $overlay_1;
              Storage::cloud()->put($out_file, (string) $overlay_1, 'public');


              $mask_path = $overlays_dir . $product_code . '-2.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->setImageOpacity(0.3);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));
              $size = $reso / 1.3;
              $second->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);
              $white_bg->compositeImage($second, Imagick::COMPOSITE_DEFAULT, $reso / 9.5, $reso / $ratio / 3.7, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');
              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);
  //            header('Content-Type: image/jpeg');
  //              echo $white_bg;
  //             die();

              Storage::cloud()->put(str_replace('.jpg', '_2.jpg', $out_file), (string) $white_bg, 'public');
              return 2;
          case 'sherpa-blanket-50x60':
              $first = $base;
              $mask_path = $overlays_dir . $product_code . '.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
              $mask->rotateimage(new ImagickPixel('none'), 90);
              $overlay_1 = fit_mask($first, $mask);
              $overlay_1->rotateimage(new ImagickPixel('none'), -90);
              $second = clone $overlay_1;
              Storage::cloud()->put($out_file, (string) $overlay_1, 'public');

              $mask_path = $overlays_dir . $product_code . '-2.png';
              $mask = new \Imagick();
              $mask->readImageBlob(Storage::cloud()->get($mask_path));
  //            $mask->rotateimage(new ImagickPixel('none'), 90);
  //            $mask->setImageOpacity(0.3);
              $white_bg = new \Imagick();
              $ratio = $mask->getImageWidth() / $mask->getImageHeight();
              $white_bg->newImage($reso, $reso / $ratio, new ImagickPixel('white'));
              $size = $reso / 1.35;
              $second->resizeImage($size, $size, Imagick::FILTER_BOX, 1, TRUE);

              $white_bg->compositeImage($second, Imagick::COMPOSITE_DEFAULT, $reso / 8.7, $reso / $ratio / 3.7, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');
              $w = $white_bg->getImageWidth();
              $h = $white_bg->getImageHeight();
              if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
              else
                  $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
              $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);
  //            header('Content-Type: image/jpeg');
  //              echo $white_bg;
  //             die();

              Storage::cloud()->put(str_replace('.jpg', '_2.jpg', $out_file), (string) $white_bg, 'public');
              return 2;
          case 'tshirt_gildan':
              $mask_path = $overlays_dir . $product_code_original . ".png";
              $base = new Imagick($mask_path);
              $mask = new Imagick($filename);
              $w = $base->getImageWidth();
              $h = $base->getImageHeight();
              $mask->resizeImage(520, 520, Imagick::FILTER_BOX, 1, TRUE);
  //    $base->resizeImage($reso, $reso, Imagick::FILTER_BOX , 1, true);
              $base->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 270, 210, Imagick::CHANNEL_ALPHA);

              $base->writeImage($out_file);
              return 1;
              break;
          case 'tote_bag':
              $white_bg = new \Imagick();
              if (strpos('x' . $product_code_original, 'Basketweave')) {
                  $base->resizeImage($reso / 1.6, $reso / 1.6, Imagick::FILTER_BOX, 1, TRUE);
                  $ratio = 1.626;
                  $white_bg->newImage($reso / $ratio, $reso, new ImagickPixel('white'));
                  $white_bg->compositeImage($base, Imagick::COMPOSITE_DEFAULT, $reso / $ratio * 0.02, $reso * 0.3, Imagick::CHANNEL_ALPHA);
              } else {
                  $base->resizeImage($reso / 1.69, $reso / 1.69, Imagick::FILTER_BOX, 1, TRUE);
                  $ratio = 1.626;
                  $white_bg->newImage($reso / $ratio, $reso, new ImagickPixel('white'));
                  $white_bg->compositeImage($base, Imagick::COMPOSITE_DEFAULT, $reso / $ratio * 0.02, $reso * 0.4056, Imagick::CHANNEL_ALPHA);
              }
              $white_bg->setImageFormat('jpg');

              $base = new Imagick($filename);
              $product_code = $product_code_original;
              break;
          case 'adjustable_tote':
              $base->resizeImage($reso / 2.05, $reso / 2.05, Imagick::FILTER_BOX, 1, TRUE);
              $ratio = 1.9723;
              $white_bg = new \Imagick();
              $white_bg->newImage($reso / $ratio, $reso, new ImagickPixel('white'));
              $white_bg->compositeImage($base, Imagick::COMPOSITE_DEFAULT, $reso / $ratio * 0.035, $reso * 0.5, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');

              $base = new Imagick($filename);
              $product_code = $product_code_original;
              break;
          case 'duvet_cover':
              $base->resizeImage($reso / 1.4, $reso / 1.4, Imagick::FILTER_BOX, 1, TRUE);
              $ratio = 1.8517;
              $white_bg = new \Imagick();
              $white_bg->newImage($reso / $ratio, $reso, new ImagickPixel('white'));
              $white_bg->compositeImage($base, Imagick::COMPOSITE_DEFAULT, $reso / $ratio * 0.02, $reso * 0.3, Imagick::CHANNEL_ALPHA);
              $white_bg->setImageFormat('jpg');

              $base = new Imagick($filename);
              $product_code = $product_code_original;
              break;
          case 'PhoneCase-Iphone-6S-Plus-Tough-Glossy':
  //
  //
  //            exec($fred_scripts_dir . 'imageborder -s 13 -b 3 -m white -p 100 -r white -t 0 -e edge ' . $filename . ' ' . $filename . ' 2>&1', $out, $returnval);
  //            $base = new Imagick($filename);

              break;
          default:
              break;
      }

  //        header('Content-Type: image/jpeg');
  //    echo $base;
  //    die();

      $mask_path = $overlays_dir . $product_code . ".png";
      $mask = new \Imagick();
      $mask->readImageBlob(Storage::cloud()->get($mask_path));
      $w = $base->getImageWidth();
      $h = $base->getImageHeight();
      if (abs($w / $h - $mask->getimagewidth() / $mask->getimageheight()) < 0.1)
          $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
      else
          $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1, true);
  //    $base->resizeImage($reso, $reso, Imagick::FILTER_BOX , 1, true);
      $base->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);

  //    header('Content-Type: image/jpeg');
  //    echo $base;
  //    die();

      $base->writeImage($out_file);
      return 1;
  }

  function add_the_mask_using_imagick($filename, $mask_path) {
      $base = new Imagick($filename);
      $mask = new \Imagick();
      $mask->readImageBlob(Storage::cloud()->get($mask_path));
      $w = $base->getImageWidth();
      $h = $base->getImageHeight();
      $mask->resizeImage($w, $h, Imagick::FILTER_BOX, 1);
      $base->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0, Imagick::CHANNEL_ALPHA);

      return 1;
  }

  function fit_mask($image, $mask) {
      $white_bg = new \Imagick();
      $ratio = $mask->getImageWidth() / $mask->getImageHeight();
      $w = $GLOBALS['reso'];
      $h = $GLOBALS['reso'] / $ratio;

      $white_bg->newImage($w, $h, new ImagickPixel('white'));
      $white_bg->setImageFormat('jpg');
      $size = max($w, $h);

      $image->resizeImage($size, $size, Imagick::FILTER_BOX, 1, true);
      $x = $y = 0;
      if ($image->getImageWidth() < $image->getImageHeight())
          $x = ($w - $image->getImageWidth()) / 2;
      else
          $y = ($h - $image->getImageHeight()) / 2;
      $white_bg->compositeImage($image, Imagick::COMPOSITE_DEFAULT, $size, $size, Imagick::CHANNEL_ALPHA);

      $mask->resizeImage($size, $size, Imagick::FILTER_BOX, 1, true);
      $white_bg->compositeImage($image, Imagick::COMPOSITE_DEFAULT, $x, $y);
      $white_bg->compositeImage($mask, Imagick::COMPOSITE_DEFAULT, 0, 0);

      return $white_bg;
  }

  function get_font_size_by_product_code($product_code, $old_font_size) {
      switch ($product_code) {
          case 'laptop-cover-8':
              return $old_font_size * 9.6;
          case 'laptop-cover-10':
              return $old_font_size * 10.1;
          case 'laptop-cover-13':
              return $old_font_size * 10.1;
          case 'laptop-cover-15':
              return $old_font_size * 10;
          case 'laptop-cover-17':
              return $old_font_size * 10;
          case 'canvswrp-blkwrp-11x14':
              return $old_font_size * 10;
          case 'canvswrp-blkwrp-12x18':
              return $old_font_size * 10;
          case 'totebag-13x13':
              return $old_font_size * 9.8;
          case 'totebag-16x16':
              return $old_font_size * 10.1;
          case 'tshirt-anvil-980':
              return $old_font_size * 10.0;
          case 'canvas-blk-wrap-16x20':
              return $old_font_size * 10.2;
          case 'throw-pillow-sewn-16x16':
              return $old_font_size * 10;
          case 'throw-pillow-sewn-18x18':
              return $old_font_size * 10;
          case 'throw-pillow-sewn-20x14':
              return $old_font_size * 10;
          case 'floormat-36x24-nonslip':
              return $old_font_size * 10;
          case 'phonecase-iphonex-finish':
          case 'phonecase-samsunggalaxy-note-7-finish':
          case 'phonecase-samsunggalaxy-note-7-finish':
          case 'phonecase-samsunggalaxy-s7-finish':
          case 'phonecase-samsunggalaxy-s7-edge-finish':
          case 'phonecase-galaxys8-plus-finish':
          case 'phonecase-galaxys8-finish':
          case 'phonecase-samsung-galaxy-s9':
          case 'phonecase-samsung-galaxy-s9-plus':
          case 'phonecase-samsungs6-edge-finish':
          case 'phonecase-samsungs6-finish':
          case 'phonecase-iphone-6-tough-finish':
          case 'phonecase-iphone-6s-tough-finish':
          case 'phonecase-samsung-s6-edge-tough-finish':
          case 'phonecase-samsung-s6-tough-finish':
          case 'phonecase-iphone8-finish':
          case 'phonecase-iphone8-plus-finish':
          case 'phonecase-iphone7-plus-finish':
          case 'phonecase-iphone7-finish':
          case 'phonecase-iphone-6s-plus-regular-finish':
          case 'phonecase-iphone-6s-plus-tough-finish':
          case 'phonecase-iphone-6-plus-tough-finish':
          case 'phonecase-iphone-6s-regular-finish':
          case 'phonecase-iphone6-finish':
          case 'phonecase-galaxynote5-finish':
          case 'phonecase-iphone-se-finish':
              return $old_font_size * 9.8;

          default:
              return $old_font_size * 10;
              break;
      }

}
