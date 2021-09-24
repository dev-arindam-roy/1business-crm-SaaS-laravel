<?php

namespace App\Http\Controllers\Crm\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Helper;
use Hash;
use Auth;

class DashboardController extends Controller
{
    private $subdomain;

    public function __construct(Request $request)
    {
        $this->subdomain = $request->subdomain;
    }

    public function myDashboard(Request $request)
    {
        $DataBag = [];
        return view('testpage');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('auth.businessLogin', array('subdomain' => $this->subdomain));
    }
}
