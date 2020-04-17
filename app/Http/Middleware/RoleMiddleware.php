<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Support\Facades\Auth;
use App\Role;


class RoleMiddleware
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
        
     



            if(Auth::check()){
                
         return $next($request);
              
//return "este autor";

            }
//       return $next($request);
//          return (request()->header('intended')) ? redirect()->back() : redirect()->route('home'));
        return  redirect()->route('home');
//            return redirect('/');
           
    }
    }



