<?php

use App\Http\Controllers\Admin\RoadmapNodesController;
use App\Http\Controllers\Admin\RoadmapsController;
use App\Http\Controllers\Admin\TagsController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index']);


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::prefix('roadmaps')->group(function () {
        Route::get('/', [RoadmapsController::class, 'index'])->name('roadmaps.index');
        Route::get('/create', [RoadmapsController::class, 'create'])->name('roadmaps.create');
        Route::post('/', [RoadmapsController::class, 'store'])->name('roadmaps.store');



        Route::get('/nodes/{node}', [RoadmapNodesController::class, 'index'])->name('roadmaps.nodes.index');
        Route::get('/nodes/create/{node}', [RoadmapNodesController::class, 'create'])->name('roadmaps.nodes.create');
        Route::post('/nodes', [RoadmapNodesController::class, 'store'])->name('roadmaps.nodes.store');

    });


    Route::get('/tags', [TagsController::class, 'index'])->name('tags.index');
    Route::get('/tags/create', [TagsController::class, 'create'])->name('tags.create');
    Route::post('/tags', [TagsController::class, 'store'])->name('tags.store');

});
