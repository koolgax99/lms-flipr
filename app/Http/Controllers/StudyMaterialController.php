<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StudyMaterial;
use Auth;
class StudyMaterialController extends Controller
{
  public function index()
  {
    if(Auth::user()->role_id == 1)
    {
      $materials = StudyMaterial::with(['materials_get_teachers','materials_get_subjects','materials_get_classrooms','materials_get_batches'])->get();
    }
    elseif(Auth::user()->role_id == 6)
    {
      $materials = StudyMaterial::where('teacher_id',Auth::id())->with(['materials_get_teachers','materials_get_subjects','materials_get_classrooms','materials_get_batches'])->get();
    }
    elseif(Auth::user()->role_id == 7)
    {
      $materials = StudyMaterial::where('classroom_id',Auth::user()->classroom_id)->orWhere('batch_id',Auth::user()->batch_id)->with(['materials_get_teachers','materials_get_subjects','materials_get_classrooms','materials_get_batches'])->get();
    }
    else
    {
      $materials = '';
    }
    return $materials;
  }
  public function store(Request $request)
  {
    $materials = new StudyMaterial;
    $materials->title = $request->title;
    $materials->description = $request->description;
    $materials->classroom_id = $request->classroom_id;
    $materials->batch_id = $request->batch_id;
    $materials->subject_id = $request->subject_id;
    $materials->teacher_id = Auth::id();
    $materials->online_url = $request->online_url;
    $materials->save();
  }

  public function edit($id)
  {
    if(Auth::user()->role_id == 1)
    {
      $materials = StudyMaterial::findOrFail($id);
      return $materials;
    }
    elseif(Auth::user()->role_id == 6)
    {
      $materials = StudyMaterial::where('id',$id)->first();
      if(Auth::id() == $materials->teacher_id)
      {
        return $materials;
      }
      else
      {
        $materials = '';
        return $materials;
      }
    }
    else
    {
      $materials = '';
      return $materials;
    }
  }

  public function update(Request $request,$id)
  {
    $materials = StudyMaterial::findOrFail($id);
    $materials->title = $request->title;
    $materials->description = $request->description;
    $materials->classroom_id = $request->classroom_id;
    $materials->batch_id = $request->batch_id;
    $materials->subject_id = $request->subject_id;
    $materials->teacher_id = Auth::id();
    $materials->online_url = $request->online_url;
    $materials->update();
  }
}
