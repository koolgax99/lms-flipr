<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departments;
use App\Classrooms;
use App\User;
use App\Classroom_Teachers;
use Auth;
use App\Batches;
use App\Batch_Teachers;
class ClassroomsController extends Controller
{
  public function index()
  {
    $classrooms = Classrooms::all();
    return $classrooms;
  }

  public function getTeacherClassrooms()
  {
    if(Auth::user()->role_id == 1)
    {
      $classrooms = Classrooms::all();
      return $classrooms;
    }
    elseif(Auth::user()->role_id == 6)
    {
      $classroom_ids = Classroom_Teachers::where('teacher_id',Auth::id())->pluck('classroom_id');
      $classrooms = Classrooms::whereIn('id',$classroom_ids)->get();
      return $classrooms;
    }
    else
    {
      $classrooms = '';
      return $classrooms;
    }
  }

  public function getClassroomStudents($classroom_id)
  {
    $students = User::where('classroom_id',$classroom_id)->with(['classrooms_get_students','batches_get_students'])->get();
    return $students;
  }

  public function getClassroomBatches($classroom_id)
  {
    if(Auth::user()->role_id == '1')
    {
      $batches = Batches::where('classroom_id',$classroom_id)->get();
      return $batches;
    }
    elseif(Auth::user()->role_id == '6')
    {
      $batch_ids = Batch_Teachers::where('teacher_id',Auth::id())->pluck('batch_id');
      $batches = Batches::where('classroom_id',$classroom_id)->whereIn('id',$batch_ids)->get();
      return $batches;
    }
  }

  public function getDepartmentClassrooms($department_id)
  {
    $classrooms = Classrooms::where('department_id',$department_id)->get();
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
