<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\V2\BFF;

class V2UserController extends Controller
{
    public function summary(Request $request)
    {
        return view('summary');
    }

    public function history(Request $request)
    {
        $page = isset($request->page) ? $request->page : 1;
        $request->merge(array('page' => $page));        

        return view('history')->with(BFF::outputDetail($request));
    }

    public function setting(Request $request)
    {
        return view('setting')->with(BFF::outputDetail($request));
    }

    public function setting2(Request $request)
    {
        return view('setting2')->with(BFF::outputDetail($request));
    }

    public function activate_2fa(Request $request)
    {
        BFF::activateTwoFactorAuthenticate($request);
        return view('setting')->with(BFF::outputDetail($request));
    }

    public function inactivate_2fa(Request $request)
    {
        BFF::inactivateTwoFactorAuthenticate($request);
        return view('setting')->with(BFF::outputDetail($request));
    }
}
