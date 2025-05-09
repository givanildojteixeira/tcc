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
        Schema::create('propostas', function (Blueprint $table) {
            $table->id();
            
            // Chaves estrangeiras
            $table->foreignId('id_cliente')->constrained('clientes')->onDelete('cascade');
            $table->foreignId('id_veiculoNovo')->nullable()->constrained('veiculos')->onDelete('set null');
            $table->foreignId('id_veiculoUsado1')->nullable()->constrained('veiculos')->onDelete('set null');
            $table->foreignId('id_veiculoUsado2')->nullable()->constrained('veiculos')->onDelete('set null');
            $table->foreignId('id_veiculoUsado3')->nullable()->constrained('veiculos')->onDelete('set null');
            $table->unsignedBigInteger('id_negociacao')->nullable();
            $table->foreignId('id_usuario')->constrained('users')->onDelete('cascade'); // usuário que criou

            // Aprovadores
            $table->foreignId('id_user_provação_gerencial')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('id_user_provação_finaneira')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('id_user_provação_banco')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('id_user_provação_diretoria')->nullable()->constrained('users')->onDelete('set null');

            // Dados da proposta
            $table->date('data_proposta');
            $table->string('status')->default('Pendente'); // exemplo: Pendente, Aprovada, Recusada

            // Observações
            $table->text('observacao_nota')->nullable();
            $table->text('observacao_interna')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('propostas');
    }
};
