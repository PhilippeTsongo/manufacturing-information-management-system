<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::table('emballage_casses', function (Blueprint $table) {
            $table->integer('quantity');
        });
    }

   
    public function down()
    {
        Schema::table('emballage_casses', function (Blueprint $table) {
            //
        });
    }
};
