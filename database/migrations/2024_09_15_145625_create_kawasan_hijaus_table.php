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
        Schema::create('kawasan_hijau', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kawasan');
            $table->unsignedBigInteger('kampus_id');
            $table->longText('geom');
            $table->decimal('luas', 10, 2);
            $table->string('jenis_vegetasi');
            $table->string('foto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kawasan_hijau');
    }
};
