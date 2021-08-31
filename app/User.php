<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','roll_no','role_id','classroom_id','batch_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function routeNotificationForMail($notification)
    {
        // Return email address only...
        return $this->email_address;

        // Return name and email address...
        return [$this->email_address => $this->name];
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function department_teachers_get_teachers()
    {
      return $this->hasMany('App\Department_Teachers','teacher_id');
    }

    public function classroom_teachers_get_teachers()
    {
      return $this->hasMany('App\Classroom_Teachers','teacher_id');
    }

    public function batch_teachers_get_teachers()
    {
      return $this->hasMany('App\Batch_Teachers','teacher_id');
    }

    public function classrooms_get_students()
    {
      return $this->belongsTo('App\Classrooms','classroom_id');
    }
    public function batches_get_students()
    {
      return $this->belongsTo('App\Batches','batch_id');
    }

    public function assignment_submissions_students()
    {
      return $this->hasMany('App\Assignment_Submissions','student_id');
    }

    public function assignments_get_teachers()
    {
      return $this->hasMany('App\Assignments','teacher_id');
    }
    public function attendance_get_teachers()
    {
      return $this->hasMany('App\Attendance','teacher_id');
    }

    public function attendance_status_get_student()
    {
      return $this->hasMany('App\AttendanceStatus','student_id');
    }

    public function materials_get_teachers()
    {
      return $this->hasMany('App\StudyMaterial','teacher_id');
    }
}
