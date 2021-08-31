<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departments;
use App\Classrooms;
use App\Teachers;
use App\Batches;
use App\Notices;
use Auth;
class NoticesController extends Controller
{
  public function index()
  {
    if(Auth::user()->role_id == 1)
    {
      $notices = Notices::with(['notices_get_teachers','notices_get_departments','notices_get_classrooms','notices_get_batches'])->get();
    }
    elseif(Auth::user()->role_id == 6)
    {
      $notices = Notices::where('uploaded_by',Auth::id())->with(['notices_get_teachers','notices_get_departments','notices_get_classrooms','notices_get_batches'])->get();
    }
    elseif(Auth::user()->role_id == 7)
    {
      $notices = Notices::where('batch_id',Auth::user()->batch_id)->orWhere('classroom_id',Auth::user()->classroom_id)->with(['notices_get_teachers','notices_get_departments','notices_get_classrooms','notices_get_batches'])->get();
    }
    return $notices;
  }

  

  public function store(Request $request)
  {
    $notices = new Notices;
    $notices->title = $request->title;
    $notices->notice_text = $request->notice_text;
    $notices->teacher_id = Auth::id();
    if($request->notices == '1')
    {
      $notices->college_wide = 1;
    }
    elseif($request->notices == '2' && !empty($request->department_id))
    {
      $notices->department_id = $request->department_id;
    }
    elseif($request->notices == '3' && !empty($request->classroom_id))
    {
      $notices->classroom_id = $request->classroom_id;
    }
    elseif($request->notices == '4' && !empty($request->batch_id) )
    {
      $notices->batch_id = $request->batch_id;
    }
    $notices->save();
  }

  public function edit($id)
  {
    $notices = Notices::findOrFail($id);
    return $notices;
  }

  public function update(Request $request,$id)
  {
    $notices = Notices::findOrFail($id);
    $notices->title = $request->title;
    $notices->notice_text = $request->notice_text;
    $notices->college_wide = $request->college_wide;
    $notices->attachments = $request->attachments;
    $notices->teacher_id = $request->teacher_id;
    $notices->department_id = $request->department_id;
    $notices->classroom_id = $request->classroom_id;
    $notices->batch_id = $request->batch_id;
    $notices->update();
  }

  public function view($id)
  {
    if(Auth::user()->role_id == 1)
    {
      $notices = Notices::with(['notices_get_teachers','notices_get_departments','notices_get_classrooms','notices_get_batches'])->where('id',$id)->get();
    }
    elseif(Auth::user()->role_id == 6)
    {

      $notices = Notices::where('id',$id)->with(['notices_get_teachers','notices_get_departments','notices_get_classrooms','notices_get_batches'])->get();
    }
    elseif(Auth::user()->role_id == 7)
    {
      $notices = Notices::where('id',$id)->with(['notices_get_teachers','notices_get_departments','notices_get_classrooms','notices_get_batches'])->get();
    }
    return $notices;
  }
}
