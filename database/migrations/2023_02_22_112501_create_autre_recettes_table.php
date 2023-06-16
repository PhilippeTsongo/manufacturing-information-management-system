<?php

use App\Models\TypeRecette;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create('autre_recettes', function (Blueprint $table) {
            $table->id();
            $table->string('recette_number');
            $table->foreignIdFor(TypeRecette::class);
            $table->float('montant');
            $table->string('description');
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('autre_recettes');
    }
};
