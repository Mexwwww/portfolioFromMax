<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('projects');
});

Route::get('/about-me', function () {
    return view('aboutMe');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/projects', function () {
    return view('projects');
});

Route::get('/projects/laravel', function () {
    return view('projects.laravel');
});

Route::get('/projects/unity', function () {
    return view('projects.unity');
});

Route::get('/projects/unreal-engine', function () {
    return view('projects.unreal-engine');
});
