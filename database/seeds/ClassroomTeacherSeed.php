<?php

use Illuminate\Database\Seeder;
use App\Classroom_Teachers;
class ClassroomTeacherSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Classroom_Teachers::create([
          'classroom_id'=>1,
          'teacher_id'=>2,
          'subject_id'=>1,
        ]);
        Classroom_Teachers::create([
          'classroom_id'=>1,
          'teacher_id'=>3,
          'subject_id'=>2,
        ]);
        Classroom_Teachers::create([
          'classroom_id'=>1,
          'teacher_id'=>4,
          'subject_id'=>3,
        ]);
        Classroom_Teachers::create([
          'classroom_id'=>1,
          'teacher_id'=>5,
          'subject_id'=>4,
        ]);
    }
}
