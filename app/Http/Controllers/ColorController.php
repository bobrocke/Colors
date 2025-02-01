<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

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
    return view("colors", ["color_hex" => $color_hex]);
  }
}
