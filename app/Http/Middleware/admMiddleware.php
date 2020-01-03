<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

//Inicio de la clase admMiddleware
class admMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    //Inicio de la función handle
    public function handle($request, Closure $next)
    {
        //Inicio de la condición
        if( Auth::user() && Auth::user()->role_id =='3'){   //se valida si esta logueado y si responde al role administrador (3)
            return $next($request);                         //Deja pasar la petición
        }else{
            return redirect('/');                           //Redirecciona a la pagina de inicio
        }//Fin de la condicion
    }// Fin de la función
}// Fin de la clase
