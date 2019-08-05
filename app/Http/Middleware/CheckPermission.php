<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Permission;
use Illuminate\Support\Facades\Route;
use Flash;

class CheckPermission
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

        $rol = Auth::user()->rol->id;
        $permission = Permission::where('rol_id', '=', $rol)->where('page', '=', Route::current()->getName())->count();
        
        if(Auth::user()->rol->name == 'Admin'){
            $permission += 1;    
        }

        if($permission == 0){
            Flash::error('No tienes permiso para la página '. Route::current()->getName());
            return redirect('/home');
        }

        return $next($request);
    }
}
