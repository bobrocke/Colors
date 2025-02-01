<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create("colors", function (Blueprint $table) {
      $table->id();
      $table->string("hex");
      $table->integer("r");
      $table->integer("g");
      $table->integer("b");
      $table->integer("h");
      $table->integer("s");
      $table->integer("l");
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists("colors");
  }
};
