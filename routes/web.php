<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ColorController;

Route::get("/", function () {
  return view("welcome");
});

Route::view("/home", "home")->name("home");
Route::view("/about", "about")->name("about");

Route::get("/ranges", function () {
  return view("ranges");
})->name("ranges");

Route::resource("colors", ColorController::class);
