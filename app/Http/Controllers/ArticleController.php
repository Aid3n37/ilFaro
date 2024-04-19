<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\User;
use App\Models\Article;
use App\Models\category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreArticleRequest;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index' , 'show','byCategory', 'byUser','byTag','articleSearch' );
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    //Per far si che nella pagina principale non siano presenti tutti quanti gli articoli inseriti
    //dobbiamo aggiornare la logica aggiungendo il metodo where che ci farà vedere solo gli articoli accettati
        $articles= Article::where('is_accepted' , true)->orderBy('created_at' ,'desc')->get();
        return view('article.index', compact('articles'));
    }

    public function articleSearch(Request $request){

        $query = $request->input('query');
        $articles = Article::search($query)->where('is_accepted' , true)->orderBy('created_at' , 'desc')->get();

        return view('article.search-index' , compact('articles' , 'query'));

    }

    public function byCategory(Category $category)
    {
        $articles = $category->articles()->where('is_accepted' , true)->orderby('created_at', 'desc')->get();
        return view('article.by-category', compact('category','articles'));
    }

    public function byUser(User $user)
    {
        $articles = $user->articles()->orderby('created_at', 'desc')->get();
        return view('article.by-user', compact('user','articles'));
    }

    public function byTag(Tag $tag)
    {
        $articles = $tag->articles()->orderby('created_at', 'desc')->get();
        return view('article.by-tag', compact('tag','articles'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('article.create');
    }

    /**
     * Store a newly created resource in storage.
    */

    public function store(StoreArticleRequest $request)
    {
        /*$request->validate([
            'title'=> 'required|unique:articles|min:3',
            'subtitle'=>'required|min:5',
            'body' => 'required|min:10',
            'image' => 'image|required',
            'category' => 'required',
        ]);*/

        $article = Article::create([
            'title'=> $request->title,
            'subtitle'=>$request->subtitle,
            'body' => $request->body,
            'image' => $request->file('image')->store('public/assets/img'),
            'category_id' => $request->category,
            'user_id' => Auth::user()->id,
            'slug' => Str::slug($request->title),
        ]);
        
        //In questo caso stiamo semplicemente dicendo di eliminare la virgola che il nostro utente stava inserendo
        //Con l'explode divido la stringa creata in un array di stringhe usando la virgola come delimitatore di essi.
        $tags=explode(',', $request->tags);
        //In questo modo elimino tutti fli spazi iniziali e finali di ogni stringa.
        $tags = array_map('trim', $tags);
        //Adesso gestisco tutti gli elementi vuoti come ad esempio stringhe vuote
        $tags = array_filter($tags); 
        //Essendo che il nostro utente può inserire più tag alla volta vado ad eseguire un ciclo forEach.
        //In questo ciclo stiamo iterando su ogni elemento di $tags con indice $i sull valore dell'elemento corrente ($tag);
        //All'interno del ciclo ho inserito il metodo trim che rimuove tutti gli spazi iniziali e/o finali della stringa.
        foreach ($tags as $i => $tag){
            $tags[$i]=trim($tag);
        }
        //Riuassumendo quello che ho fatto sopra:Ho inserito i tag all'interno delle regole di validazione vedi 'StoreArticleRequeste.php
        //Tramite la funzione explode abbiamo ottenuto da una stringa l'input tags tag un array di elementi che accetta due parametri
        //il primo è il divisore e il secondo è la stringa da dividere
        
        //Aggiungo un altro froeach
        
        foreach ($tags as $tag){
            $newTag = Tag::updateOrCreate(
                ['name'=>$tag],
                ['name'=> strtolower($tag)],
            );
            $article->tags()->attach($newTag);
        //Una volta aver ottenuto l'array di tags abbiamo lanciato la funzione updateOrCreate che, 
        //fa un controllo del database: Se il tag con quel nome non esiste lo crea.
        //Mentre, strtolower cambia i caratteri tutti in minuscolo.
        //Una volta aver gestito tutti i tag andiamo a fare l'attach nonchè la funzione che crea la relazione mtm
        }



        return redirect(route('homepage'))->with('message', 'Articolo creato correttamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {

        return view('article.show',compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        return view('article.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title'=> 'required|min:3|unique:articles,title,' .$article->id,
            'subtitle'=>'required|min:5',
            'body' => 'required|min:10',
            'image' => 'image',
            'category' => 'required',
        ]);
   
        $article->update([
            'title'=> $request->title,
            'subtitle'=>$request->subtitle,
            'body' => $request->body,
            'category_id' => $request->category,
            ]);

        $article->is_accepted=NULL;

        if ($request->image){
            Storage::delete($article->image);
            $article->update([
                'image'=> $request->file('image')->store('/public/image'),
            ]);
        }
  
        //In questo caso stiamo semplicemente dicendo di eliminare la virgola che il nostro utente stava inserendo
        $tags=explode(',', $request->tags);
                //In questo modo elimino tutti fli spazi iniziali e finali di ogni stringa.
        $tags = array_map('trim', $tags);
        //Adesso gestisco tutti gli elementi vuoti come ad esempio stringhe vuote
        $tags = array_filter($tags); 
        //In sostanza divido le stringhe dei tag creati in array, rimuovo gli spazi iniziali e finali e rimuovo i tag vuoti.
        foreach ($tags as $i => $tag){
            $tags[$i]=trim($tag);
        }



        
        //creazione nuovi tags
        $newTags = [];

        foreach ($tags as $tag){
            $newTag = Tag::updateOrCreate(
                ['name'=>$tag],
                ['name'=> strtolower($tag)],
            );
            $newTags = $newTag->id;
        }
        
        $article->tags()->sync($newTags);


        return redirect(route('writer.dashboard'))->with('message', 'Hai aggiornato correttamente l\'articolo');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        foreach($article->tags as $tag){
            $article->tags()->detach($tag);
        }

        Storage::delete($article->image);

        $article->delete();

        

        return redirect(route('writer.dashboard'))->with('message', 'Hai cancellato correttamente l\'articolo');
        //ricordarsi di inserire la rotta {{route(article.destroy, compact('article))}}
        //ricordarsi il method ='DELETE'
    }
}
