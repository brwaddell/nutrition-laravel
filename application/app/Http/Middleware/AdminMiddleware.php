<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Session;

class AdminMiddleware
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
        if(auth()->user()->role != 'admin'){
            Session::flash('message', 'Only admin can visit there');

            Toastr::success('', 'Only admin can visit there');

            return redirect()->back()->with('success', 'Only admin can visit there');
        }
        return $next($request);
    }
}
