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
    Schema::create('ground_stations', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('location');
        $table->string('country')->nullable();
        $table->string('latitude');
        $table->string('longitude');
        $table->integer('elevation')->nullable(); // Sudah ada di sini
        $table->string('status')->default('active'); // Sudah ada di sini
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ground_stations');
    }
};
