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
        Schema::create('negociacoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_proposta')->constrained('propostas')->onDelete('cascade');
            $table->foreignId('id_cond_pagamento')->nullable()->constrained('condicao_pagamentos')->onDelete('set null');

            $table->string('descricao_pagamento')->nullable();
            $table->decimal('valor', 10, 2);
            $table->date('data_vencimento');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('negociacoes
        
        
        ');
    }
};
