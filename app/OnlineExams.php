<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class OnlineExams extends Model
{
  protected $table ="online_exams";
  protected $fillable = ['title','description','classroom_id','teacher_id','subject_id', 'published','added_by','updated_by'];

  public function result_exam_title()
  {
    return $this->hasMany('App\OnlineExamResults','online_exam_id');
  }
}
