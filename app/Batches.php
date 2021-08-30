<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Batches extends Model
{
  protected $table = 'batches';
  protected $fillable = ['title','description','classroom_id','visibility'];
}
