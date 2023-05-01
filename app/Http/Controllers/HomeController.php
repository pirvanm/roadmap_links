<?php

namespace App\Http\Controllers;

use App\Models\Roadmap;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $roadmaps = Roadmap::active()->with('tag')->get();

        return inertia('Welcome')->with(['roadmaps' => $roadmaps]);
    }
}
