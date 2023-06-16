<?php

use App\Models\Client;
use App\Models\Production;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create('bonuses', function (Blueprint $table) {
            $table->id();
            $table->integer('price');
            $table->integer('quantity');
            $table->foreignIdFor(Production::class);
            $table->string('date_bonus');
            $table->string('mois');
            $table->string('annee');
            $table->string('bonus_number');
            $table->foreignIdFor(Client::class);
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('bonuses');
    }
};
