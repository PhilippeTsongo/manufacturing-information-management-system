<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::table('emballages', function (Blueprint $table) {
            $table->string('date_emballage');
        });
    }

    
    public function down()
    {
        Schema::table('emballages', function (Blueprint $table) {
            //
        });
    }
};
