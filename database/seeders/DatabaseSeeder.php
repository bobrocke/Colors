<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    // User::factory(10)->create();

    // User::factory()->create([
    //   "name" => "Test User",
    //   "email" => "test@example.com",
    // ]);

    DB::table("colors")->insert([
      "hex" => "#888888",
      "r" => 136,
      "g" => 136,
      "b" => 136,
      "h" => 0,
      "s" => 0,
      "l" => 53,
    ]);
  }
}
