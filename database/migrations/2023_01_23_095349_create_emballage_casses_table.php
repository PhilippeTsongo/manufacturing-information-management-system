<?php

use App\Models\Emballage;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('emballage_casses', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->foreignIdFor(Emballage::class);
            $table->string('date_emballage_casse');
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
        Schema::dropIfExists('emballage_casses');
    }
};
