<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Attendance;
use Auth;
use App\AttendanceStatus;
use App\User;
class AttendanceController extends Controller
{
  public function index()
  {
    if(Auth::user()->role_id == 1)
    {
      $attendance = Attendance::with(['attendance_get_status','attendance_get_subjects','attendance_get_batches','attendance_get_classrooms','attendance_get_teachers'])->get();
    }
    elseif(Auth::user()->role_id == 6)
    {
      $attendance = Attendance::where('teacher_id',Auth::id())->with(['attendance_get_status','attendance_get_subjects','attendance_get_batches','attendance_get_classrooms','attendance_get_teachers'])->get();
      return $attendance;
    }
    elseif(Auth::user()->role_id == 7)
    {
      $attendance = Attendance::where('batch_id',Auth::user()->batch_id)->orWhere('classroom_id',Auth::user()->classroom_id)->with(['attendance_get_status','attendance_get_subjects','attendance_get_batches','attendance_get_classrooms','attendance_get_teachers'])->get();
      return $attendance;
    }
    else
    {
      $attedance = '';
    }
    return $attendance;
  }



  // This function stores the attendance in the database
  public function store_attendance(Request $request)
  {
    $attendance = new Attendance;
    $attendance->classroom_id = $request->classroom_id;
    $attendance->batch_id = $request->batch_id;
    $attendance->subject_id = $request->subject_id;
    $attendance->date = $request->date;
    $attendance->added_by = Auth::id();
    $attendance->teacher_id = Auth::id();
    $attendance->save();
    return $attendance;
  }

  // This function gets the data for the take_daily_attendance page
  public function take_daily_attendance($attendance_id)
  {
    $attendance = Attendance::findOrFail($attendance_id);
    if((Auth::user()->isTeacher() && $attendance->added_by == Auth::id()) || Auth::user()->isAdmin() || Auth::user()->isPrincipal())
    {

        $attendance_id = $attendance->id;
        $status = ['1' => 'Present', '2' => 'Absent', '3'=>'Late'];
        $attendance_classroom_id = $attendance->classroom_id;
        $users = User::where('student_classroom_id',$attendance_classroom_id)->get();
        $subject_id = $attendance->subject_id;
        $status = ['1' => 'Present', '2' => 'Absent', '3'=>'Late'];
        return view('classroom-attendance.take_daily_attendance',compact('users','attendance_id','status','subject_id'));
    }
    else
    {
      return redirect()->back()->with('warning',trans('controller.attendance.create_error'));
    }
  }

  public function notification($attendance_id)
  {
    $attendance = Attendance::findOrFail($attendance_id);
    $added_by = $attendance->added_by;
    if((Auth::user()->isTeacher() && $added_by == Auth::id()) || Auth::user()->isAdmin() || Auth::user()->isPrincipal() || Auth::user()->isOfficeStaff())
    {
      $attendance_status = AttendanceStatus::where('attendance_id',$attendance_id)->get();
      $subject = Subjects::findOrFail($attendance->subject_id);
      foreach ($attendance_status as $status)
      {
        $user = User::findOrFail($status->student_id);
        $username = $user->name;
        $parent = StudentParents::where('student_id',$user->id)->first();
        if ($parent) {
          $user = User::findOrFail($parent->parent_id);
        }
        $user->notify(new AttendanceNotification($attendance,$status,$subject,$username));
      }
      return redirect()->route('classroom-attendance.index')->with('success','Notification Sent Successfully');
    }
    else
    {
      return redirect()->back()->with('warning',trans('You are not allowed to send notifications'));
    }
  }

  // This function stores the daily attendance into the database
  public function store_daily_attendance(Request $request, $attendance_id)
  {
    $attendance = Attendance::findOrFail($attendance_id);
    if($attendance->classroom_id !='')
    {
      $students = User::where('classroom_id',$attendance->classroom_id)->pluck('id');
      $students_count = User::where('classroom_id',$attendance->classroom_id)->count();
    }
    else
    {
      $students = User::where('batch_id',$attendance->batch_id)->pluck('id');
      $students_count = User::where('batch_id',$attendance->batch_id)->count();
    }
    for($i = 0;$i < $students_count;$i++)
    {
      $attendance_status = new AttendanceStatus();
      $attendance_status->attendance_id = $attendance_id;
      $attendance_status->subject_id = $attendance->subject_id;
      $attendance_status->student_id = $students[$i];
      $attendance_status->status = $request->status[$i+1];
      $attendance_status->save();
    }
  }

  // This function gets the data for daily_attendance index page
  public function daily_attendance($attendance_id)
  {
    $attendance = Attendance::findOrFail($attendance_id);
    if(Auth::user()->role_id == 1)
    {
      $attendance_status = AttendanceStatus::where('attendance_id',$attendance_id)->get();
      return $attendance_status;
    }
    elseif(Auth::user()->role_id == 6)
    {
      $attendance_status = AttendanceStatus::where([['attendance_id',$attendance_id],['added_by',Auth::id()]])->get();
      return $attendance_status;
    }
    else
    {
      $attendance_status = '';
      return $attendance_status;
    }
  }

  public function view($attendance_id)
  {
    if(Auth::user()->role_id == 1)
    {
      $attendance = Attendance::where('id',$attendance_id)->with(['attendance_get_status','attendance_get_subjects','attendance_get_batches','attendance_get_classrooms','attendance_get_teachers'])->get();
    }
    elseif(Auth::user()->role_id == 6)
    {
      $attendance = Attendance::where('id',$attendance_id)->with(['attendance_get_status','attendance_get_subjects','attendance_get_batches','attendance_get_classrooms','attendance_get_teachers'])->get();
      $teacher_id = Attendance::where('id',$attendance_id)->value('teacher_id');
      if(Auth::id() == $teacher_id)
      {
        return $attendance;
      }
      else
      {
        $attendance = '';
        return $attendance;
      }
    }
    elseif(Auth::user()->role_id == 7)
    {
      $student_check = AttendanceStatus::where([['student_id',Auth::id()],['attendance_id',$attendance_id]])->count();
      if($student_check != '0')
      {
        $attendance = Attendance::where('id',$attendance_id)->with(['attendance_get_status','attendance_get_subjects','attendance_get_batches','attendance_get_classrooms','attendance_get_teachers'])->get();
        return $attendance;
      }
      else
      {
        $attendance = '';
        return $attendance;
      }
    }
  }

  public function status($attendance_id)
  {
    if(Auth::user()->role_id == 1)
    {
      $status = AttendanceStatus::where('attendance_id',$attendance_id)->with('attendance_status_get_student')->get();
      return $status;
    }
    elseif(Auth::user()->role_id == 6)
    {
      $attendance = Attendance::where('id',$attendance_id)->first();
      if(Auth::id() == $attendance->teacher_id)
      {
        $status = AttendanceStatus::where('attendance_id',$attendance_id)->with('attendance_status_get_student')->get();
        return $status;
      }
      else
      {
        $status = '';
        return $status;
      }
    }
    elseif(Auth::user()->role_id == 7)
    {
      $student_check = AttendanceStatus::where([['student_id',Auth::id()],['attendance_id',$attendance_id]])->count();
      if($student_check != '0')
      {
        $status = AttendanceStatus::where([['student_id',Auth::id()],['attendance_id',$attendance_id]])->with('attendance_status_get_student')->get();
        return $status;
      }
      else
      {
        $status = '';
        return $status;
      }
    }
  }

  // This function gets the data for the edit page
  public function edit_attendance($attendance_id,$id,$student_id)
  {
    $att_status = AttendanceStatus::findOrFail($id);
    if ($att_status->attendance_id == $attendance_id) {
      if(Auth::user()->isAdmin() || Auth::user()->isPrincipal())
      {
        $attendance_status = AttendanceStatus::findOrFail($id);
        $user_info = User::where('id',$student_id)->pluck('name')->first();
        $status = ['1' => 'Present', '2' => 'Absent', '3'=>'Late'];
        return view('classroom-attendance.edit',compact('attendance_status','attendance_id','student_id','user_info','status'));
      }
      elseif(Auth::user()->isTeacher() && Auth::id() == $att_status->added_by)
      {
        $attendance_status = AttendanceStatus::findOrFail($id);
        $user_info = User::where('id',$student_id)->pluck('name')->first();
        $status = ['1' => 'Present', '2' => 'Absent', '3'=>'Late'];
        return view('classroom-attendance.edit',compact('attendance_status','attendance_id','student_id','user_info','status'));
      }
      else
      {
        return redirect()->back()->with('warning',trans('controller.attendance.edit_error'));
      }
    }
    else abort(404);

  }

  // This function updates the attendance
  public function update(UpdateAttendanceStatusRequest $request, $id)
  {
    $attendance_status = AttendanceStatus::findOrFail($id);
    if((Auth::user()->isTeacher() && Auth::id() == $attendance_status->added_by) || Auth::user()->isAdmin() || Auth::user()->isPrincipal())
    {
      $attendance_status->student_id = $request->student_id;
      $attendance_status->status = $request->status;
      $attendance_status->updated_by = Auth::id();
      $attendance_status->update();
      $attendance_id = $attendance_status->attendance_id;
      return redirect()->route('classroom-attendance.dailyattend',['attendance_id'=>$attendance_id])->with('success',trans('controller.attendance.edit_success'));
    }
  }


}
