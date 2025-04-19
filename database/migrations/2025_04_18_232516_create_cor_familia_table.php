<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('cor_familia', function (Blueprint $table) {
            $table->id();
            $table->foreignId('familia_id')->constrained('familias')->onDelete('cascade');
            $table->foreignId('cor_id')->constrained('cores')->onDelete('cascade');
            $table->timestamps(); 
        });

        // onDelete('cascade'): se uma família ou cor for deletada, o relacionamento também será. 
        // O nome da tabela intermediária (cor_familia) segue a convenção ordem alfabética de nomes dos modelos (ex: cor_familia, e não familia_cor)

    }

    public function down()
    {
        Schema::dropIfExists('cor_familia');
    }

};
