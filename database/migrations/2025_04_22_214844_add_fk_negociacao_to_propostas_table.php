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
        Schema::table('propostas', function (Blueprint $table) {
            $table->foreign('id_negociacao')
                  ->references('id')
                  ->on('negociacoes')
                  ->onDelete('set null');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('propostas', function (Blueprint $table) {
            $table->dropForeign(['id_negociacao']);
        });
    }
};
