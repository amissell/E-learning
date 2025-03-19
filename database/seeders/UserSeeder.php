<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $user = User::create([
      'name' => 'John Doe',
      'email' => 'john@example.com',
      'password' => bcrypt('password123'),
    ]);

    // Assign roles to the user
    $user->assignRole('admin');
  }
}
