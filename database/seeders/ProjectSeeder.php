<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $project_list = ['Project 1','Project 2','Project 3','Project 4','Project 5','Project 6','Project 7','Project 8','Project 9'];

        
        foreach($project_list as $value)
        {
            $project = new Project();
            $project->project_name = $value;
            $project->save();
        }
    }
}
