<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return $users;
    }

    public function show(Request $request, $id)
    {
        $user = User::find($id);

        return response()->json(
            [
                'status' => 'success',
                'user' => $user->toArray()
            ], 200);
    }

    public function getTeachers()
    {
      $teachers = User::where('role_id',6)->get();
      return $teachers;
    }

    public function getStudents()
    {
      $students = User::where('role_id',7)->get();
      return $students;
    }

    public function store(Request $request)
    {
      $user = new User;
      $user->name = $request->name;
      $user->email = $request->email;
      $user->password = bcrypt($request->password);
      $user->role_id = $request->role_id;
      $user->roll_no = $request->roll_no;
      if(!empty($request->department_id))
      {
        $user->department_id = $request->department_id;
      }
      if((!empty($request->classroom_id)) && (!empty($request->department_id)))
      {
        $user->classroom_id = $request->classroom_id;
      }
      if(!empty($request->classroom_id) && !empty($request->batch_id))
      {
        $user->batch_id = $request->batch_id;
      }
      $user->save();
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return $user;
    }

    public function update(Request $request,$id)
    {
      $user = User::findOrFail($id);
      $user->name = $request->name;
      $user->email = $request->email;
      $user->role_id = $request->role_id;
      $user->update();
    }

    public function view($id)
    {
      $user = User::findOrFail($id);
      return $user;
    }
}
