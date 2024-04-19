<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WriterController extends Controller
{
    public function dashboard(){

        $articles = Auth::user()->articles()->orderBy('created_at' ,'desc')->get();
        //In questo modo stiamo dicendo: se il valore di is_accepted è '===' al valore null.
        $unrevisionedArticles = $articles->where('is_accepted', NULL);
        //In questo caso lavoreremo su un valore tre
        $acceptedArticles = $articles->where('is_accepted', true);
        //Adesso inceve andrò a lavorare con i valori false;
        //whereNotNull perchè nel where classico, il valore NULL passa come false e quindi quei articoli vengono scelti. 
        $rejectedArticles = $articles->whereNotNull('is_accepted')->where('is_accepted', false);
        //Sostanzialmente sto dividendo in tre variabili diverse gli articoli accettati, rifiutati e sospesi da parte di un writer
        //La logica la possiamo paragonare a quella già implementata all'interno del 'RevisorController'.   
        return view('writer.dashboard', compact('unrevisionedArticles' , 'acceptedArticles' , 'rejectedArticles'));
    }
}


