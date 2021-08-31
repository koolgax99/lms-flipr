<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department_Teachers;
use App\Departments;
use App\Teachers;

class Department_TeachersController extends Controller
{
  public function index()
  {
    $department_teachers = Department_Teachers::with(['department_teachers_get_teachers','department_teachers_get_departments'])->get();
    return $department_teachers;
  }

  public function store(Request $request)
  {
    $department_teachers = new Department_Teachers;
    $department_teachers->department_id = $request->department_id;
    $department_teachers->teacher_id = $request->teacher_id;
    $department_teachers->save();
  }

  public function edit($id)
  {
    $department_teachers = Department_Teachers::findOrFail($id);
    return $department_teachers;
  }

  public function update(Request $request,$id)
  {
    $department_teachers = Department_Teachers::findOrFail($id);
    $department_teachers->department_id = $request->department_id;
    $department_teachers->teacher_id = $request->teacher_id;
    $department_teachers->update();
  }
}
