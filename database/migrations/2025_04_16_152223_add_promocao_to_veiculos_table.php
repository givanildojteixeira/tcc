<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('veiculos', function (Blueprint $table) {
            $table->boolean('promocao')->default(false)->after('ativo');
        });
    }

    public function down()
    {
        Schema::table('veiculos', function (Blueprint $table) {
            $table->dropColumn('promocao');
        });
    }
};
