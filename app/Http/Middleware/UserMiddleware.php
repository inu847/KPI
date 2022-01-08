<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\PseudoTypes\False_;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('user')->check() == False || Auth::guard('user')->user()->roles->status == 'GUEST') {
            if ($request->route()->uri == 'create' || 
            $request->route()->uri == 'store' || 
            $request->route()->uri == 'edit' ||
            $request->route()->uri == 'update' ||
            $request->route()->uri == 'delete') {
                return redirect()->back()->with('status', 'Anda Tidak Mempunyai Hak Akses!!');
            }
        }elseif (Auth::guard('user')->user()->roles->status == 'STAFF') {
            if ($request->route()->uri == 'delete') {
                return redirect()->back()->with('status', 'Anda Tidak Mempunyai Hak Akses!!');
            }
        }
        return $next($request);
    }
}
