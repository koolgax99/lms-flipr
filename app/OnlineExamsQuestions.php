<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OnlineExamsQuestions extends Model
{
  protected $table = "online_exams_questions";
  protected $fillable = ['online_exam_id','question_id'];

  public function online_exam_questions()
  {
    return $this->belongsTo('App\Question', 'question_id')->withTrashed();
  }
}
