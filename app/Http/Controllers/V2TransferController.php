<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\V2\BFF;

class V2TransferController extends Controller
{
    public function transfer(Request $request)
    {
        return view('transfer')->with(BFF::outputDetail($request));
    }

    public function transfer_confirm(Request $request)
    {
        BFF::transferConfirm($request);
        
        return redirect()->to('v2/transfer_complete')->with(BFF::outputDetail($request));
    }

    public function transfer_complete(Request $request)
    {        
        return view('transfer_complete')->with(BFF::outputDetail($request));
    }
}
