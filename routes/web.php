<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\RoadmapController;
use App\Http\Controllers\Admin\TagsController;
use App\Http\Controllers\Admin\LinksController;
use App\Http\Controllers\Admin\NodesController;
use App\Http\Controllers\Admin\RoadmapsController as AdminRoadmapsController;
use App\Http\Controllers\ScraperController;
use App\Http\Controllers\PlacesController;
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

Route::get('/scrape-real-estate-agencies', [ScrapingController::class, 'scrapeRealEstateAgencies']);

Route::get('/romanian-real-estate-agencies', [PlacesController::class, 'getRealEstateAgencies']);

Route::get('/s', [\App\Http\Controllers\realcontroller::class, 'getRealEstateAgencies']);

Route::get('/links', [LinksController::class, 'listing'])->name('links.listing');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->prefix('/admin')->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::prefix('roadmaps')->group(function () {
        Route::get('/', [AdminRoadmapsController::class, 'index'])->name('roadmaps.index');
        Route::get('/create', [AdminRoadmapsController::class, 'create'])->name('roadmaps.create');
        Route::post('/', [AdminRoadmapsController::class, 'store'])->name('roadmaps.store');
        Route::get('/{roadmap}/edit', [AdminRoadmapsController::class, 'edit'])->name('roadmaps.edit');
        Route::patch('/{roadmap}', [AdminRoadmapsController::class, 'update'])->name('roadmaps.update');
        Route::delete('/{roadmap}', [AdminRoadmapsController::class, 'destroy'])->name('roadmaps.destroy');

        Route::prefix('/nodes')->group(function () {
            Route::get('/{node}', [NodesController::class, 'index'])->name('roadmaps.nodes.index');
            Route::get('/{node}/create', [NodesController::class, 'create'])->name('roadmaps.nodes.create');
            Route::post('/', [NodesController::class, 'store'])->name('roadmaps.nodes.store');
            Route::get('/{node}/{childNode}/edit', [NodesController::class, 'edit'])->name('roadmaps.nodes.edit');
            Route::patch('/{node}', [NodesController::class, 'update'])->name('roadmaps.nodes.update');
            Route::post('/{node}/link', [NodesController::class, 'storeLink'])->name('roadmaps.nodes.store-link');
            Route::delete('/{node}/link/{link}', [NodesController::class, 'deleteLink'])->name('roadmaps.nodes.delete-link');
            Route::delete('/{node}', [NodesController::class, 'destroy'])->name('roadmaps.nodes.destroy');
        });
    });

    Route::get('/links', [LinksController::class, 'index'])->name('links.index');
    Route::post('/links', [LinksController::class, 'store'])->name('links.store');
    Route::patch('/links/{link}', [LinksController::class, 'update'])->name('links.update');
    Route::delete('/links/{link}', [LinksController::class, 'destroy'])->name('links.destroy');


    Route::get('/tags', [TagsController::class, 'index'])->name('tags.index');
    Route::post('/tags', [TagsController::class, 'store'])->name('tags.store');
    Route::patch('/tags/{tag}', [TagsController::class, 'update'])->name('tags.update');
});

Route::get('/roadmaps/{roadmap}', [RoadmapController::class, 'show'])->name('roadmaps.show');
