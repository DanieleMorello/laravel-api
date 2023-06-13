<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 10; $i++) {
            $project = new Project();
            $project->title = $faker->sentence(4);
            $project->slug = Str::slug($project->title, '-');
            $project->description = $faker->text();
            $project->user_id = 1;
            $project->project_image = 'placeholders/' . $faker->image('storage/app/public/placeholders/', fullPath: false, category: 'Projects', format: 'jpg', word: $project->title);
            $project->project_live_url = $faker->url();
            $project->project_source_code = $faker->url();
            $project->save();
        }
    }
}
