<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ColorController extends Controller
{
  public function show()
  {
    $color = DB::table("colors")->first();
    $color_hex = $color->hex;
    $color_r = $color->r;
    $color_g = $color->g;
    $color_b = $color->b;
    $color_h = $color->h;
    $color_s = $color->s;
    $color_l = $color->l;

    // Log::info($color_hex);

    $color_hsl = $this->hex_to_hsl($color_hex);
    // Log::info($color_hsl);

    for ($i = 0; $i <= 10; $i++) {
      $hsl_range[$i] = [$color_h, $color_s, $i * 10];
    }
    // Log::info($hsl_range);

    for ($i = 0; $i <= 10; $i++) {
      $rgb_range[$i] = $this->hsl_to_rgb($hsl_range[$i]);
    }
    // Log::info($rgb_range);

    for ($i = 1; $i <= 10; $i++) {
      $hex_range[$i] = $this->rgb_to_hex($rgb_range[$i]);
    }
    // Log::info($hex_range);

    return view("colors", [
      "color_hex" => $color_hex,
      "hex_range" => $hex_range,
      "rgb_range" => $rgb_range,
      "hsl_range" => $hsl_range,
    ]);
  }

  public function set(Request $request)
  {
    switch (request("color_model")) {
      case "hex":
        $request->validate([
          "the_color_hex" => [
            "required",
            // 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/',
            'regex:/([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/',
          ],
        ]);

        $new_hex = request("the_color_hex");
        if (!str_starts_with("#", $new_hex)) {
          $new_hex = "#" . $new_hex;
        }

        $new_rgb = $this->hex_to_rgb($new_hex);
        // Log::debug($new_rgb);

        $new_hsl = $this->rgb_to_hsl($new_rgb);
        // Log::debug($new_hsl);

        $affected = DB::table("colors")
          ->where("id", 1)
          ->update([
            "hex" => $new_hex,
            "r" => $new_rgb[0],
            "g" => $new_rgb[1],
            "b" => $new_rgb[2],
            "h" => $new_hsl[0],
            "s" => $new_hsl[1],
            "l" => $new_hsl[2],
          ]);

        // $color = DB::table("colors")->first();

        return to_route("colors");
        break;
    }
  }

  // https://www.ultimatesolver.com/en/colorformats--description

  private function hsl_to_rgb($hsl)
  {
    // Fixed up 3/9/25
    // https://gist.github.com/brandonheyer/5254516

    $h = $hsl[0];
    $s = $hsl[1] / 100;
    $l = $hsl[2] / 100;

    $c = (1 - abs(2 * $l - 1)) * $s;
    $x = $c * (1 - abs(fmod($h / 60, 2) - 1));
    $m = $l - $c / 2;

    if ($h < 60) {
      $r = $c;
      $g = $x;
      $b = 0;
    } elseif ($h < 120) {
      $r = $x;
      $g = $c;
      $b = 0;
    } elseif ($h < 180) {
      $r = 0;
      $g = $c;
      $b = $x;
    } elseif ($h < 240) {
      $r = 0;
      $g = $x;
      $b = $c;
    } elseif ($h < 300) {
      $r = $x;
      $g = 0;
      $b = $c;
    } else {
      $r = $c;
      $g = 0;
      $b = $x;
    }

    $r = round(($r + $m) * 255, 0, PHP_ROUND_HALF_UP);
    $g = round(($g + $m) * 255, 0, PHP_ROUND_HALF_UP);
    $b = round(($b + $m) * 255, 0, PHP_ROUND_HALF_UP);

    Log::info($hsl);
    Log::info([$r, $g, $b]);

    return [$r, $g, $b];
  }

  private function rgb_to_hex($rgb)
  {
    $R = strtoupper(dechex($rgb[0]));
    if (strlen($R) < 2) {
      $R = "0" . $R;
    }

    $G = strtoupper(dechex($rgb[1]));
    if (strlen($G) < 2) {
      $G = "0" . $G;
    }

    $B = strtoupper(dechex($rgb[2]));
    if (strlen($B) < 2) {
      $B = "0" . $B;
    }

    return "#" . $R . $G . $B;
  }

  private function hex_to_hsl($hex)
  {
    $rgb = $this->hex_to_rgb($hex);
    $hsl = $this->rgb_to_hsl($rgb);

    return $hsl;
  }

  private function hex_to_rgb($hex)
  {
    $hex = str_replace("#", "", $hex);

    if (strlen($hex) == 3) {
      $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
      $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
      $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
    } else {
      $r = hexdec(substr($hex, 0, 2));
      $g = hexdec(substr($hex, 2, 2));
      $b = hexdec(substr($hex, 4, 2));
    }
    return [$r, $g, $b];
  }

  private function hsl_hex($hsb)
  {
    $hex = "#888888";
    return $hex;
  }

  private function rgb_to_hsl($rgb)
  {
    // Fixed up 3/9/25
    // https://gist.github.com/brandonheyer/5254516

    $r = $rgb[0];
    $g = $rgb[1];
    $b = $rgb[2];

    $r /= 255;
    $g /= 255;
    $b /= 255;

    $max = max($r, $g, $b);
    $min = min($r, $g, $b);

    $l = ($max + $min) / 2;
    $d = $max - $min;

    if ($d == 0) {
      $h = $s = 0; // achromatic
    } else {
      $s = $d / (1 - abs(2 * $l - 1));

      switch ($max) {
        case $r:
          $h = 60 * fmod(($g - $b) / $d, 6);
          if ($b > $g) {
            $h += 360;
          }
          break;

        case $g:
          $h = 60 * (($b - $r) / $d + 2);
          break;

        case $b:
          $h = 60 * (($r - $g) / $d + 4);
          break;
      }
    }

    $h = (int) round($h, 0, PHP_ROUND_HALF_UP);
    $s = (int) round($s * 100, 0, PHP_ROUND_HALF_UP);
    $l = (int) round($l * 100, 0, PHP_ROUND_HALF_UP);

    return [$h, $s, $l];
  }
}
