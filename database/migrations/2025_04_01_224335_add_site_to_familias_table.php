<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('familias', function (Blueprint $table) {
            $table->string('site', 200)->nullable();
        });
    }

    public function down()
    {
        Schema::table('familias', function (Blueprint $table) {
            $table->dropColumn('site');
        });
    }
};
