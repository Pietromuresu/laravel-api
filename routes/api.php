<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\PageController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/mail',[LeadController::class, 'store']);

Route::namespace('Api')
        ->prefix('projects')
        ->group(function(){
            Route::get('/', [PageController::class, 'index']);
            Route::get('/types', [PageController::class, 'types']);
            Route::get('/technologies', [PageController::class, 'technologies']);
            Route::get('/project-types/{id}', [PageController::class, 'filteredType']);
            Route::get('/project-technologies/{id}', [PageController::class, 'filteredTechnology']);
            Route::get('/{slug}', [PageController::class, 'getBySlug']);
            Route::get('/search/{nameToSearch}', [PageController::class, 'getByName']);
        });
