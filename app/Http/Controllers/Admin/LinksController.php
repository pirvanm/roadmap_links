<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Link;
use Illuminate\Http\Request;
use App\Http\Requests\LinkRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\LinkUpdateRequest;
use Illuminate\Support\Facades\Redirect;

class LinksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function index(Request $request): \Inertia\Response|\Inertia\ResponseFactory
    {
        $links = Link::with('tags')->get();
        $tags = Tag::get();


        return inertia('Admin/Links/Index', [
            'links' => $links,
            'tags' => $tags,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function listing(Request $request): \Inertia\Response|\Inertia\ResponseFactory
    {
        $links = Link::with('tags')->get();
        $tags = Tag::get();


        return inertia('Links/Index', [
            'links' => $links,
            'tags' => $tags,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\LinkRequest   $linkRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LinkRequest $linkRequest): \Illuminate\Http\RedirectResponse
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

        return back()->with('success', 'The link has been saved successfully!');
    }

    public function update(LinkUpdateRequest $linkRequest, Link $link): \Illuminate\Http\RedirectResponse
    {
        $validated = $linkRequest->validated();

        $link->update([
            'title' => $validated['title'],
            'link' => $validated['link'],
            'short_description' => $validated['short_description'],
            'type' => $validated['type'],
            'difficulty' => $validated['difficulty'],
            'status' => $validated['status'],
        ]);

        $link->tags()->syncWithoutDetaching($validated['tags']);

        return back()->with('success', 'The link has been updated successfully!');
    }

    public function destroy(Link $link)
    {
        $link->update(['status' => 0]);
        $link->forceDelete();

        return redirect()->to(route('links.index'))->with('success', 'The link has been deleted successfully.');
    }
}
