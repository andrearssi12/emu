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
        Schema::disableForeignKeyConstraints();

        Schema::create('maps_point', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('polygon_id')->index();
            $table->foreign('polygon_id')->references('id')->on('maps_polygon');
            $table->string('name');
            $table->decimal('lat');
            $table->decimal('long');
            $table->string('type');
            $table->string('condition');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maps_point');
    }
};
