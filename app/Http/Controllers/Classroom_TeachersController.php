<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classroom_Teachers;
use App\Departments;
use App\Subjects;
use App\Classrooms;
use App\Teachers;

class Classroom_TeachersController extends Controller
{
  public function index()
  {
    $classroom_teachers = Classroom_Teachers::all();
    return $classroom_teachers;
  }

  public function classroom_index($id)
  {
    $teachers = Classroom_Teachers::where('classroom_id',$id)->with(['classroom_teachers_get_teachers','classroom_teachers_get_subjects'])->get();
    return $teachers;
  }

  public function store(Request $request,$classroom_id)
  {
    $classroom_teachers = new Classroom_Teachers;
    $classroom_teachers->classroom_id = $classroom_id;
    $classroom_teachers->teacher_id = $request->teacher_id;
    $classroom_teachers->subject_id = $request->subject_id;
    $classroom_teachers->save();
  }

  public function edit($id)
  {
    $classroom_teachers = Classroom_Teachers::findOrFail($id);
    return $classroom_teachers;
  }

  public function update(Request $request,$classroom_id,$id)
  {
    $classroom_teachers = Classroom_Teachers::findOrFail($id);
    $classroom_teachers->teacher_id = $request->teacher_id;
    $classroom_teachers->subject_id = $request->subject_id;
    $classroom_teachers->classroom_id = $classroom_id;
    $classroom_teachers->update();
  }
}
