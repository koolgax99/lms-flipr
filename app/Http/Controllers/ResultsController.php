<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\OnlineExamResults;
use App\OnlineExamAnswers;
use App\Http\Requests\StoreResultsRequest;
use App\Http\Requests\UpdateResultsRequest;
use App\OnlineExamsQuestions;
class ResultsController extends Controller
{
  public function index()
  {
    if(Auth::user()->isAdmin() || Auth::user()->isPrincipal() || Auth::user()->isTeacher())
    {
      $results = OnlineExamResults::all()->load('user');
      return view('results.index', compact('results'));
    }
    elseif (Auth::user()->isStudent())
    {
      $results = OnlineExamResults::where('student_id', '=', Auth::id())->get();
      return view('results.index', compact('results'));
    }
    else
    {
      return redirect()->back()->with('errors',trans('controller.results.view_error'));
    }
  }

  public function show($id)
  {
    $student_id = OnlineExamResults::where('id',$id)->pluck('student_id')->first();
    $exam_id = OnlineExamResults::where('id',$id)->pluck('online_exam_id')->first();
    $questions = OnlineExamsQuestions::where('online_exam_id',$exam_id)->pluck('question_id');
    $count_questions = $questions->count();
    if(Auth::user()->isAdmin() || Auth::user()->isPrincipal() || Auth::user()->isTeacher())
    {
      $test = OnlineExamResults::find($id)->load('user');
      return view('results.show', compact('test','count_questions'));
    }
    elseif (Auth::user()->isStudent() && Auth::id() == $student_id)
    {
      $test = OnlineExamResults::find($id)->load('user');
      return view('results.show', compact('test','count_questions'));
    }
    else
    {
      return redirect()->back()->with('errors',trans('controller.results.view_error'));
    }
  }
}
