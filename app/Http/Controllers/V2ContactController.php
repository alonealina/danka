<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class V2ContactController extends Controller
{
    public function contact()
    {
        return view('contact');
    }

    public function contact_confirm(Request $request)
    {
        $request;
        return redirect()->to('v2/contact_complete');
    }

    public function contact_complete()
    {
        return view('contact_complete');
    }


}
