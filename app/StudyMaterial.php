<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudyMaterial extends Model
{
  protected $table = 'study_material';
  protected $fillable = ['title','description','classroom_id','batch_id','subject_id','teacher_id','attachment','online_url'];

  public function materials_get_classrooms()
  {
    return $this->belongsTo('App\Classrooms','classroom_id');
  }

  public function materials_get_teachers()
  {
    return $this->belongsTo('App\User','teacher_id');
  }

  public function materials_get_batches()
  {
    return $this->belongsTo('App\Batches','batch_id');
  }

  public function materials_get_subjects()
  {
    return $this->belongsTo('App\Subjects','subject_id');
  }
}
