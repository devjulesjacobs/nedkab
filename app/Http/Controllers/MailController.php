<?php

namespace App\Http\Controllers;

use App\Mail\NewEmballage;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendMail()
    {
        $details = [
            'title' => 'Bevestiging Emballage',
            'body' => 'Emballage succesvol ingediend, houdt de app in de gaten voor updates.',
        ];

        Mail::to("jules.j.jacobs@gmail.com")->send(new NewEmballage($details));

        return 'Email sent';
    }
}
