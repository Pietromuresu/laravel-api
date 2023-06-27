<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Type;
use Faker\Generator as Faker;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i < 30; $i++){

            $new_project = new Project();
            $new_project->type_id = Type::inRandomOrder()->first()->id;
            $new_project->name = $faker->sentence(3);
            $new_project->slug = Project::generateSlug($new_project->name);
            $new_project->purpose = $faker->sentence(10);
            $new_project->team_members = $faker->sentence(3);
            $new_project->description = $faker->text(1000);

            $new_project->repository = "https://github.com/Pietromuresu/laravel-auth";
            $new_project->project_manager = $faker->name();
            $new_project->save();

        }
    }
}
