<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Subdomain;
use Session;

class SubdomainValidate
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
        $host = $request->getHost();
        $route = $request->route();
        $subdomain = $route->parameter('subdomain');
        $checkSubDomain = Subdomain::where('name', $subdomain)->whereIn('status', [1, 2])->first();
        if (!empty($checkSubDomain)) {
            Session::put('thisSubDomain', $subdomain);
            return $next($request);
        }
        abort(404);
    }
}
