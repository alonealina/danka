<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class V2DemoAcountController extends Controller
{
    public function demo_acount()
    {
        return view('demo_acount');
    }

    public function demo_confirm(Request $request)
    {
        $request;
        return redirect()->to('v2/demo_acount_complete');
    }

    public function demo_acount_complete()
    {
        return view('demo_acount_complete');
    }

}
