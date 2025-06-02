<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('propostas', function (Blueprint $table) {
            $table->date('dta_faturamento')->nullable()->after('data_proposta');
        });
    }

    public function down(): void
    {
        Schema::table('propostas', function (Blueprint $table) {
            $table->dropColumn('dta_faturamento');
        });
    }
};
