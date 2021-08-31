<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    protected $fillable = ['title','question_text', 'code_snippet', 'answer_explanation','more_info_link', 'subject_id', 'teacher_id'];

}
