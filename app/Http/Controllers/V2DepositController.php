<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\V2\BFF;

class V2DepositController extends Controller
{
    public function deposit(Request $request)
    {
        return view('deposit')->with(BFF::outputDetail($request));
    }

    public function crypto_payment(Request $request)
    {
        return view('crypto_payment')->with(BFF::outputDetail($request));
    }

    public function crypto_payment_confirm(Request $request)
    {
        $request;
        return redirect()->to('v2/txid')->with(BFF::outputDetail($request));
    }

    public function txid(Request $request)
    {
        return view('txid')->with(BFF::outputDetail($request));
    }

    public function txid_confirm(Request $request)
    {
        $request;
        return redirect()->to('v2/payment_complete')->with(BFF::outputDetail($request));
    }

    public function payment_complete(Request $request)
    {
        return view('payment_complete')->with(BFF::outputDetail($request));
    }

    public function withdraw(Request $request)
    {
        return view('withdraw')->with(BFF::outputDetail($request));
    }

    public function bank_withdraw_confirm(Request $request)
    {
        $request;
        return redirect()->to('v2/withdraw_complete')->with(BFF::outputDetail($request));
    }

    public function crypto_withdraw_confirm(Request $request)
    {
        $request;
        return redirect()->to('v2/withdraw_complete')->with(BFF::outputDetail($request));
    }

    public function withdraw_complete(Request $request)
    {
        return view('withdraw_complete')->with(BFF::outputDetail($request));
    }
}
