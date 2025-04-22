<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->string('telefone_comercial', 20)->nullable()->after('telefone');

            $table->string('numero', 10)->nullable()->after('endereco');
            $table->string('complemento')->nullable()->after('numero');


            $table->string('razao_social')->nullable()->after('data_fundacao');
            $table->string('nome_fantasia')->nullable()->after('razao_social');
            $table->string('inscricao_estadual')->nullable()->after('nome_fantasia');
            $table->string('inscricao_municipal')->nullable()->after('inscricao_estadual');

            $table->boolean('ativo')->default(true)->after('inscricao_municipal');
            $table->text('observacoes')->nullable()->after('ativo');
        });
    }

    public function down(): void
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->dropColumn([
                'telefone_comercial',
                'numero',
                'complemento',
                'sexo',
                'estado_civil',
                'data_nascimento',
                'data_fundacao',
                'razao_social',
                'nome_fantasia',
                'inscricao_estadual',
                'inscricao_municipal',
                'ativo',
                'observacoes',
                'user_id',
            ]);
        });
    }
};
