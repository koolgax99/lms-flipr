<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classroom_Timetable;
use App\Departments;
use App\Classrooms;
use App\Batches;
use App\Batch_Teachers;
use Auth;
use App\User;

class Classroom_TimetableController extends Controller
{
    public function index()
  {
    if(Auth::user()->role_id == 1)
    {
      $classroom_timetable = Classroom_Timetable::with(['classroom_timetable_get_subjects'])->get();
    }
    elseif(Auth::user()->role_id == 6)
    {
      $classroom_timetable = Classroom_Timetable::where('teacher_id',Auth::id())->with(['classroom_timetable_get_subjects'])->get();
    }
    elseif(Auth::user()->role_id == 7)
    {
      $classroom_timetable = Classroom_Timetable::where('classroom_id',Auth::user()->classroom_id)->orWhere('batch_id',Auth::user()->batch_id)->with(['classroom_timetable_get_subjects'])->get();
    }
    else
    {
      $classroom_timetable = '';
    }
    $classroom_timetable = Classroom_Timetable::all();
    return $classroom_timetable;
  }

  public function store(Request $request)
  {
    $classroom_timetable = new Classroom_Timetable;
    $classroom_timetable->title = $request->title;
    $classroom_timetable->department_id = $request->department_id;
    $classroom_timetable->classroom_id = $request->classroom_id;
    $classroom_timetable->batch_id = $request->batch_id;
    $classroom_timetable->day_of_the_week = $request->day_of_the_week;
    $classroom_timetable->subject_id = $request->subject_id;
    $classroom_timetable->semester_start_date = $request->semester_start_date;
    $classroom_timetable->semester_end_date = $request->semester_end_date;
    $classroom_timetable->lecture_start_time = $request->lecture_start_time;
    $classroom_timetable->lecture_end_time = $request->lecture_end_time;
    $classroom_timetable->visibility = $request->visibility;
    $classroom_timetable->save();
  }

  public function edit($id)
  {
    $classroom_timetable = Classroom_Timetable::findOrFail($id);
    return $classroom_timetable;
  }

  public function update(Request $request,$id)
  {
    $classroom_timetable = Classroom_Timetable::findOrFail($id);
    $classroom_timetable->title = $request->title;
    $classroom_timetable->department_id = $request->department_id;
    $classroom_timetable->classroom_id = $request->classroom_id;
    $classroom_timetable->batch_id = $request->batch_id;
    $classroom_timetable->day_of_the_week = $request->day_of_the_week;
    $classroom_timetable->subject_id = $request->subject_id;
    $classroom_timetable->semester_start_date = $request->semester_start_date;
    $classroom_timetable->semester_end_date = $request->semester_end_date;
    $classroom_timetable->lecture_start_time = $request->lecture_start_time;
    $classroom_timetable->lecture_end_time = $request->lecture_end_time;
    $classroom_timetable->visibility = $request->visibility;
    $classroom_timetable->update();
  }
}
