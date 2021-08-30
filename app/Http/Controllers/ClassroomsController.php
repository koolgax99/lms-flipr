<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departments;
use App\Classrooms;
use App\User;
class ClassroomsController extends Controller
{
  public function index()
  {
    $classrooms = Classrooms::all();
    return $classrooms;
  }

  public function store(Request $request)
  {
    $classrooms = new Classrooms;
    $classrooms->title = $request->title;
    $classrooms->description = $request->description;
    $classrooms->department_id = $request->department_id;
    $classrooms->class_teacher_id = $request->class_teacher_id;
    $classrooms->start_date = $request->start_date;
    $classrooms->end_date = $request->end_date;
    $classrooms->visibility = $request->visibility;
    $classrooms->save();
  }

  public function edit($id)
  {
    $classrooms = Classrooms::findOrFail($id);
    return $classrooms;
  }

  public function update(Request $request,$id)
  {
    $classrooms = Classrooms::findOrFail($id);
    $classrooms->title = $request->title;
    $classrooms->description = $request->description;
    $classrooms->start_date = $request->start_date;
    $classrooms->department_id = $request->department_id;
    $classrooms->class_teacher_id = $request->class_teacher_id;
    $classrooms->end_date = $request->end_date;
    $classrooms->visibility = $request->visibility;
    $classrooms->update();
  }
}
