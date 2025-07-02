<?php

namespace App\Http\Controllers;

use App\Http\Services\MailService;
use Illuminate\Http\Request;

class LayoutButtonController extends Controller
{
    public function index($name)
    {
        return view("$name");
    }
}
