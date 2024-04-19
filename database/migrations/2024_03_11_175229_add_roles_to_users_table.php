<?php

use App\Models\User;
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
          // Dopo aver creato la migrazione con il comando artisan all'interno della tabella inserisco le colonne con i vari ruoli e le vare posizioni;
        //In sintesi is_admin: aggiunge una colonna booleana "is_admin" alla tabella "users" 
    //dopo la colonna "email". Sono concessi valori NULL e imposta il valore di default su false.
 //Queste servono tenere traccia di diversi ruoli o autorizzazioni.
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_admin')->after('email')->nullable()->default(false);
            $table->boolean('is_revisor')->after('is_admin')->nullable()->default(false);
            $table->boolean('is_writer')->after('is_revisor')->nullable()->default(false);
        });

        //Al di fuori della tabella schema andiamo a creare un nuovo utente:
        $user= User::create([
            'name'=> 'Admin',
            'email'=> 'admin@ilfaro.it',
            'password'=> bcrypt('secret'),
            'is_admin'=> true,
        ]);

        $user= User::create([
            'name'=> 'Revisor',
            'email'=> 'revisor@ilfaro.it',
            'password'=> bcrypt('revision'),
            'is_revisor'=> true,
        ]);

        $user= User::create([
            'name'=> 'Writer',
            'email'=> 'writer@ilfaro.it',
            'password'=> bcrypt('writing'),
            'is_writer'=> true,
        ]);

        //l'Array che abbiamo creato contiene tutti i dati che inseriremo all'interno della tabella users,
        //l'hashing Bcrypt serve per l'archiviazione delle password degli utenti.
        //la colonna impostata su true fa si l'utente appena creato ha autorizzazioni o autorizzazione rispetto un semplice utente loggato.


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //Con il codice qua sotto andiamo ad eliminare un utente con uno specifico indirizzo email per merito del metodo where().
        User::where('email' , 'admin@ilfaro.it')->delete();
        Schema::table('users', function (Blueprint $table) {
           $table->dropColumn(['is_admin' , 'is_revisor' , 'is_writer']);
           // il metodo dropColumn rimuove le colonne specificate al suo interno.
        });
    }
};
