<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Requests\TagRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class TagsController extends Controller
{
    public function index()
    {
        $tags = Tag::active()->get();

        return Inertia::render('Admin/Tags/Index')->with(['tags' => $tags]);
    }

    public function create()
    {
        return Inertia::render('Admin/Tags/Create');
    }

    public function store(TagRequest $request)
    {
        $tag = Tag::create($request->validated());

        return redirect()->route('tags.index')->with('success','The tag has been saved successfully.');
    }
}
