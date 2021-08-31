<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departments extends Model
{
  protected $table = 'departments';
  protected $fillable = ['title','description','year_of_establishment'];

  public function department_teachers_get_departments()
  {
    return $this->hasMany('App\Department_Teachers','department_id');
  }
}
