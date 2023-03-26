<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Roadmap;
use App\Models\RoadmapNode;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

         \App\Models\User::factory()->create([
             'name' => 'Test User',
             'email' => 'test@test.com',
         ]);

         // create one tag
         $tag = Tag::factory()->create([
             'tag' => 'PHP',
             'color' => 'blue',
             'status' => 1,
         ]);

         $roadmap = Roadmap::factory()->create([
             'name' => 'PHP101',
             'status' => 1,
             'tag_id' => $tag->id,
         ]);

         // main node, as the self
        $roadmap->mainNode()->create([
            'name' => $roadmap->name,
        ]);

        $roadMapNode = RoadmapNode::factory()->create([
            'name' => 'Variables',
            'status' => 1,
            'parent_id' => $roadmap->id,
        ]);

        $roadMapNode = RoadmapNode::factory()->create([
            'name' => 'Functions',
            'status' => 1,
            'parent_id' => $roadmap->id,
        ]);

        $roadMapNode = RoadmapNode::factory()->create([
            'name' => 'Objects',
            'status' => 1,
            'parent_id' => $roadmap->id,
        ]);
    }
}
