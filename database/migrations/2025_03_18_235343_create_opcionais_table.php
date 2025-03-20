<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('opcionais', function (Blueprint $table) {
            $table->id();

            $table->string('modelo_fab');
            $table->string('cod_opcional');
            $table->string('descricao');

            //criação dos dados de dadas de criação e update
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('opcionais');
    }
};
