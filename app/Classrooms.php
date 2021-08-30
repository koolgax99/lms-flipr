<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classrooms extends Model
{
  protected $table = 'classrooms';
  protected $fillable = ['title','description','department_id','class_teacher_id','start_date','end_date']; 
}
