<?php

namespace App\Http\Controllers;

use App\Questions_Options;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateQuestions_OptionsRequest;

class Questions_OptionsController extends Controller
{
    public function index()
    {
      $questions_options = Questions_Options::all();
      return $questions_options;
    }
    
      
    
      public function store(Request $request)
      {
  
        $questions_options = new Questions_Options;
        $questions_options->question_id = $request->question_id;
        $questions_options->correct = $request->correct;
        $questions_options->option = $request->option;
        $questions_options->save();
      }
    
      public function edit($id)
      {
        $questions_options = Questions_Options::findOrFail($id);
        return $questions_options;
      }
    
      public function update(Request $request,$id)
      {
        $questions_options = Questions_Options::findOrFail($id);
        $questions_options->question_id = $request->question_id;
        $questions_options->correct = $request->correct;
        $questions_options->option = $request->option;;
        $questions_options->update();
      }

}
