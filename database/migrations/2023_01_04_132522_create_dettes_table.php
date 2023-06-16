<?php

use App\Models\Sale;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
   
    public function up()
    {
        Schema::create('dettes', function (Blueprint $table) {
            $table->id();
            $table->string('dette_number');
            $table->integer('montant');
            $table->string('mois');
            $table->string('annee');
            $table->string('date_dette');
            $table->foreignIdFor(Sale::class);
            $table->timestamps();
        });
    }

   
    public function down()
    {
        Schema::dropIfExists('dettes');
    }
};
