<?php

use App\Http\Controllers\CategorisedProjectsController;
use App\Http\Controllers\LayoutButtonController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SendMail;
use Illuminate\Support\Facades\Route;

Route::get('/', function ()
{
    return redirect('categories');
});

Route::get('/{name}', [LayoutButtonController::class, 'index']);

Route::get('/projects/{category}/{name}', [ProjectController::class, 'index']);

Route::get('/ajax/send-mail', [SendMail::class, 'ContactMail']);

Route::get('/categorised/Projects/{name}', [CategorisedProjectsController::class, 'index']);
