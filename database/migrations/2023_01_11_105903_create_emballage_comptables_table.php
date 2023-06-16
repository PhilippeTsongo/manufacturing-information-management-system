<?php

use App\Models\Unit;
use App\Models\Emballage;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create('emballage_comptables', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('quantity');
            $table->foreignIdFor(Unit::class);
            $table->string('mois');
            $table->integer('annee');
            $table->double('purchase_price');
            $table->string('date_emballage');
            $table->string('emballage_number');
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('emballage_comptables');
    }
};
