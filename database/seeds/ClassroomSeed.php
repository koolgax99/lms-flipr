<?php

use Illuminate\Database\Seeder;
use App\Classrooms;
class ClassroomSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Classrooms::create([
        'title'=>'2019 - A',
        'description'=>'Section-A Batch-2019',
        'department_id'=>1,
        'class_teacher_id'=>3,
        'start_date'=>'2020-07-18',
        'end_date'=>'2021-06-12',
      ]);
    }
}
