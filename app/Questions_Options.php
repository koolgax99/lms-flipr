<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Questions_Options extends Model
{
    protected $fillable = ['question_id', 'option', 'correct'];

}
