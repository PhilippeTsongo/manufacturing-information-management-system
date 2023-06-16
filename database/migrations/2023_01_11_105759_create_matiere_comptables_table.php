<?php

use App\Models\Unit;
use App\Models\Matiere;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matiere_comptables', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->integer('quantity');
            $table->string('mois');
            $table->integer('annee');
            $table->foreignIdFor(Unit::class);
            $table->double('purchase_price');
            $table->string('date_matiere');
            $table->string('matiere_number');
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
        Schema::dropIfExists('matiere_comptables');
    }
};
