<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('task_statuses')->insert([
            ['name'=>'To Do','created_at'=> now(),'updated_at'=> now()],
            ['name'=>'In Progress','created_at'=> now(),'updated_at'=> now()],
            ['name'=>'In Development','created_at'=> now(),'updated_at'=> now()],
            ['name'=>'Review','created_at'=> now(),'updated_at'=> now()],
            ['name'=>'Done','created_at'=> now(),'updated_at'=> now()],
        ]);
    }
}
