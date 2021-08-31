<?php

use Illuminate\Database\Seeder;
use App\Batch_Teachers;
class BatchTeacherSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Batch_Teachers::create([
        'batch_id'=>1,
        'teacher_id'=>2,
        'subject_id'=>5,
      ]);
      Batch_Teachers::create([
        'batch_id'=>2,
        'teacher_id'=>2,
        'subject_id'=>5,
      ]);
      Batch_Teachers::create([
        'batch_id'=>3,
        'teacher_id'=>2,
        'subject_id'=>5,
      ]);
      Batch_Teachers::create([
        'batch_id'=>1,
        'teacher_id'=>3,
        'subject_id'=>6,
      ]);
      Batch_Teachers::create([
        'batch_id'=>2,
        'teacher_id'=>3,
        'subject_id'=>6,
      ]);
      Batch_Teachers::create([
        'batch_id'=>3,
        'teacher_id'=>3,
        'subject_id'=>6,
      ]);
      Batch_Teachers::create([
        'batch_id'=>1,
        'teacher_id'=>4,
        'subject_id'=>7,
      ]);
      Batch_Teachers::create([
        'batch_id'=>2,
        'teacher_id'=>4,
        'subject_id'=>7,
      ]);
      Batch_Teachers::create([
        'batch_id'=>3,
        'teacher_id'=>4,
        'subject_id'=>7,
      ]);
    }
}
