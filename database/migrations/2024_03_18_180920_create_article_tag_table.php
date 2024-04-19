<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('article_tag', function (Blueprint $table) {
            $table->id();
             // In questo momento sto mettendo in relazione le due tabelle (article e tag) per merito delle loro chiavi esterne
            //unsignedBigInteger --> Questo metodo lo si utilizza per specificare i dati della colonna;
           //In questo caso si crea una colonna con un tipo di dato 'BigInteger' in modo da memorizzare numeri più grandi.
          //All'interno delle parentesi troviamo il nome della colonna creata.
            $table->unsignedBigInteger('article_id')->nullable();
            //In questo caso si fa riferimento alla colonna id all'interno di articles
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('SET NULL');
          
            //La stessa cosa dovrà essere fatta anche per i tag
            $table->unsignedBigInteger('tag_id')->nullable();
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('SET NULL');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_tag');
    }
};
