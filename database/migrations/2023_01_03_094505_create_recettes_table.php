<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('recettes', function (Blueprint $table) {
            $table->id();
            $table->string('recette_number');
            $table->string('libelle');
            $table->integer('montant');
            $table->mediumText('description');
            $table->string('date_recette');
            $table->string('mois');
            $table->string('annee');
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('recettes');
    }
};
