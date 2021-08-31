<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notices extends Model
{
  protected $table = 'notices';
  protected $fillable = ['title','notice_text','college_wide_notice','department_id','classroom_id','batch_id','attachment'];
}
