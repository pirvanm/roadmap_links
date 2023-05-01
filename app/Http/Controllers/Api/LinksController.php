<?php

namespace App\Http\Controllers\Api;

use App\Models\Link;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LinksController extends Controller
{
    public function getLink(Link $link)
    {
        return response()->jsoN($link);
    }
}
