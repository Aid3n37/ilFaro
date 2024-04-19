<?php

namespace App\Models;
//Come fatto anche nel model di article mi importo la classe
use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    //Adesso vado ad inserire la funzione di relazione anche all'interno del file Tag.php 
    public function articles(){
        return $this->belongsToMany(Article::class);
    }
}
