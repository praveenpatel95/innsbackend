<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth'], function () {
    require_once 'routes/api/auth.php';
});
