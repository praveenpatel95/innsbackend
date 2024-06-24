<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ArticleController;
Route::group(['prefix' => 'news', 'middleware' => 'auth:sanctum'], function () {
    Route::get('search', [ArticleController::class, 'search']);
});
