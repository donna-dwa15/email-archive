<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Email;

class ViewEmailController extends Controller
{
    //$tag parameter comes from the routing {tag:name}
    public function __invoke(Email $email)
    {
        //jobs for this tag
        return view('emails.view-email', ['email' => $email]);
    }
}
