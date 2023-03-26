<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\RoadmapNode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoadmapNodeStoreRequest;

class RoadmapNodesController extends Controller
{
    public function index(RoadmapNode $node)
    {
        $nodes = $node->nodes()->get();

        return Inertia::render('Admin/Nodes/Index')->with(['nodes' => $nodes, 'node' => $node]);
    }

    public function create(RoadmapNode $node)
    {
        return Inertia::render('Admin/Nodes/Create')->with(['node' => $node]);
    }

    public function store(RoadmapNodeStoreRequest $request)
    {
        $node = RoadmapNode::findOrFail($request->validated('parent')['id']);

        $node->nodes()->create([
            'name' => $request->validated('name'),
            'status' => $request->validated('status') ?? 0,
        ]);

        return redirect()->to(route('roadmaps.nodes.index', ['node' => $node->id]))->with('success','The roadmap has been saved successfully.');

    }
}
