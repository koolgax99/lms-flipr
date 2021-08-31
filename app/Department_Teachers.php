<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department_Teachers extends Model
{
    protected $table = 'department_teachers';
  	protected $fillable = ['department_id','teacher_id'];

    public function department_teachers_get_teachers()
    {
      return $this->belongsTo('App\User','teacher_id');
    }

    public function department_teachers_get_departments()
    {
      return $this->belongsTo('App\Departments','department_id');
    }
}
