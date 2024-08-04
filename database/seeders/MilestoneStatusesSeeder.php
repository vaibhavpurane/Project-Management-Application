<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MilestoneStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('milestone_statuses')->insert([
            [   'name'=>'Active',
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [   'name'=>'Completed',
                'created_at'=> now(),
                'updated_at'=> now()
            ],
        ]);
    }
}
