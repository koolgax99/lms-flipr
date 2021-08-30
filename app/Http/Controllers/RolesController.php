<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
class RolesController extends Controller
{
  public function index()
  {
    $roles = Role::all();
    return $roles;
  }

  public function store(Request $request)
  {
    $roles = new Role;
    $roles->title = $request->title;
    $roles->description = $request->description;
    $roles->save();
  }

  public function edit($id)
  {
    $role = Role::findOrFail($id);
    return $role;
  }

  public function update(Request $request,$id)
  {
    $roles = Role::findOrFail($id);
    $roles->title = $request->title;
    $roles->description = $request->description;
    $roles->update();
  }
}
