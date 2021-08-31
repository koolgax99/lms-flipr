<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      Model::unguard();
      DB::statement('SET FOREIGN_KEY_CHECKS=0;');
      $this->call(RoleSeed::class);
      $this->call(SubjectSeed::class);
      $this->call(DepartmentSeed::class);
      $this->call(ClassroomSeed::class);
      $this->call(BatchSeed::class);
      $this->call(UserSeed::class);
      $this->call(ClassroomTeacherSeed::class);
      $this->call(BatchTeacherSeed::class);
      DB::statement('SET FOREIGN_KEY_CHECKS=1;');
      Model::reguard();
    }
}
