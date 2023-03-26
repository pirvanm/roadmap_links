<?php

namespace App\Http\Controllers;

use App\Models\Roadmap;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $roadMap = Roadmap::with('nodes')->first();

        return Inertia::render('Welcome', [
            'roadMap' => $roadMap,
        ]);
    }
}
