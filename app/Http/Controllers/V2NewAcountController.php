<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class V2NewAcountController extends Controller
{
    public function new_acount(Request $request)
    {
        $ref = $request->ref;
        return view('new_acount', ['ref' => $ref]);
    }

    public function indi_confirm(Request $request)
    {
        $request;
        return redirect()->to('v2/new_acount_complete');
    }

    public function corp_confirm(Request $request)
    {
        $request;
        return redirect()->to('v2/new_acount_complete');
    }

    public function new_acount_complete()
    {
        return view('new_acount_complete');
    }

}
