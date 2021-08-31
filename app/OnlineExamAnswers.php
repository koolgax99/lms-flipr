<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class OnlineExamAnswers extends Model
{
  protected $table = "online_exam_answers";
  protected $fillable = ['online_exam_id','student_id','question_id','option_id','correct'];
}
