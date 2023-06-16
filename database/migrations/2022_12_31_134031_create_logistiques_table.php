<?php

use App\Models\Office;
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
        Schema::create('logistiques', function (Blueprint $table) {
            $table->id();
            $table->string('logistique_number');
            $table->string('name');
            $table->integer('quantity');
            $table->foreignIdFor(Office::class);
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
        Schema::dropIfExists('logistiques');
    }
};
