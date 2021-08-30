<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subjects extends Model
{
  protected $table = 'subjects';
  protected $fillable = ['title','description','code','semester','lecture_hours_per_week','tutorial_hours_per_week','practical_hours_per_week','ss_hours_per_week','credits'];
}
