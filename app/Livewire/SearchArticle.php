<?php

namespace App\Livewire;

use App\Models\Article;
use Livewire\Component;

class SearchArticle extends Component
{

    public $search = '';
    public function render()
    {
            if ($this->search) {
                $articles = Article::search($this->search)->get();
            } else {
                $articles = Article::where('is_accepted' , true)->orderBy('created_at' ,'desc')->get();
            }
        
        return view('livewire.search-article' , compact('articles'));
    }
}
