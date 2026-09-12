<?php

namespace App\Http\Controllers;

use App\Http\Services\MailService;
use Illuminate\Http\Request;

class SendMail extends Controller
{
    private MailService $service;

    public function __construct(MailService $service)
    {
        $this->service = $service;
    }

    function ContactMail(Request $request)
    {
        $this->service->ContactMail($request->input('header'), $request->input('message'), $request->input('email'));
    }
}
