<?php

use App\Models\Matiere;
use App\Models\ProductionProvisoire;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up()
    {
        Schema::create('matiere_production_provisoire', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Matiere::class);
            $table->foreignIdFor(ProductionProvisoire::class);
            $table->string('matiere_quantity');
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('matiere_production_provisoire');
    }
};
