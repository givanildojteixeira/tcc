<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up()
{
    Schema::table('veiculos', function (Blueprint $table) {
        $table->boolean('ativo')->default(true)->after('id'); // ou onde achar melhor
    });
}

public function down()
{
    Schema::table('veiculos', function (Blueprint $table) {
        $table->dropColumn('ativo');
    });
}

};
