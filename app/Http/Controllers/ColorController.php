<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ColorController extends Controller
{
  public function index()
  {
    $color = DB::table("colors")->find(1);
    $color_hex = $color->hex;
    $color_r = $color->r;
    $color_g = $color->g;
    $color_b = $color->b;
    $color_h = $color->h;
    $color_s = $color->s;
    $color_l = $color->l;

    $color_hsb = $this->hex_hsb($color_hex);
    Log::info($color_hsb);
    return view("colors", ["color_hex" => $color_hex]);
  }

  private function hex_hsb($hex)
  {
    $hsb = [0, 0, 53];
    return $hsb;
  }

  private function hex_rgb($hex)
  {
    $rgb = [136, 136, 136];
    return $rgb;
  }

  private function rgb_hex($rgb)
  {
    $hex = "#888888";
    return $hex;
  }

  private function hsb_hex($hsb)
  {
    $hex = "#888888";
    return $hex;
  }
}

// Convert target color to HSB
// Start with HS0 and step to HS.1 through HS1
// Convert HS0 through HS1 into RGB and HEX
// Create an array with  columns (HEX, RGB, HSB) with rows for 0 - 100 brightness in 10 steps
