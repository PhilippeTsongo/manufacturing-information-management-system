<?php

use App\Models\Production;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{

    public function up()
    {
        Schema::create('production_emballage_quantities', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Production::class);
            $table->integer('emballage_quantity');
            $table->string('number');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('production_emballage_quantities');
    }
};
