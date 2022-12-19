<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class V2CompanyController extends Controller
{
    public function company()
    {
        return view('company');
    }
}
