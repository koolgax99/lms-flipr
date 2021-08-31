<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Holidays;
use App\Users;
use Auth;


class HolidaysController extends Controller
{
    public function index()
  {
    $holidays = Holidays::all();
    return $holidays;
  }

	  public function store(Request $request)
	  {
	    $holidays = new Holidays;
	    $holidays->title = $request->title;
	    $holidays->description = $request->description;
	    $holidays->date = $request->date;
	    $holidays->save();
	  }

	  public function edit($id)
	  {
	    $holidays = Holidays::findOrFail($id);
	    return $holidays;
	  }

	  public function update(Request $request,$id)
	  {
	    $holidays = Holidays::findOrFail($id);
	    $holidays->title = $request->title;
	    $holidays->description = $request->description;
	    $holidays->date = $request->date;
	    $holidays->update();
	  }
}
