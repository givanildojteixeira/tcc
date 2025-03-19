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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            // relacionamento com a tabela de usuarios
            $table->foreignId('user_id')->constrained();
            // criação dos campos necessarios
            $table->string('nome');
            $table->string('tipo_Pessoa');
            $table->string('cpf_cnpj');
            $table->string('email');
            $table->string('celular');
            $table->string('telefone');
            $table->string('telefonecom');
            $table->string('cep');
            $table->string('endereco');
            $table->string('bairro');
            $table->string('cidade');
            $table->string('uf');
            $table->string('sexo');
            $table->string('estado_Civil');
            $table->date('data_fundacao');
            $table->date('data_Nascimento');

            //criação dos dados de dadas de criação e update
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
