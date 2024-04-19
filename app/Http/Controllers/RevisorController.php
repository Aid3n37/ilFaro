<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class RevisorController extends Controller
{
    //All'interno dobbiamo inserire una funzione con metodo chiamato come nel file web.php
    //Dentro la funzione andiamo a gestire le tre condizioni 
    public function dashboard(){
        //Qui ci saranno tutti gli articoli con valore NULL
        $unrevisionedArticles= Article::where('is_accepted',NULL)->get();
         //Qui ci saranno tutti gli articoli con valore TRUE
        $acceptedArticles= Article::where('is_accepted',true)->get();
         //Qui ci saranno tutti gli articoli con valore FALSE
        $rejectedArticles= Article::where('is_accepted',false)->get();
        //Adesso vado a ritornare la vista nella cartella revisor in cui con il compact
        //richiamiamo le tre variabili
        return view('revisor.dashboard',compact('unrevisionedArticles','acceptedArticles','rejectedArticles'));

    }

    public function acceptArticle(Article $article){
        //La variabile article andrà a cambiare il valore di is_accepted in true in modo da accettare l'articolo da parte del revisore
        //con il metodo successivo andiamo a salvare il tutto
        $article->is_accepted = true;
        $article->save();
        //Con il return ritorniamo alla rotta di dashboard, all'interno della cartella di revisor
        //con un messaggio di ritorno 
        return redirect(route('revisor.dashboard'))->with('message' , 'Hai accettato l\'articolo scelto');

    }

    public function rejectArticle(Article $article){
        //La variabile article andrà a cambiare il valore di is_accepted in false in modo da rifiutrare l'articolo da parte del revisore
        //con il metodo successivo andiamo a salvare il tutto
        $article->is_accepted=false;
        $article->save();
        //Con il return ritorniamo alla rotta di dashboard, all'interno della cartella di revisor
        //con un messaggio di ritorno 
        return redirect(route('revisor.dashboard'))->with('message' , 'Hai rifiutato l\'articolo scelto');

    }

    public function undoArticle(Article $article){
        //La variabile article andrà a cambiare il valore di is_accepted in null in modo da far tornare in revisione l'articolo
        //con il metodo successivo andiamo a salvare il tutto
        $article->is_accepted=NULL;
        $article->save();
        //Con il return ritorniamo alla rotta di dashboard, all'interno della cartella di revisor
        //con un messaggio di ritorno 
        return redirect(route('revisor.dashboard'))->with('message' , 'Hai riportato l\'articolo scelto in revisione');

    }
}
