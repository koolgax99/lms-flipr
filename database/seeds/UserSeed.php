<?php

use Illuminate\Database\Seeder;
use App\User;
class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      User::create([
        'name' => 'Super Admin',
        'email' => 'admin@test.com',
        'password' => Hash::make('password'),
        'role_id' => 1,
      ]);
      User::create([
        'name'=>'Uma Seshadri',
        'email'=>'uma.s@test.com',
        'password'=>Hash::make('password'),
        'role_id'=>6,
      ]);
      User::create([
        'name'=>'Channappa Akki',
        'email'=>'akki.c@test.com',
        'password'=>Hash::make('password'),
        'role_id'=>6,
      ]);
      User::create([
        'name'=>'Pavan Kumar',
        'email'=>'pavan@test.com',
        'password'=>Hash::make('password'),
        'role_id'=>6,
      ]);
      User::create([
        'name'=>'Rajendra Hegadi',
        'email'=>'rajendra.h@test.com',
        'password'=>Hash::make('password'),
        'role_id'=>6,
      ]);
      User::create([
                  'name' => 'Nihar',
                  'email' => '19acs001@test.com',
                  'password' => Hash::make('password'),
                  'role_id'=> 7,
                  'classroom_id'=>1,
                  'batch_id'=>1,
                  'department_id'=>1,
              ]);

      User::create([
                  'name' => 'Anany',
                  'email' => '19acs002@test.com',
                  'password' => Hash::make('password'),
                  'role_id'=> 7,
                  'classroom_id'=>1,
                  'batch_id'=>1,
                  'department_id'=>1,
              ]);

      User::create([
                  'name' => 'Satyam',
                  'email' => '19acs003@test.com',
                  'password' => Hash::make('password'),
                  'role_id'=> 7,
                  'classroom_id'=>1,
                  'batch_id'=>1,
                  'department_id'=>1,
              ]);

      User::create([
                  'name' => 'Param',
                  'email' => '19acs004@test.com',
                  'password' => Hash::make('password'),
                  'role_id'=> 7,
                  'classroom_id'=>1,
                  'batch_id'=>1,
                  'department_id'=>1,
              ]);

      User::create([
                  'name' => 'Priyam',
                  'email' => '19acs005@test.com',
                  'password' => Hash::make('password'),
                  'role_id'=> 7,
                  'classroom_id'=>1,
                  'batch_id'=>1,
                  'department_id'=>1,
              ]);

      User::create([
                  'name' => 'Uddesh',
                  'email' => '19acs006@test.com',
                  'password' => Hash::make('password'),
                  'role_id'=> 7,
                  'classroom_id'=>1,
                  'batch_id'=>1,
                  'department_id'=>1,
              ]);

      User::create([
                  'name' => 'Sanchit',
                  'email' => '19acs007@test.com',
                  'password' => Hash::make('password'),
                  'role_id'=> 7,
                  'classroom_id'=>1,
                  'batch_id'=>1,
                  'department_id'=>1,
              ]);

      User::create([
                  'name' => 'Gourab',
                  'email' => '19acs008@test.com',
                  'password' => Hash::make('password'),
                  'role_id'=> 7,
                  'classroom_id'=>1,
                  'batch_id'=>1,
                  'department_id'=>1,
              ]);

      User::create([
                  'name' => 'Ayaan',
                  'email' => '19acs009@test.com',
                  'password' => Hash::make('password'),
                  'role_id'=> 7,
                  'classroom_id'=>1,
                  'batch_id'=>1,
                  'department_id'=>1,
              ]);

      User::create([
                  'name' => 'Akash',
                  'email' => '19acs010@test.com',
                  'password' => Hash::make('password'),
                  'role_id'=> 7,
                  'classroom_id'=>1,
                  'batch_id'=>1,
                  'department_id'=>1,
              ]);

      User::create([
                  'name' => 'Mayank',
                  'email' => '19acs011@test.com',
                  'password' => Hash::make('password'),
                  'role_id'=> 7,
                  'classroom_id'=>1,
                  'batch_id'=>2,
                  'department_id'=>1,
              ]);
      User::create([
                  'name' => 'Jaynit',
                  'email' => '19acs012@test.com',
                  'password' => Hash::make('password'),
                  'role_id'=> 7,
                  'classroom_id'=>1,
                  'batch_id'=>2,
                  'department_id'=>1,
              ]);
      User::create([
                  'name' => 'Shresth',
                  'email' => '19acs013@test.com',
                  'password' => Hash::make('password'),
                  'role_id'=> 7,
                  'classroom_id'=>1,
                  'batch_id'=>2,
                  'department_id'=>1,
              ]);
      User::create([
                  'name' => 'Pavan',
                  'email' => '19acs014@test.com',
                  'password' => Hash::make('password'),
                  'role_id'=> 7,
                  'classroom_id'=>1,
                  'batch_id'=>2,
                  'department_id'=>1,
              ]);
      User::create([
                  'name' => 'Abdul',
                  'email' => '19acs015@test.com',
                  'password' => Hash::make('password'),
                  'role_id'=> 7,
                  'classroom_id'=>1,
                  'batch_id'=>2,
                  'department_id'=>1,
              ]);
      User::create([
                  'name' => 'Rahul',
                  'email' => '19acs016@test.com',
                  'password' => Hash::make('password'),
                  'role_id'=> 7,
                  'classroom_id'=>1,
                  'batch_id'=>2,
                  'department_id'=>1,
              ]);
      User::create([
                  'name' => 'Michael',
                  'email' => '19acs017@test.com',
                  'password' => Hash::make('password'),
                  'role_id'=> 7,
                  'classroom_id'=>1,
                  'batch_id'=>2,
                  'department_id'=>1,
              ]);
      User::create([
                  'name' => 'Mohan',
                  'email' => '19acs018@test.com',
                  'password' => Hash::make('password'),
                  'role_id'=> 7,
                  'classroom_id'=>1,
                  'batch_id'=>2,
                  'department_id'=>1,
              ]);
      User::create([
                  'name' => 'Abhishek',
                  'email' => '19acs019@test.com',
                  'password' => Hash::make('password'),
                  'role_id'=> 7,
                  'classroom_id'=>1,
                  'batch_id'=>2,
                  'department_id'=>1,
              ]);
      User::create([
                  'name' => 'Rishi',
                  'email' => '19acs020@test.com',
                  'password' => Hash::make('password'),
                  'role_id'=> 7,
                  'classroom_id'=>1,
                  'batch_id'=>2,
                  'department_id'=>1,
              ]);
      User::create([
                  'name' => 'Ram',
                  'email' => '19acs021@test.com',
                  'password' => Hash::make('password'),
                  'role_id'=> 7,
                  'classroom_id'=>1,
                  'batch_id'=>3,
                  'department_id'=>1,
              ]);
      User::create([
                  'name' => 'Sarthak',
                  'email' => '19acs022@test.com',
                  'password' => Hash::make('password'),
                  'role_id'=> 7,
                  'classroom_id'=>1,
                  'batch_id'=>3,
                  'department_id'=>1,
              ]);
      User::create([
                  'name' => 'Karan',
                  'email' => '19acs023@test.com',
                  'password' => Hash::make('password'),
                  'role_id'=> 7,
                  'classroom_id'=>1,
                  'batch_id'=>3,
                  'department_id'=>1,
              ]);
      User::create([
                  'name' => 'Basavaraj',
                  'email' => '19acs024@test.com',
                  'password' => Hash::make('password'),
                  'role_id'=> 7,
                  'classroom_id'=>1,
                  'batch_id'=>3,
                  'department_id'=>1,
              ]);
      User::create([
                  'name' => 'Pranav',
                  'email' => '19acs025@test.com',
                  'password' => Hash::make('password'),
                  'role_id'=> 7,
                  'classroom_id'=>1,
                  'batch_id'=>3,
                  'department_id'=>1,
              ]);
      User::create([
                  'name' => 'Yashwanth',
                  'email' => '19acs026@test.com',
                  'password' => Hash::make('password'),
                  'role_id'=> 7,
                  'classroom_id'=>1,
                  'batch_id'=>3,
                  'department_id'=>1,
              ]);
      User::create([
                  'name' => 'Vivek',
                  'email' => '19acs027@test.com',
                  'password' => Hash::make('password'),
                  'role_id'=> 7,
                  'classroom_id'=>1,
                  'batch_id'=>3,
                  'department_id'=>1,
              ]);
      User::create([
                  'name' => 'Pankaj',
                  'email' => '19acs028@test.com',
                  'password' => Hash::make('password'),
                  'role_id'=> 7,
                  'classroom_id'=>1,
                  'batch_id'=>3,
                  'department_id'=>1,
              ]);
      User::create([
                  'name' => 'Karthik',
                  'email' => '19acs029@test.com',
                  'password' => Hash::make('password'),
                  'role_id'=> 7,
                  'classroom_id'=>1,
                  'batch_id'=>3,
                  'department_id'=>1,
              ]);
      User::create([
                  'name' => 'Virinchi',
                  'email' => '19acs030@test.com',
                  'password' => Hash::make('password'),
                  'role_id'=> 7,
                  'classroom_id'=>1,
                  'batch_id'=>3,
                  'department_id'=>1,
              ]);
    }
}
