<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Role;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
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
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('admin'),
            'role' => 2,
            'role_id' => 1,
        ]);

        User::create([
            'name' => 'Student',
            'email' => 'student@test.com',
            'password' => Hash::make('secret'),
            'role' => 1,
            'role_id'=> 7,
        ]);
    }
}
