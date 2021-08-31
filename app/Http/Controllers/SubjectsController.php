<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subjects;
use App\Classroom_Teachers;
use App\Batch_Teachers;
use Auth;
class SubjectsController extends Controller
{
  public function index()
  {
    $subjects = Subjects::all();
    return $subjects;
  }

  public function getTeacherClassroomSubjects($classroom_id)
  {
    $subject_ids = Classroom_Teachers::where([['classroom_id',$classroom_id],['teacher_id',Auth::id()]])->pluck('subject_id');
    $subjects = Subjects::whereIn('id',$subject_ids)->get();
    return $subjects;
  }

  public function getTeacherBatchSubjects($batch_id)
  {
    $subject_ids = Batch_Teachers::where([['batch_id',$batch_id],['teacher_id',Auth::id()]])->pluck('subject_id');
    $subjects = Subjects::whereIn('id',$subject_ids)->get();
    return $subjects;
  }

  public function store(Request $request)
  {
    $subjects = new Subjects;
    $subjects->title = $request->title;
    $subjects->description = $request->description;
    $subjects->semester = $request->semester;
    $subjects->code = $request->code;
    $subjects->lecture_hours_per_week = $request->lecture_hours_per_week;
    $subjects->tutorial_hours_per_week = $request->tutorial_hours_per_week;
    $subjects->practical_hours_per_week = $request->practical_hours_per_week;
    $subjects->ss_hours_per_week = $request->ss_hours_per_week;
    $subjects->credits = $request->credits;
    $subjects->save();
  }

  public function edit($id)
  {
    $subjects = Subjects::findOrFail($id);
    return $subjects;
  }

  public function update(Request $request,$id)
  {
    $subjects = Subjects::findOrFail($id);
    $subjects->title = $request->title;
    $subjects->description = $request->description;
    $subjects->semester = $request->semester;
    $subjects->code = $request->code;
    $subjects->lecture_hours_per_week = $request->lecture_hours_per_week;
    $subjects->tutorial_hours_per_week = $request->tutorial_hours_per_week;
    $subjects->practical_hours_per_week = $request->practical_hours_per_week;
    $subjects->ss_hours_per_week = $request->ss_hours_per_week;
    $subjects->credits = $request->credits;
    $subjects->update();
  }
}
