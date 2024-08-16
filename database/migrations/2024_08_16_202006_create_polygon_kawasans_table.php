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
        Schema::create('polygon_kawasan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_kampus');
            $table->unsignedBigInteger('id_kategori');
            $table->longText('geom');
            $table->decimal('luas', 10, 2);
            $table->text('deskripsi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('polygon_kawasan');
    }
};
