<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('opcionais', function (Blueprint $table) {
            $table->string('chassi')->nullable()->after('cod_opcional');
        });
    }

    public function down()
    {
        Schema::table('opcionais', function (Blueprint $table) {
            $table->dropColumn('chassi');
        });
    }
};
