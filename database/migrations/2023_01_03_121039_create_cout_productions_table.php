<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cout_productions', function (Blueprint $table) {
            $table->id();
            $table->string('production_number');
            $table->string('libelle');
            $table->integer('montant');
            $table->mediumText('description');
            $table->string('date_production');
            $table->string('mois');
            $table->string('annee');
            $table->timestamps();
        });
       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cout_productions');
    }
};
