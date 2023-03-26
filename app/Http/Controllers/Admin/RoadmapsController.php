<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoadmapStoreRequest;
use App\Models\Roadmap;

class RoadmapsController extends Controller
{
    public function index()
    {
        $roadmaps = Roadmap::with('tag')->with('mainNode')->get();


        return Inertia::render('Admin/Roadmaps/Index')->with(['roadmaps' => $roadmaps]);
    }

    public function create()
    {
        $tags = Tag::active()->get();

        return Inertia::render('Admin/Roadmaps/Create')->with(['tags' => $tags]);
    }

    public function store(RoadmapStoreRequest $request)
    {
        $roadmap = Roadmap::create([
            'name' => $request->validated('name'),
            'description' => $request->validated('description'),
            'tag_id' => $request->validated('tag')['id'],
            'status' => $request->validated('status'),
        ]);

        $roadmap->mainNode()->create([
            'name' => $request->validated('name'),
        ]);

        return redirect()->route('roadmaps.index')->with('success','The roadmap has been saved successfully.');

    }
}
