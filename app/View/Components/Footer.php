<?php

namespace App\View\Components;

use App\Models\Article;
use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Footer extends Component
{
    public $articles;

    public function __construct()
    {
        $this->articles = Article::latest()->take(4)->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.footer');
    }
}
