<?php

namespace App\Http\Controllers\Document;

use App\Mail\RceMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class SendEmailController extends Controller
{
    public function index($document)
    {

//        Mail::to('receiver-email-id')->send(new RceMail());
        Mail::to('prodrigmd@gmail.com')->send(new RceMail());
//        Mail::to('admin@rce.neurorad.cl')->send(new RceMail());

        if (Mail::failures()) {
            return response()->Fail('Sorry! Please try again latter');
        }else{
            return response()->success('Great! Successfully send in your mail');
        }
    }
}
