<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subjects;
use App\Classrooms;
use App\Teachers;
use App\Batches;
use App\Assignments;
use Auth;
use Carbon\Carbon;
use App\Notifications\AssignmentAdded;
use App\User;
class AssignmentsController extends Controller
{
  public function index()
  {
    if(Auth::user()->role_id == 1)
    {
      $assignments = Assignments::with(['assignments_get_teachers','assignments_get_subjects','assignments_get_classrooms','assignments_get_batches'])->get();
    }
    elseif(Auth::user()->role_id == 6)
    {
      $assignments = Assignments::where('teacher_id',Auth::id())->with(['assignments_get_teachers','assignments_get_subjects','assignments_get_classrooms','assignments_get_batches'])->get();
    }
    elseif(Auth::user()->role_id == 7)
    {
      $assignments = Assignments::where('batch_id',Auth::user()->batch_id)->orWhere('classroom_id',Auth::user()->classroom_id)->with(['assignments_get_teachers','assignments_get_subjects','assignments_get_classrooms','assignments_get_batches'])->get();
    }
    return $assignments;
  }

  public function checkStudentAddAssignmentSubmissionPermission($assignment_id)
  {
    $assignment = Assignments::where('id',$assignment_id)->first();
    $classroom_id = $assignment->classroom_id;
    $batch_id = $assignment->batch_id;
    if((Auth::user()->role_id == 7) && ((Auth::user()->batch_id == $batch_id) || (Auth::user()->classroom_id == $classroom_id)))
    {
      return $assignment;
    }
  }
  public function checkStudentEditAssignmentSubmissionPermission($assignment_id,$id)
  {
    $submission = Assignment_Submissions::where([['id',$id],['assignment_id',$assignment_id]])->first();
    $student_id = $submission->student_id;
    if((Auth::user()->role_id == 7) && (Auth::id() == $student_id))
    {
      return $assignment;
    }
  }

  public function store(Request $request)
  {
    $assignments = new Assignments;
    $assignments->title = $request->title;
    $assignments->description = $request->description;
    $assignments->start_date_and_time = Carbon::parse($request->start_date_and_time)->format('d-m-Y H:i');
    $assignments->end_date_and_time = Carbon::parse($request->end_date_and_time)->format('d-m-Y H:i');
    $assignments->maximum_marks = $request->maximum_marks;
    $assignments->more_details = $request->more_details;
    $assignments->teacher_id = Auth::id();
    $assignments->subject_id = $request->subject_id;
    if(!empty($request->classroom_id))
    {
      $assignments->classroom_id = $request->classroom_id;
    }
    if(!empty($request->batch_id))
    {
      $assignments->batch_id = $request->batch_id;
    }
    $assignments->allow_deadline_submission = $request->allow_deadline_submission;
    $assignments->save();
    //return $assignments->send_email;
    if(!empty($assignments->classroom_id) && ($request->send_email == '1'))
    {
      $assignment = Assignments::where('id',$assignments->id)->with('assignments_get_teachers','assignments_get_subjects')->first();
      $users = User::where('classroom_id',$assignment->classroom_id)->get();
      //$app_url = ;
      $url = config('app.url')."/"."assignments/".$assignment->id."/view";
      $msg = "Assignment - ". $assignment->title. " has been added by ". $assignment->assignments_get_teachers->name. " for the Subject ".$assignment->assignments_get_subjects->title." with deadline ". $assignment->end_date_and_time. " Total marks for this assignment are ".$assignment->maximum_marks. " Submit your assignment on time to ensure that marks are not deducted for late submission.";
      return $msg;
      //Notification::send($users, new AssignmentAdded($msg,$url));
    }
    elseif(!empty($assignments->batch_id) && ($request->send_email == '1'))
    {
      $assignment = Assignments::where('id',$assignments->id)->with('assignments_get_teachers','assignments_get_subjects')->first();
      $users = User::where('batch_id',$assignment->batch_id)->get();
      //$app_url = ;
      $url = config('app.url')."/"."assignments/".$assignment->id."/view";
      $msg = "Assignment - ". $assignment->title. " has been added by ". $assignment->assignments_get_teachers->name. " for the Subject ".$assignment->assignments_get_subjects->title." with deadline ". $assignment->end_date_and_time. " Total marks for this assignment are ".$assignment->maximum_marks. " Submit your assignment on time to ensure that marks are not deducted for late submission.";
      return $msg;
      //Notification::send($users, new AssignmentAdded($msg,$url));
    }
  }

  public function edit($id)
  {
    $assignments = Assignments::findOrFail($id);
    return $assignments;
  }

  public function update(Request $request,$id)
  {
    $assignments = Assignments::findOrFail($id);
    $assignments->title = $request->title;
    $assignments->description = $request->description;
    $assignments->attachments = $request->attachments;
    $assignments->start_date_and_time = $request->start_date_and_time;
    $assignments->end_date_and_time = $request->end_date_and_time;
    $assignments->maximum_marks = $request->maximum_marks;
    $assignments->more_details = $request->more_details;
    $assignments->teacher_id = $request->teacher_id;
    $assignments->subject_id = $request->subject_id;
    $assignments->classroom_id = $request->classroom_id;
    $assignments->batch_id = $request->batch_id;
    $assignments->allow_deadline_submission = $request->allow_deadline_submission;
    $assignments->update();
  }

  public function view($id)
  {
    if(Auth::user()->role_id == 1)
    {
      $assignments = Assignments::with(['assignments_get_teachers','assignments_get_subjects','assignments_get_classrooms','assignments_get_batches'])->where('id',$id)->get();
    }
    elseif(Auth::user()->role_id == 6)
    {

      $assignments = Assignments::where('id',$id)->with(['assignments_get_teachers','assignments_get_subjects','assignments_get_classrooms','assignments_get_batches'])->get();
    }
    elseif(Auth::user()->role_id == 7)
    {
      $assignments = Assignments::where('id',$id)->with(['assignments_get_teachers','assignments_get_subjects','assignments_get_classrooms','assignments_get_batches','assignments_get_submissions'])->get();
    }
    return $assignments;
  }
}
