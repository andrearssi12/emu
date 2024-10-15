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
        Schema::table('laporan', function (Blueprint $table) {
            $table->foreign('kampus_id')
                ->references('id')
                ->on('kampus');
            $table->foreign('kawasan_hijau_id')
                ->references('id')
                ->on('kawasan_hijau');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('laporan', function (Blueprint $table) {
            $table->dropForeign('kampus_id');
            $table->dropForeign('kawasan_hijau_id');
        });
    }
};
