<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RolePermissionController extends Controller
{
  public function createRolesAndPermissions()
  {
      $createPostPermission = Permission::create(['name' => 'create post']);
      $editPostPermission = Permission::create(['name' => 'edit post']);
      $deletePostPermission = Permission::create(['name' => 'delete post']);

      $adminRole = Role::create(['name' => 'admin']);
      $userRole = Role::create(['name' => 'user']);

      $adminRole->givePermissionTo([$createPostPermission, $editPostPermission, $deletePostPermission]);
      $userRole->givePermissionTo([$createPostPermission, $editPostPermission]);

      return response()->json(['message' => 'Roles and permissions created successfully!']);
  }
}