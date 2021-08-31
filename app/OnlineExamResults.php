<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class OnlineExamResults extends Model
{
  protected $table = "online_exam_results";
  protected $fillable = ['online_exam_id','student_id','result'];

  public function user()
  {
    return $this->belongsTo('App\User', 'student_id')->withTrashed();
  }

  public function result_exam_title()
  {
    return $this->belongsTo('App\OnlineExams', 'online_exam_id')->withTrashed();
  }
}
