<?php

use Illuminate\Database\Seeder;
use App\Subjects;
class SubjectSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Subjects::create([
        'title'=>'Python'
      ]);
      Subjects::create([
        'title'=>'Digital Design'
      ]);
      Subjects::create([
        'title'=>'Machine Learning'
      ]);
      Subjects::create([
        'title'=>'Networking'
      ]);
      Subjects::create([
        'title'=>'Python Lab'
      ]);
      Subjects::create([
        'title'=>'DD Lab'
      ]);
      Subjects::create([
        'title'=>'ML Lab'
      ]);
    }
}
