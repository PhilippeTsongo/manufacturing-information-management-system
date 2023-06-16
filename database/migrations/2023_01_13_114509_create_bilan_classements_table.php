<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up()
    {
        Schema::create('bilan_classements', function (Blueprint $table) {
            $table->id();
            $table->string('classement_number');
            $table->string('classement');
            $table->timestamps();
        });
    }

   
    public function down()
    {
        Schema::dropIfExists('bilan_classements');
    }
};
