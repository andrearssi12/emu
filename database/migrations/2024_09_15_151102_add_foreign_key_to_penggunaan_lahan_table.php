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
        Schema::table('penggunaan_lahan', function (Blueprint $table) {
            $table->foreign('kampus_id')
                ->references('id')
                ->on('kampus');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penggunaan_lahan', function (Blueprint $table) {
            $table->dropForeign('kampus_id');
        });
    }
};
