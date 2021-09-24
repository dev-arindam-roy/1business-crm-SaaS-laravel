<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;
use Auth;

class IfLoggedIn
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
        if (Auth::check()) {
            $response = $next($request);
            return $response->header('Cache-Control','nocache, no-store, max-age=0, must-revalidate')
            ->header('Pragma','no-cache')
            ->header('Expires','Fri, 01 Jan 1990 00:00:00 GMT');
        }
        session()->flash('msg', 'Unauthorized Access!');
        session()->flash('type', 'alert alert-danger');
        $msgBox = [];
        $msgBox['title'] = '<strong>Unauthorized Access!!</strong> <br/> Please sign-in with your credentials and access your account, thankyou.';
        $msgBox['type'] = 'alert-danger';
        return redirect()->route('auth.signIn')->with('msgbox', $msgBox);
    }
}
