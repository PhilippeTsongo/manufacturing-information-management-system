<?php

use App\Models\Emballage;
use App\Models\Production;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('emballage_productions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Emballage::class);
            $table->foreignIdFor(Production::class);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('emballage_productions');
    }
};
