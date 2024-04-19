<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\RevisorController;
use App\Http\Controllers\WriterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PublicController::class, 'homepage'])->name('homepage');
Route::get('/about-us',[PublicController::class,'aboutUs'])->name('aboutUs');





Route::get('/article/index', [ArticleController::class, 'index'])->name('article.index');
Route::get('/article/show/{article:slug}', [ArticleController::class, 'show'])->name('article.show');


Route::get('/article/category/{category}', [ArticleController::class, 'byCategory'])->name('article.byCategory');
Route::get('/article/user/{user}', [ArticleController::class, 'byUser'])->name('article.byUser');
Route::get('/article/tag/{tag}', [ArticleController::class, 'byTag'])->name('article.byTag');
// rotta che gestisce la ricerca degli articoli
Route::get('/article/search', [ArticleController::class, 'articleSearch'])->name('article.search');
//le rotte del gruppo devono fare riferimento al middleware custom creato da noi, quindi admin
Route::middleware('admin')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    //rotta parametrica, proprio perchè varia da utente ad utente
    Route::patch('/admin/{user}/user-admin', [AdminController::class, 'setAdmin'])->name('admin.setAdmin');
    Route::patch('/admin/{user}/user-revisor', [AdminController::class, 'setRevisor'])->name('admin.setRevisor');
    Route::patch('/admin/{user}/user-writer', [AdminController::class, 'setWriter'])->name('admin.setWriter');
    //rotte per la modifica e/o per la cancellazione dei tag
    Route::put('/admin/edit/{tag}/tag', [AdminController::class, 'editTag'])->name('admin.editTag');
    Route::delete('/admin/delete/{tag}/tag', [AdminController::class, 'deleteTag'])->name('admin.deleteTag');
    Route::post('/admin/tag/store', [AdminController::class, 'storeTag'])->name('admin.storeTag');
    //rotte per la modifica e/o per la cancellazione dei tag
    Route::put('/admin/edit/{category}/category', [AdminController::class, 'editCategory'])->name('admin.editCategory');
    Route::delete('/admin/delete/{category}/category', [AdminController::class, 'deleteCategory'])->name('admin.deleteCategory');
    Route::post('/admin/category/store', [AdminController::class, 'storeCategory'])->name('admin.storeCategory');
});

//Gestione del gruppo delle rotte midlleware di revisor
Route::middleware('revisor')->group(function () {
    Route::get('/revisor/dashboard', [RevisorController::class, 'dashboard'])->name('revisor.dashboard');

    //Qua sto creando una rotta post protetta dal middleware revisor che permetta di accettare un articolo al revisore
    Route::post('/revisor/{article}/accept', [RevisorController::class, 'acceptArticle'])->name('revisor.acceptArticle');

    //Anche con questa rotta manteniamo la stessa identica logica con la differenza che andranno a rifiutare la richiesta del nuovo articolo.
    Route::post('/revisor/{article}/reject', [RevisorController::class, 'rejectArticle'])->name('revisor.rejectArticle');

    //Rotta con nuovamente la stessa logica di prima 
    Route::post('/revisor/{article}/undo', [RevisorController::class, 'undoArticle'])->name('revisor.undoArticle');
});

//Ho raggruppato tutte le rotte a me interessate all'interno della rotta middleware in modo da 
//gestire il tutto in modo più veloce e meno ridondante.
//In questo modo posso eseguire una gestione efficace di tutta la parte di codice, anche nel caso di futuri cambiamenti
Route::middleware(['auth'])->group(function () {
    Route::get('/careers', [PublicController::class, 'careers'])->name('careers');
    Route::post('/careers/submit', [PublicController::class, 'careersSubmit'])->name('careers.submit');
});
//FINE DELLE ROTTE GESTITE DA MIDDLEWARE


Route::middleware('writer')->group(function () {
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('article.create');
    Route::post('/article/store', [ArticleController::class, 'store'])->name('article.store');
    Route::get('writer/dashboard', [WriterController::class, 'dashboard'])->name('writer.dashboard');
    Route::get('/article/{article}/edit', [ArticleController::class, 'edit'])->name('article.edit');
    //aggiungere la rotta {{route('article.edit', compact ('article))}} nella dashboard del writer
    Route::put('article/{article}/update' , [ArticleController::class, 'update'])->name('article.update');
    Route::delete('article/{article}/destroy' , [ArticleController::class, 'destroy'])->name('article.destroy');
});
