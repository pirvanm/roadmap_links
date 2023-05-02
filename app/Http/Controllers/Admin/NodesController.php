<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Link;
use App\Models\Node;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Requests\LinkRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\NodeStoreRequest;
use App\Http\Requests\NodeUpdateRequest;

class NodesController extends Controller
{
    public function index(Node $node)
    {
        $nodes = $node->nodes()
                    ->withCount('nodes')
                    ->withCount('links')
                    ->get();
        
        return Inertia::render('Admin/Nodes/Index')->with(['nodes' => $nodes, 'parentNode' => $node]);
    }

    public function create(Node $node)
    {
        return Inertia::render('Admin/Nodes/Create')->with(['parentNode' => $node]);
    }

    public function edit(Node $node, Node $childNode)
    {
        $childNode->load('links.tags');
        $tags = Tag::get();

        return Inertia::render('Admin/Nodes/Edit')->with([
            'parentNode' => $node,
            'childNode' => $childNode,
            'tags' => $tags,
        ]);
    }

    public function store(NodeStoreRequest $request)
    {
        $node = Node::findOrFail($request->validated('parent')['id']);

        $node->nodes()->create([
            'name' => $request->validated('name'),
            'description' => $request->validated('description'),
            'status' => $request->validated('status') ?? 0,
        ]);

        return redirect()->to(route('roadmaps.nodes.index', ['node' => $node->id]))->with('success','The roadmap has been saved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\LinkRequest   $linkRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeLink(LinkRequest $linkRequest, Node $node) :  \Illuminate\Http\RedirectResponse
    {
        $validated = $linkRequest->validated();

        $link = Link::create([
            'title' => $validated['title'],
            'link' => $validated['link'],
            'short_description' => $validated['short_description'],
            'type' => $validated['type'],
            'difficulty' => $validated['difficulty'],
            'status' => $validated['status'],
        ]);

        $link->tags()->sync($validated['tags']);

        $link->nodes()->sync([$node->id]);

        return back()->with('success','The link has been saved successfully!');

    }

    public function deleteLink(Node $node, Link $link)
    {
        $node->links()->detach([$link->id]);

        return redirect()->to(route('roadmaps.nodes.edit', ['node' => $node->parent->id, 'childNode' => $node->id]))->with('success','The link has been deleted removed.');
    }

    public function update(NodeUpdateRequest $request, Node $node)
    {
        $node->load('parent');

        $node->update([
            'name' => $request->validated('name'),
            'description' => $request->validated('description'),
            'status' => $request->validated('status') ?? 0,
        ]);

        return redirect()->to(route('roadmaps.nodes.index', ['node' => $node->parent->id, 'childNode' => $node->id]))->with('success','The roadmap has been saved successfully.');
    }

    public function destroy(Node $node)
    {
        $node->update(['status' => 0]);
        $node->delete();

        return redirect()->to(route('roadmaps.nodes.index', ['node' => $node->parent->id]))->with('success','The node has been deleted successfully.');
    }
}
