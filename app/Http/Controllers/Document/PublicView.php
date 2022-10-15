<?php

namespace App\Http\Controllers\Document;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PublicView extends Controller
{
    public function checkQrCode($file)
    {
        if (file_exists(storage_path('app/documents/qrcode_'.$file))){
            $content = $file;
        } else {
            $content = null;
        }

        return view('documents/checkQrCode', compact('content'));

    }
}
