<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Batches extends Model
{
  protected $table = 'batches';
  protected $fillable = ['title','description','classroom_id','visibility'];

  public function batches_get_students()
  {
    return $this->hasMany('App\User','batch_id');
  }

  public function assignments_get_batches()
  {
    return $this->hasMany('App\Assignments','batch_id');
  }
  public function attendance_get_batches()
  {
    return $this->hasMany('App\Attendance','batch_id');
  }
  public function materials_get_batches()
  {
    return $this->hasMany('App\StudyMaterial','batch_id');
  }
}
