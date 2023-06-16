<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('justifications', function (Blueprint $table) {
            $table->id();
            $table->string('justification');
            $table->string('image');
            $table->string('justification_date');
            $table->string('mois');
            $table->string('annee');
            $table->string('justification_number');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('justifications');
    }
};
