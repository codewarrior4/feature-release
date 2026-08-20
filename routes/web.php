<?php

use App\Http\Controllers\FeatureControlController;
use App\Http\Controllers\ShowcaseController;
use Illuminate\Support\Facades\Route;

Route::get('/', ShowcaseController::class)->name('showcase');
Route::post('/controls', FeatureControlController::class)->name('controls.update');
