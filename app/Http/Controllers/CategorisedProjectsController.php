<?php

namespace App\Http\Controllers;

use App\Http\Services\MailService;
use Illuminate\Http\Request;

class CategorisedProjectsController extends Controller
{
    public function index()
    {
        return view("projects.categorisedProjects");
    }
}
