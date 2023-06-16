<?php

use App\Models\Unit;
use App\Models\Matiere;
use App\Models\Category;
use App\Models\Emballage;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('production_provisoires', function (Blueprint $table) {
            $table->id();
            $table->integer('number');
            $table->foreignIdFor(Category::class);
            $table->integer('quantity');
            $table->integer('sale_price');
            $table->string('mois');
            $table->string('annee');
            $table->string('date_production');
            //$table->foreignIdFor(Matiere::class);
            $table->integer('matiere_quantity');
            $table->foreignIdFor(Emballage::class);
            $table->integer('emballage_quantity');
            $table->foreignIdFor(Unit::class);

            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('production_provisoires');
    }
};
