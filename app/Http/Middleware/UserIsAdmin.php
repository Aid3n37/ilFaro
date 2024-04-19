<?php
//creato con il comando  php artisan make:middleware UserIsAdmin
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
//classe auth importata.
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;


class UserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //la request prosegue solo se l'utente è loggato e ha il ruolo di admin. 
        if(Auth::user() && Auth::user()->is_admin){
            return $next($request);
        }
        //ovviamente se questo non accade, gli altri utenti non hanno l'accesso
        else{
            return redirect(route('homepage'))->with('message','non sei autorizzato');
        }
    }

    //il middleware deve essere inserito nel kernel in protected $middlewareAliases
    //per questione di pulizia si è costruito il controller
    //creare le rotte in un gruppo di middleware
}
