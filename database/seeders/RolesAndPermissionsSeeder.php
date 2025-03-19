<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesAndPermissionsSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run()
  {
    // Create permissions
    $permissions = [
      'create courses',
      'edit courses',
      'delete courses',
      'view courses',
      'create users',
      'edit users',
      'delete users',
      'assign roles'
    ];

    foreach ($permissions as $permission) {
      Permission::create(['name' => $permission]);
    }

    // Create roles and assign permissions
    $adminRole = Role::create(['name' => 'admin']);
    $adminRole->givePermissionTo(Permission::all()); 

    $mentorRole = Role::create(['name' => 'mentor']);
    $mentorRole->givePermissionTo(['create courses', 'edit courses', 'view courses']);

    $studentRole = Role::create(['name' => 'student']);
    $studentRole->givePermissionTo(['view courses']);
  }
}
