<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Admin;


// Esse middleware evita que um usuario logado tente acessar a area administrativa
// via URL

class checkPrivileges
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::user())
        {
            if(Admin::where('user_id', Auth::user()->id)->exists())
            {
               return $next($request);
            }

             return redirect(route('index')); 
        }

        return redirect('/');
    }
}