<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('negociacoes', function (Blueprint $table) {
            $table->boolean('financeira')->default(true)->after('valor');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('negociacoes', function (Blueprint $table) {
            //
        });
    }
};
