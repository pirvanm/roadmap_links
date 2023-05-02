<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Tag;
use App\Models\Node;
use App\Models\Roadmap;
use App\Models\RoadmapNode;
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
             'description' => 'Learning about PHP from the very basic to the very advanced.',
             'status' => 1,
         ]);

         $roadmap->tags()->attach([$tag->id]);

         // main node, as the self
        $roadmap->mainNode()->create([
            'name' => $roadmap->name,
        ]);

        $roadMapNode = Node::factory()->create([
            'name' => 'Variables',
            'description' => 'Variables are very important and you need to know them',
            'status' => 1,
            'parent_id' => $roadmap->id,
        ]);

        $roadMapNode = Node::factory()->create([
            'name' => 'Functions',
            'description' => 'Functions are like water, they are the flow',
            'status' => 1,
            'parent_id' => $roadmap->id,
        ]);

        $roadMapNode = Node::factory()->create([
            'name' => 'Objects',
            'description' => 'Objects are like real life objects',
            'status' => 1,
            'parent_id' => $roadmap->id,
        ]);
    }
}
