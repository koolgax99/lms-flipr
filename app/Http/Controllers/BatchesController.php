<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Batches;
use App\Classrooms;
use App\Batch_Teachers;
use Auth;
use App\User;

class BatchesController extends Controller
{
  public function index()
  {
    $batches = Batches::all();
    return $batches;
  }

  public function getTeacherBatches()
  {
    $batch_ids = Batch_Teachers::where('teacher_id',Auth::id())->pluck('batch_id');
    $batches = Batches::whereIn('id',$batch_ids)->get();
    return $batches;
  }

  public function getBatchStudents($batch_id)
  {
    $students = User::where('batch_id',$batch_id)->get();
    return $students;
  }

  public function store(Request $request)
  {
    $batches = new Batches;
    $batches->title = $request->title;
    $batches->description = $request->description;
    $batches->classroom_id = $request->classroom_id;
    $batches->visibility = $request->visibility;
    $batches->save();
  }

  public function edit($id)
  {
    $batches = Batches::findOrFail($id);
    return $batches;
  }

  public function update(Request $request,$id)
  {
    $batches = Batches::findOrFail($id);
    $batches->title = $request->title;
    $batches->description = $request->description;
    $batches->classroom_id = $request->classroom_id;
    $batches->visibility = $request->visibility;
    $batches->update();
  }
}
