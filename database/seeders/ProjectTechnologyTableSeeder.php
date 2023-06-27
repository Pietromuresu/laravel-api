<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Technology;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectTechnologyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    for ($i = 0; $i < 20; $i++) {
            $technology_id = Technology::inRandomOrder()->first()->id;

            $project = Project::inRandomOrder()->first();

            $project->technologies()->attach($technology_id);

        }
    }
}
