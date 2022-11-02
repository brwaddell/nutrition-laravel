<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class WebInstallerMiddleware
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
        if (file_exists(storage_path('installed'))) {

            return $next($request);

        } else{

            return redirect()->to('/install');
        }
    }
}
