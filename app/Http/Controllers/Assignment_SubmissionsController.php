<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Assignment_Submissions;
use App\Assignments;
use App\Users;
use Auth;
class Assignment_SubmissionsController extends Controller
{
  public function index($assignment_id)
  {
    if(Auth::user()->role_id == 1)
    {
      $submissions = Assignment_Submissions::where('assignment_id',$assignment_id)->with(['assignments_get_submissions','assignment_submissions_students'])->get();
    }
    elseif(Auth::user()->role_id == 6)
    {
      $teacher_id = Assignments::where('id',$assignment_id)->value('teacher_id');
      if($teacher_id == Auth::id())
      {
        $submissions = Assignment_Submissions::where('assignment_id',$assignment_id)->with(['assignments_get_submissions','assignment_submissions_students'])->get();
      }
      else
      {
        $error = 'Error';
        return $error;
      }
    }
    elseif(Auth::user()->role_id == 7)
    {
      $submissions = Assignment_Submissions::where([['assignment_id',$assignment_id],['student_id',Auth::id()]])->with(['assignments_get_submissions','assignment_submissions_students'])->get();
    }
    else{
      $submissions = '';
    }
    return $submissions;
  }

  public function store(Request $request,$assignment_id)
  {
    $assignment_submissions = new Assignment_Submissions;
    $assignment_submissions->title = $request->title;
    $assignment_submissions->answers = $request->answers;
    $assignment_submissions->assignment_id = $assignment_id;
    $assignment_submissions->student_id = Auth::id();
    $assignment_submissions->save();
  }

  public function edit($assignment_id,$id)
  {
    $submission = Assignment_Submissions::findOrFail($id);
    $student_id = $submission->student_id;
    if((Auth::user()->role_id == 7) && (Auth::id() == $student_id))
    {
      return $submission;
    }
    else
    {
      $submission = '';
      return $submission;
    }
  }

  public function view($assignment_id,$id)
  {
    if(Auth::user()->role_id == 1)
    {
      $submission = Assignment_Submissions::where('id',$id)->with(['assignments_get_submissions','assignment_submissions_students'])->first();
    }
    elseif(Auth::user()->role_id == 6)
    {
      $teacher_id = Assignments::where('id',$assignment_id)->value('teacher_id');
      if(Auth::id() == $teacher_id)
      {
        $submission = Assignment_Submissions::where('id',$id)->with(['assignments_get_submissions','assignment_submissions_students'])->first();
      }
      else{
        $submission = '';
      }
    }
    elseif(Auth::user()->role_id == 7)
    {
      $submission = Assignment_Submissions::where('id',$id)->with(['assignments_get_submissions','assignment_submissions_students'])->first();
      $student_id = $submission->student_id;
      if(Auth::id() == $student_id)
      {
        return $submission;
      }
      else{
        $submission = '';
      }
    }

    return $submission;
  }

  public function checkStudentSubmission($assignment_id)
  {
    if(Auth::user()->role_id == 7)
    {
      $submission = Assignment_Submissions::where([['assignment_id',$assignment_id],['student_id',Auth::id()]])->get();
      return $submission;
    }
    else{
      $submission = '';
      return $submission;
    }
  }

  public function update(Request $request,$assignment_id,$id)
  {
    $assignment_submissions = Assignment_Submissions::findOrFail($id);
    $assignment_submissions->title = $request->title;
    $assignment_submissions->answers = $request->answers;
    $assignment_submissions->assignment_id = $assignment_id;
    $assignment_submissions->student_id = Auth::id();
    $assignment_submissions->update();
  }

  public function storeOrUpdateMarks(Request $request,$assignment_id,$id)
  {
    $marks = Assignment_Submissions::findOrFail($id);
    $marks->obtained_marks = $request->obtained_marks;
    $marks->comments = $request->comments;
    $marks->update();
  }

  public function all_students_one_assignment($assignment_id)
  {
    $mapped = Assignment_Submissions::where('assignment_id',$assignment_id)->with('assignment_submissions_students')->get()->map(function($item, $index) {
      return [
        "student" => $item->assignment_submissions_students["name"],
        "obtained_marks" => $item["obtained_marks"]
      ];
    });
    return $mapped;
  }

  public function one_student_all_assignments($student_id)
  {
    $mapped = Assignment_Submissions::where('student_id',$student_id)->with('assignments_get_submissions')->get()->map(function($item, $index) {
      return [
        "assignments" => $item->assignments_get_submissions["title"],
        "obtained_marks" => $item["obtained_marks"]
      ];
    });
    return $mapped;
  }
}
