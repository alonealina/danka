<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\V2\BFF;

class V2AddAcountController extends Controller
{
    public function add_acount(Request $request)
    {
        return view('add_acount')->with(BFF::outputDetail($request));
    }

    public function add_confirm(Request $request)
    {
        $isSuccess = BFF::addAccountConfirm($request);

        if(!$isSuccess)
        {
            return view('add_account_error')->with(BFF::outputDetail($request));
        }

        return redirect()->to('v2/add_acount_complete')->with(BFF::outputDetail($request));
    }

    public function add_acount_complete(Request $request)
    {
        return view('add_acount_complete')->with(BFF::outputDetail($request));
    }

}
