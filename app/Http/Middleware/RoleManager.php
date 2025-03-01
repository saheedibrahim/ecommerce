<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $roles): Response
    {
        
        if(!Auth::check()){
            return redirect()->route('admin.login');
        }
        // $guards = empty($guards) ? [null] : $guards;

        // foreach($guards as $guard){
        //     if (Auth::guard($guard)->check()) {
        //         if($guard == 'admin'){
        //             return redirect()->route('admin.home');
        //         }
        //     }
        // }
        // if(!Auth::check()){
        //     return redirect('admin.login');
        // }

        $authUserGuard = Auth::guard($roles);

        if($authUserGuard){
            return $next($request);
        }

        // switch($roles){
        //     case 'admin':
        //         if($authUserGuard == 'admin'){
        //             return $next($request);
        //         }
        //         break;
            
        //     case 'seller':
        //         if($authUserGuard == 'seller'){
        //             return $next($request);
        //         }
        //         break;
                
        //     case 'client':
        //         if($authUserGuard == 'client'){
        //             return $next($request);
        //         }
        //         break;
        // }

        // switch($authUserGuard){
        //     case 'admin':
        //         return redirect()->route('admin.home');

        // }

        if(Auth::guard('admin')){
            return redirect()->route('admin.home');
        } elseif (Auth::guard('seller')){
            return redirect()->route('seller.home');
        }

        return redirect()->route('admin.login');
        
                    // return $next($request);
    }
}
