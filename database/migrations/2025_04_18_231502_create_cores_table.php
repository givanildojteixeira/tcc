<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('cores', function (Blueprint $table) {
            $table->id();
            $table->string('cor_desc', 50);
            $table->timestamps(); 
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('cores');
    }
    
};
