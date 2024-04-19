<?php

namespace App\Providers;

use App\Models\Tag;
use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (Schema::HasTable('categories')){
            $categories = Category::all();
            View::share(compact('categories'));
        }
        //inserimento dell'accessibilità dei tag nei vari elementi
        if (Schema::HasTable('tags')){
            $tags = Tag::paginate(10);
            View::share(compact('tags'));
        }

        Paginator::useBootstrapFive();
    }
}
