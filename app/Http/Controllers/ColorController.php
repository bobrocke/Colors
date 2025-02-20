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

    // $color_hsb = $this->hex_hsb($color_hex);
    // Log::info($color_hsb);

    $hsl_range = [];
    for ($i = 0; $i <= 10; $i++) {
      $hsl_range[$i] = [$color_h, $color_s, $i * 10];
    }
    // Log::info($hsb_range);

    $rgb_range = [];
    for ($i = 0; $i <= 10; $i++) {
      // Log::info($hsb_range[$i][2]);
      $rgb_range[$i] = $this->hsl_to_rgb(
        $hsl_range[$i][0],
        $hsl_range[$i][1],
        $hsl_range[$i][2]
      );
    }
    // Log::info($rgb_range);

    $hex_range = [];
    for ($i = 0; $i <= 10; $i++) {
      $hex_range[$i] = $this->rgb_to_hex(
        $rgb_range[$i][0],
        $rgb_range[$i][1],
        $rgb_range[$i][2]
      );
    }
    // Log::info($hex_range);

    return view("colors", [
      "color_hex" => $color_hex,
      "hex_range" => $hex_range,
      "rgb_range" => $rgb_range,
      "hsl_range" => $hsl_range,
    ]);
  }

  // https://www.ultimatesolver.com/en/colorformats--description

  private function hsl_to_rgb($o_H, $o_S, $o_V)
  {
    $H = $o_H;
    $s = $o_S / 100;
    $v = $o_V / 100;

    $hi = floor($H / 60);
    $f = $H / 60 - $hi;
    $p = $v * (1 - $s);
    $q = $v * (1 - $s * $f);
    $t = $v * (1 - $s * (1 - $f));

    switch ($hi) {
      case 1:
        $r = $q;
        $g = $v;
        $b = $p;
        break;
      case 2:
        $r = $p;
        $g = $v;
        $b = $t;
        break;
      case 3:
        $r = $p;
        $g = $q;
        $b = $v;
        break;
      case 4:
        $r = $t;
        $g = $p;
        $b = $v;
        break;
      case 5:
        $r = $v;
        $g = $p;
        $b = $q;
        break;
      default:
        $r = $v;
        $g = $t;
        $b = $p;
        break;
    }

    $R = (int) (255 * $r);
    $G = (int) (255 * $g);
    $B = (int) (255 * $b);

    $color_rgb = [$R, $G, $B];

    return $color_rgb;
  }

  private function rgb_to_hex($R, $G, $B)
  {
    $R = strtoupper(dechex($R));
    if (strlen($R) < 2) {
      $R = "0" . $R;
    }

    $G = strtoupper(dechex($G));
    if (strlen($G) < 2) {
      $G = "0" . $G;
    }

    $B = strtoupper(dechex($B));
    if (strlen($B) < 2) {
      $B = "0" . $B;
    }

    return "#" . $R . $G . $B;
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

  private function hsb_hex($hsb)
  {
    $hex = "#888888";
    return $hex;
  }

  private function rgb_to_hsl($R, $G, $B)
  {
    $HSL = [];

    $var_R = $R / 255;
    $var_G = $G / 255;
    $var_B = $B / 255;

    $var_Min = min($var_R, $var_G, $var_B);
    $var_Max = max($var_R, $var_G, $var_B);
    $del_Max = $var_Max - $var_Min;

    $V = $var_Max;

    if ($del_Max == 0) {
      $H = 0;
      $S = 0;
    } else {
      $S = $del_Max / $var_Max;

      $del_R = (($var_Max - $var_R) / 6 + $del_Max / 2) / $del_Max;
      $del_G = (($var_Max - $var_G) / 6 + $del_Max / 2) / $del_Max;
      $del_B = (($var_Max - $var_B) / 6 + $del_Max / 2) / $del_Max;

      if ($var_R == $var_Max) {
        $H = $del_B - $del_G;
      } elseif ($var_G == $var_Max) {
        $H = 1 / 3 + $del_R - $del_B;
      } elseif ($var_B == $var_Max) {
        $H = 2 / 3 + $del_G - $del_R;
      }

      if ($H < 0) {
        $H++;
      }
      if ($H > 1) {
        $H--;
      }
    }

    $HSL["H"] = $H;
    $HSL["S"] = $S;
    $HSL["V"] = $V;

    return $HSL;
  }
}

// Convert target color to HSB
// Start with HS0 and step to HS.1 through HS1
// Convert HS0 through HS1 into RGB and HEX
// Create an array with  columns (HEX, RGB, HSB) with rows for 0 - 100 brightness in 10 steps
