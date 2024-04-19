<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserIsRevisor
{
    /**
    * Handle an incoming request.
    *
    * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
    */
    public function handle(Request $request, Closure $next): Response
    {
        //Se l'utente è loggato e sempre se l'utente loggato ha il ruolo di revisore possiamo farlo andare avanti.
        if(Auth::user() && Auth::user()->is_revisor){
            return $next($request);
        }
        //Adesso andremo a gestire tutti gli utenti che vogliono accedere ad una di queste viste ma non sono dei revisori
        //Come già fatto precedentemente conl'Admin
        return redirect(route('homepage'))->with('message', 'Non sei autorizzato');
    }
}
