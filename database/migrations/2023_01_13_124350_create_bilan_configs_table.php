<?php

use App\Models\PlanComptable;
use App\Models\BilanClassement;
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
        Schema::create('bilan_configs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(PlanComptable::class);
            $table->float('amount');
            $table->foreignIdFor(BilanClassement::class);
            $table->string('mois');
            $table->string('annee');
            $table->string('bilan_config_number');
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
        Schema::dropIfExists('bilan_configs');
    }
};
