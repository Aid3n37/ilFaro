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
        //Migrazione creata per la gestione degli articoli con comando php artisan make:migration... :
        //Con la colonna che andremo a creare is_accepted andremo a gestire 3 valori:
        //NULL / TRUE / FALSE che andranno a gestire le scelte del revisore.
        Schema::table('articles', function (Blueprint $table) {
            //La colonna con valore booleano is_accepted dopo la colonna user_id può avere valore nullable()
            $table->boolean('is_accepted')->after('user_id')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('is_accepted');
        });
    }
};
