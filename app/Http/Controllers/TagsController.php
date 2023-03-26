<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TagsController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\TagRequest  $tagRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TagRequest $tagRequest) : \Illuminate\Http\RedirectResponse
    {
        /** @var array<string> $data */
        $data = $tagRequest->validated();

        Tag::create($data);

        return Redirect::route('links.index');
    }
}
