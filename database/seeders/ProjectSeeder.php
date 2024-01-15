<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    public function run(Faker $faker)
    {

        $types = Type::all();
        $ids = $types->pluck('id');

        
        $technologies = Technology::all();
        $tech_ids = $technologies->pluck('id');

        for ($i = 0; $i < 20; $i++) {
            $new_project = new Project();
            $new_project->project_name = $faker->sentence();
            $new_project->description = $faker->sentence(20);
            $new_project->github_link = 'https://github.com/CarloVeronese/'. Str::slug($new_project->project_name);
            $new_project->project_status = $faker->randomElement(['to start', 'in progress', 'completed']);
            $new_project->type_id = $faker->optional()->randomElement($ids);
            $new_project->save();
            $new_project->technologies()->attach($faker->randomElements($tech_ids, null));
        }
    }
}
