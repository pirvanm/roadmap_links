<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TagStoreRequest;
use App\Http\Requests\TagUpdateRequest;
use Illuminate\Support\Facades\Redirect;

class TagsController extends Controller
{
    public function index()
    {
        $tags = Tag::active()->get();

        return Inertia::render('Admin/Tags/Index')->with(['tags' => $tags]);
    }

    public function store(TagStoreRequest $request)
    {
        $tag = Tag::create($request->validated());

        return redirect()->route('tags.index')->with('success','The tag has been saved successfully.');
    }

    public function update(TagUpdateRequest $request, Tag $tag)
    {
        $tag->update($request->validated());

        return redirect()->route('tags.index')->with('success','The tag has been saved successfully.');
    }
}
