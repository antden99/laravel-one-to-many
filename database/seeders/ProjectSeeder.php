<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker; //attento ad aggiungere sempre faker se devi utilizzarlo
class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 10; $i++) {
            $project = new Project();
            $project->name = $faker->word();
            $project->cover_image = $faker->imageUrl(300,200);
            $project->description = $faker->text(255);
            $project->start_date = $faker->date();
            $project->end_date = $faker->date(); 
            $project->save();
        }
    }
}
