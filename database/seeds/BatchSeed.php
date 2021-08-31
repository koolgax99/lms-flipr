<?php

use Illuminate\Database\Seeder;
use App\Batches;
class BatchSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Batches::create([
        'title'=>'Batch - 1 2019A',
        'description'=>'Batch - 1 Section-A Batch-2019',
        'classroom_id'=>1,
      ]);

      Batches::create([
        'title'=>'Batch - 2 2019A',
        'description'=>'Batch - 2 Section-A Batch-2019',
        'classroom_id'=>1,
      ]);

      Batches::create([
        'title'=>'Batch - 3 2019A',
        'description'=>'Batch - 3 Section-A Batch-2019',
        'classroom_id'=>1,
      ]);
    }
}
