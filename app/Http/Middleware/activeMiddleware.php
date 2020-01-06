<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class activeMiddleware
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
        //Inicio de la condición
        if(Auth::user()->active =='1'){             //se valida si está activo
            return $next($request);                     //Deja pasar la petición
        }else{
            Auth::logout();
            return redirect('/');                   //Redirecciona a la pagina de inicio
        }//Fin de la condicion
    }// Fin de la función
}// Fin de la clase
