<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Project::create([
            'title' => 'Test Project',
            'description' => '<div>This is the project description</div><ul><li>Clearing and Grubbing, Topsoil Stripping and Foundation Treatment</li><li>Drill and Blast, including blasting the trench alignment</li></ul>',
            'status' => 'draft',
            'image' => 'naykel-400-001.png',
            'published_at' => null,
            'project_value' => '1980000',
        ])->additionalImages()
            ->createMany([
                [
                    'image' => 'naykel-400-002.png',
                ],
                [
                    'image' => 'naykel-400-003.png',
                ],
                [
                    'image' => 'naykel-400-004.png',
                ]
            ]);

        \App\Models\Project::create([
            'title' => 'Iron Bridge Magnetite Project - Raw Water Pipeline',
            'description' => '<div>This is the project description</div><ul><li>Clearing and Grubbing, Topsoil Stripping and Foundation Treatment</li><li>Drill and Blast, including blasting the trench alignment</li></ul>',
            'status' => 'published',
            'image' => 'naykel-400-001.png',
            'published_at' => Carbon::createFromDate(2022, 5, 9),
            'project_value' => '12000000',
        ])->additionalImages()
            ->createMany([
                [
                    'image' => 'naykel-400-002.png',
                ]
            ]);

        \App\Models\Project::factory(5)->create();
    }
}
