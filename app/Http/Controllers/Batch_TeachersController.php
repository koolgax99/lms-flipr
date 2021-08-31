<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Batch_Teachers;
use App\Departments;
use App\Subjects;
use App\Classrooms;
use App\Teachers;
use App\Batches;

class Batch_TeachersController extends Controller
{
  public function index()
  {
    $batch_teachers = Batch_Teachers::with(['batch_teachers_get_teachers','batch_teachers_get_subjects'])->get();
    return $batch_teachers;
  }

  public function batch_index($batch_id)
  {
    $teachers = Batch_Teachers::where('batch_id',$batch_id)->get();
    return $teachers;
  }

  public function store(Request $request,$batch_id)
  {
    $batch_teachers = new Batch_Teachers;
    $batch_teachers->teacher_id = $request->teacher_id;
    $batch_teachers->subject_id = $request->subject_id;
    $batch_teachers->batch_id = $batch_id;
    $batch_teachers->save();
  }

  public function edit($batch_id,$id)
  {
    $batch_teachers = Batch_Teachers::findOrFail($id);
    return $batch_teachers;
  }

  public function update(Request $request,$batch_id,$id)
  {
    $batch_teachers = Batch_Teachers::findOrFail($id);
    $batch_teachers->teacher_id = $request->teacher_id;
    $batch_teachers->subject_id = $request->subject_id;
    $batch_teachers->batch_id = $batch_id;
    $batch_teachers->update();
  }
}
