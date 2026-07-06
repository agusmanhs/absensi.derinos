<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::table('absensis', function (Blueprint $table) {
        $table->string('foto_masuk')->nullable()->after('lokasi_masuk');
        $table->string('foto_keluar')->nullable()->after('lokasi_keluar');
    });
}

public function down()
{
    Schema::table('absensis', function (Blueprint $table) {
        $table->dropColumn(['foto_masuk', 'foto_keluar']);
    });
}

    /**
     * Reverse the migrations.
     */
};
