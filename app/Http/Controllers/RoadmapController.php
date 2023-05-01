<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Roadmap;
use Illuminate\Http\Request;

class RoadmapController extends Controller
{
    public function show(Roadmap $roadmap)
    {
        $roadmap->load('mainNode.nodes.links');

        //dd($roadmap);

        return Inertia::render('Roadmaps/Show', [
            'roadMap' => $roadmap,
        ]);
    }
}
