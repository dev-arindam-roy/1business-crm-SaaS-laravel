<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Helper;

class CheckDataController extends Controller
{
    public function emailExistOrNot(Request $request)
    {
        return Helper::emailExistOrNot($request->input('email'));
    }

    public function contactNumberExistOrNot(Request $request)
    {
        return Helper::contactNumberExistOrNot($request->input('mobile'));
    }

    public function subdomainExistOrNot(Request $request)
    {
        return Helper::subdomainExistOrNot($request->input('subdomain'));
    }
}
