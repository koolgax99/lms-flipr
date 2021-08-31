<?php

use Illuminate\Database\Seeder;
use App\Role;
class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Role::create([
        'id' => 1,
        'title'=>'Super Admin',
        'description'=> 'Super Admin',
      ]);
      Role::create([
        'id' => 2,
        'title'=>'Director',
        'description'=> 'Director',
      ]);
      Role::create([
        'id' => 3,
        'title'=>'Registrar',
        'description'=> 'Registrar',
      ]);
      Role::create([
        'id' => 4,
        'title'=>'Accountant',
        'description'=> 'Accountant',
      ]);
      Role::create([
        'id' => 5,
        'title'=>'HOD',
        'description'=> 'Head of Department',
      ]);
      Role::create([
        'id' => 6,
        'title'=>'Teacher',
        'description'=> 'teacher',
      ]);
      Role::create([
        'id' => 7,
        'title'=>'Student',
        'description'=> 'Student',
      ]);
    }
}
