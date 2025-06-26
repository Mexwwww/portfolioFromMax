<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SendMail;
use Illuminate\Support\Facades\Route;

Route::get('/', function ()
{
    return redirect('categorys');
});

Route::get('/about-me', function ()
{
    return view('aboutMe');
});

Route::get('/contact', function ()
{
    return view('contact');
});

Route::get('/categorys', function ()
{
    return view('/categorys');
});

Route::get('/categorised-projects', function ()
{
    return view('categorisedProjects');
});

Route::get('/projects/{category}/{name}', [ProjectController::class, 'index']);

Route::get('/ajax/send-mail', [SendMail::class, 'ContactMail']);
