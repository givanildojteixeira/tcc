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
        Schema::create('veiculos', function (Blueprint $table) {
            $table->id();
            //Criação dos dados
            $table->string('chassi');
            $table->string('novo_usado');
            $table->string('marca');
            $table->string('familia');
            $table->string('desc_veiculo');
            $table->string('modelo_fab');
            $table->string('cor');
            $table->string('cod_opcional');
            $table->string('combustivel');
            $table->string('Ano_Mod');
            $table->string('motor');
            $table->string('portas');
            $table->decimal('vlr_tabela', 10, 2);
            $table->decimal('vlr_bonus', 10, 2);
            $table->decimal('vlr_nota', 10, 2);
            $table->string('local');
            $table->date('dta_faturamento');
            $table->string('user_reserva');
            $table->string('desc_nota');

            //criação dos dados de dadas de criação e update
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('veiculos');
    }
};
