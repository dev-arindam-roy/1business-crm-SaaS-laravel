<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Subdomain;
use App\Models\BusinessInformation;
use Session;
use Auth;

class AccountValidate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Session::has('thisSubDomain') && Session::get('thisSubDomain') != Session::get('signInDomain')) {
            abort(404);
        }

        if (Auth::user()->status != 1) {
            abort(404); 
        }

        if (Auth::user()->is_owner == 1) {
            $subDomainInfo = Auth::user()->subdomainInfo;
            $busiNessInfo = Auth::user()->businessInfo;
        }

        if (Auth::user()->is_owner == 0 && Auth::user()->owner_id != 0) {
            $subDomainInfo = Subdomain::where('user_id', Auth::user()->owner_id)->first();
            $busiNessInfo = BusinessInformation::where('user_id', Auth::user()->owner_id)->first();
        }

        if ($subDomainInfo->status != 1) {
            abort(404); 
        }

        if (Session::has('signInDomain') && Session::get('signInDomain') != $subDomainInfo->name) {
            abort(404); 
        }

        $shareInfo = [];
        $shareInfo['subdomainInfo'] = $subDomainInfo;
        $shareInfo['businessInfo'] = $busiNessInfo;
        View::share($shareInfo);
        return $next($request);
    }
}
