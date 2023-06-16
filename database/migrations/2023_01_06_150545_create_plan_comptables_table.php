<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('plan_comptables', function (Blueprint $table) {
            $table->id();
            $table->float('account_number');
            $table->string('account_name');
            $table->timestamps();
        });
    }

   
    public function down()
    {
        Schema::dropIfExists('plan_comptables');
    }
};
