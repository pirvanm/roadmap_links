<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use Inertia\Inertia;
use App\Models\Roadmap;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoadmapStoreRequest;
use App\Http\Requests\RoadmapUpdateRequest;

class RoadmapsController extends Controller
{
    public function index()
    {
        $roadmaps = Roadmap::with('tags')->with(['mainNode' => function ($q) {
            $q->withCount('nodes');
        }])->get();

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
            'status' => $request->validated('status'),
        ]);

        $roadmap->tags()->sync($request->validated('tags'));

        $roadmap->mainNode()->create([
            'name' => $request->validated('name'),
            'status' => 1,
        ]);

        return redirect()->route('roadmaps.index')->with('success','The roadmap has been saved successfully.');

    }

    
    public function edit(Roadmap $roadmap)
    {
        $tags = Tag::active()->get();

        $roadmap->load('tags');

        return Inertia::render('Admin/Roadmaps/Create')->with([
            'tags' => $tags,
            'roadmap' => $roadmap,
        ]);
    }

    public function update(RoadmapUpdateRequest $request, Roadmap $roadmap)
    {
        $validated = $request->validated();

        $roadmap->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'status' => $validated['status'],
        ]);

        $roadmap->tags()->syncWithoutDetaching($request->validated('tags'));

        return redirect()->route('roadmaps.index')->with('success','The roadmap has been updated successfully.');
    }

    public function destroy(Roadmap $roadmap)
    {
        $roadmap->update(['status' => 0]);
        $roadmap->delete();

        return redirect()->route('roadmaps.index')->with('success','The roadmap has been deleted successfully.');
    }
    
}
