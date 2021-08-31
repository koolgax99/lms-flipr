<?php

namespace App\Http\Controllers;

use App\Questions;
use App\QuestionsOptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionsController extends Controller
{
    public function index()
  {
    $questions = Questions::all();
    return $questions;
  }



    public function store(Request $request)
    {

      $questions = new Questions;
      $questions->title = $request->title;
      $questions->question_text = $request->question_text;
      $questions->code_snippet = $request->code_snippet;
      $questions->answer_explanation = $request->answer_explanation;
      $questions->more_info_link = $request->more_info_link;
      $questions->teacher_id = Auth::id();
      $questions->subject_id = $request->subject_id;
      $questions->save();
    }

    public function edit($id)
    {
      $questions = Questions::findOrFail($id);
      return $questions;
    }

    public function update(Request $request,$id)
    {
      $questions = Questions::findOrFail($id);
      $questions->title = $request->title;
      $questions->question_text = $request->question_text;
      $questions->code_snippet = $request->code_snippet;
      $questions->answer_explanation = $request->answer_explanation;
      $questions->more_info_link = $request->more_info_link;
      $questions->update();
    }
}
