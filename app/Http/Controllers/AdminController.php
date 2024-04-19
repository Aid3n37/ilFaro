<?php
//creato con php artisan make:controller ...
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use App\Models\Tag;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //la funzione gestiste i dati delle richieste dagli utenti
    public function dashboard(){
        //variabile di tutti quelli utenti che hanno la colonna is_admin su null
        $adminRequests = User::where('is_admin', NULL)->get();
        //variabile di tutti quelli utenti che hanno la colonna is_revisor su null
        $revisorRequests = User::where('is_revisor', NULL)->get();
        //variabile di tutti quelli utenti che hanno la colonna is_writer su null
        $writerRequests = User::where('is_writer', NULL)->get();
        // inserimento dei tag
        //$tags = Tag::all();
        //$categories = Category::all();
       
        //ritorna la vista dashboard nella cartella admin. usando molteplici compact.
        return view('admin.dashboard', compact('adminRequests', 'revisorRequests','writerRequests'));
    }

    //con queste funzioni l'amministratore approva la richiesta

    public function setAdmin(User $user){
        $user->is_admin = true;
        $user->save();

        return redirect(route('admin.dashboard'))->with('message', 'Hai correttamente reso amministratore l\' utente scelto');
    }

    public function setRevisor(User $user){
        $user->is_revisor = true;
        $user->save();

        return redirect(route('admin.dashboard'))->with('message', 'Hai correttamente reso revisore l\' utente scelto');
    }

    public function setWriter(User $user){
        $user->is_writer = true;
        $user->save();

        return redirect(route('admin.dashboard'))->with('message', 'Hai correttamente reso redattore l\' utente scelto');
    }

    public function storeTag(Request $request)
    {
        Tag::create([
            'name'=> strtolower($request->name), 
        ]);

        return redirect(route('admin.dashboard'))->with('message', 'Hai correttamente inserito una nuova tag');
    }


    public function editTag(Request $request, Tag $tag)
    {
        //con la seguente request è obbligatorio il campo
        $request->validate([
            'name'=> 'required|unique:tags'
        ]);

        //fa in modo che al momento dell'aggiornamento del tag sia tutto in minuscolo
        $tag->update([
            'name'=> strtolower($request->name)
        ]);

        return redirect(route('admin.dashboard'))->with('message', 'Hai correttamente aggiornato il tag');
    }

    public function deleteTag(Tag $tag)
    {
        //viene ciclato ogni articolo che contiene il tag in questione
        foreach($tag->articles as $article)
        {
            //il tag viene tolto dai vari articoli
            $article->tags()->detach($tag);
        }


        $tag->delete();

        return redirect(route('admin.dashboard'))->with('message', 'Hai correttamente eliminato il tag');
    }

    public function editCategory(Request $request, Category $category)
    {
        //con la seguente request è obbligatorio il campo
        $request->validate([
            'name'=> 'required|unique:categories'
        ]);

        //fa in modo che al momento dell'aggiornamento del tag sia tutto in minuscolo
        $category->update([
            'name'=> strtolower($request->name)
        ]);

        return redirect(route('admin.dashboard'))->with('message', 'Hai correttamente aggiornato la categoria');
    }

    public function deleteCategory(Category $category)
    {
        //cancellazione
        $category->delete();

        return redirect(route('admin.dashboard'))->with('message', 'Hai correttamente eliminato la categoria');
    }

    public function storeCategory(Request $request)
    {
        Category::create([
            'name'=> strtolower($request->name), 
        ]);

        return redirect(route('admin.dashboard'))->with('message', 'Hai correttamente inserito una nuova categoria');
    }
}
