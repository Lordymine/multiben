<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;
use App\Admin;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            // verifica se o usuario já está logado e é administrador ao tentar acessa
            // a pagina de login, se sim redireciona pro dashboard
            if(Admin::where('user_id', Auth::user()->id)->exists()){
                 return redirect(route('admin')); 
            }

            return redirect(RouteServiceProvider::HOME);
        }

        return $next($request);
    }
}
