<?php

namespace App\Http\Controllers;

use App\Mail\CareerRequestMail;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PublicController extends Controller
{

    public function homepage() {
// Modifica del metodo homepage:
// Vado a ordinare i nostri articoli in base alla data di creazione in ordine decrescente, selezionando solo gli 
//ultimi 4 articoli.
    //$articles= Article::where("is_accepted", true)->orderBy('created_at','desc')->take(11)->get();
    //$articles_sx= Article::orderBy('created_at','desc')->take(1)->get();
    //$articles_sm=Article::orderBy('created_at','desc')->take(6)->get();

    //return view('welcome' , compact('articles','articles_sx','articles_sm'));
    //return view('welcome' , compact('articles'));

    //Per far si che nella pagina principale non siano presenti tutti quanti gli articoli inseriti
    //dobbiamo aggiornare la logica aggiungendo il metodo where che ci farà vedere solo gli articoli accettati
    //La stessa cosa va implementata anche per l'articleController 
    $articles= Article::where('is_accepted' , true)->orderBy('created_at','desc')->take(11)->get();
        return view('welcome' , compact('articles'));
    }

    public function aboutUs(){

        return view('about-us');
    }

    public function careers(){

        return view('careers');
    }

    public function careersSubmit(Request $request){

    //Stiamo dichiarando un metodo careersSubmit(vedi web.php)che ha come parametro un injection in cui 
    //verranno passati i dati tramite richiesta HTTP.
    //Il validate si utilizza per la convalida della richiesta in modo da avere il controllo di 
    //eventuali campi required o altre regole.

        $request->validate([
            'role'=>'required',
            'email'=>'required | email',
            'message'=>'required'
        ]);
       
        $user = Auth::user();
        $role = $request->role;
        $email = $request->email;
        $message = $request->message;

        //In questo modo arriva una notifica di conferma alla mail inserita
        //con i relativi dati : ruolo , email , messaggio.
        Mail::to('admin@ilfaro.it')->send(new CareerRequestMail(compact('role','email','message')));

        //dd($role);
        //Lo switch in questione aggiorna il ruolo dell'utente in base al ruolo che esso seleiona nel form 
        //in careers.blade.php.Con il Null si ha la possibilità di andare a rimuovere il ruolo inserito.
        switch ($role){
            case 'admin';
                $user->is_admin = NULL;
                break;

            case 'revisor';
                $user->is_revisor = NULL;
                break;

            case 'writer';
                $user->is_writer = NULL;
                break;
        }


        //con l'update si aggiornano i dati dell'user --> ricontrollare il codice
        $user->update();

        switch ($role){
            case 'admin';
                $user->is_revisor = 0;
                $user->is_writer = 0;
                break;

            case 'revisor';
                $user->is_admin = 0;
                $user->is_writer = 0;
                break;

            case 'writer';
                $user->is_admin = 0;
                $user->is_revisor = 0;
                break;
        }
        

        return redirect(route('homepage'))->with('message' , 'Grazie per averci contattato!');
    }

    // public function footerArticle(){
       //$articles= Article::where('is_accepted' , true)->orderBy('created_at','desc')->take(6)->get();
    //     return view('components.footer', compact('articles'));
        
    // }
}
