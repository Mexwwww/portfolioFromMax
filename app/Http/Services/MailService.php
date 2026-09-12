<?php

namespace App\Http\Services;

use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;


class MailService
{
    public static function ContactMail($header, $message, $senderEmail): void
    {
        Mail::to(env('MAIL_TOO_MAIL_TO'))->send(new ContactMail($header, $message, $senderEmail));
    }
}
