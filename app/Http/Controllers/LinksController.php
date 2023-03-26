<?php

namespace App\Http\Controllers;

use App\Http\Requests\LinkRequest;
use App\Models\Link;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class LinksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function index(Request $request) : \Inertia\Response|\Inertia\ResponseFactory
    {
        $filters = $request->all('search', 'tags');

        $links = Link::with('tags')->where('title', 'like', '%'.$filters['search'].'%');

        if (isset($filters['tags']) && is_array($filters['tags'])) {
            foreach ($filters['tags'] as $id) {
                $links->whereHas('tags', function ($q) use ($id) {
                    $q->where('tags.id', $id);
                });
            }
        }

        $tags = Tag::get(['id', 'tag'])->toArray();

        return inertia('Home', ['links' => $links->orderby('created_at', 'desc')->get(), 'tags' => $tags, 'filters' => $filters]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\LinkRequest   $linkRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LinkRequest $linkRequest) :  \Illuminate\Http\RedirectResponse
    {
        /** @var array<string, array<int>> $data */
        $data = $linkRequest->validated();
        $tags = $data['tags'];

        unset($data['tags']);

        $link = Link::create($data);
        $link->tags()->attach($tags);

        return Redirect::route('links.index');
    }
}
