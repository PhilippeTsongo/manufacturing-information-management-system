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
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productions', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->integer('quantity');
            $table->integer('sale_price');
            $table->string('mois');
            $table->integer('annee');
            $table->foreignIdFor(Emballage::class);
            //$table->foreignIdFor(Matiere::class);
            $table->foreignIdFor(Category::class);
            $table->foreignIdFor(Unit::class);


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
        Schema::dropIfExists('productions');
    }
};
