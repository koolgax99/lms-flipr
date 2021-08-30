<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Batches;
use App\Classrooms;
class BatchesController extends Controller
{
  public function index()
  {
    $batches = Batches::all();
    return $batches;
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
