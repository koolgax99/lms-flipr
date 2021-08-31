<?php

use Illuminate\Database\Seeder;
use App\Departments;
class DepartmentSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Departments::create([
        'title'=>'Computer Science',
        'description'=>'Computer Science',
        'year_of_establishment'=>'2008',
      ]);
    }
}
