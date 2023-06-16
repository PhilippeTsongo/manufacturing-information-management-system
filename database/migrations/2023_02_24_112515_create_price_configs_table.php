<?php

use App\Models\TypeEmballage;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create('price_configs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(TypeEmballage::class);
            $table->integer('quantity_min');
            $table->integer('quantity_max');
            $table->double('price');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('price_configs');
    }
};
