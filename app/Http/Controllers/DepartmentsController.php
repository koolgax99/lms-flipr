<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departments;
class DepartmentsController extends Controller
{
  public function index()
  {
    $departments = Departments::all();
    return $departments;
  }

  public function store(Request $request)
  {
    $departments = new Departments;
    $departments->title = $request->title;
    $departments->description = $request->description;
    $departments->year_of_establishment = $request->year_of_establishment;
    $departments->save();
  }

  public function edit($id)
  {
    $departments = Departments::findOrFail($id);
    return $departments;
  }

  public function update(Request $request,$id)
  {
    $departments = Departments::findOrFail($id);
    $departments->title = $request->title;
    $departments->description = $request->description;
    $departments->year_of_establishment = $request->year_of_establishment;
    $departments->update();
  }
}
