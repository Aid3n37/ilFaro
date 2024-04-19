<?php

namespace App\Models;

use App\Models\User;
use App\Models\category;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Scout\Searchable;

class Article extends Model
{
    // Collegamento Trait Laravel Scout
    use HasFactory, Searchable;

    protected $fillable = [

        'title','subtitle','body','image','user_id','category_id', 'is_accepted','slug',
    ];

    public function getRoutekeyName(){

        return 'slug';
    }

    public function readDuration(){

        $totalWords = str_word_count($this->body);
        $minutesToRead = round($totalWords / 200);
        
        return intval($minutesToRead);
    }

   // Funzione che specifica tramite array quali campi indicizzare
    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'title'=> $this->title,
            'subtitle'=>$this->subtitle,
            'body'=> $this->body,
            'category'=> $this->category,
        ];
    }
    public function user(){

        return $this->belongsTo(User::class);

    }

    public function category(){

        return $this->belongsTo(Category::class);

    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
    public static function footerAnnouncements(){
        $articles=Article::where('is_accepted' , true)->orderBy('created_at','desc')->take(4)->get();
      
        return $articles;
    }
}
