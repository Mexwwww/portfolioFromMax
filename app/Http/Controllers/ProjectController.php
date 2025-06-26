<?php

namespace App\Http\Controllers;

use App\Http\Services\MailService;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index($category, $name)
    {
        return view("projects.$category.$name");
    }
}
