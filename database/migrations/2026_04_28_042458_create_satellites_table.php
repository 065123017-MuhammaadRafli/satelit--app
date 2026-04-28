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
    Schema::create('satellites', function (Blueprint $table) {
        $table->id();
        // Menghubungkan satelit ke sebuah Ground Station
        $table->foreignId('ground_station_id')->constrained('ground_stations')->onDelete('cascade');

        $table->string('name');
        $table->string('owner_country');
        $table->date('launch_date');
        $table->enum('orbit_type', ['LEO', 'MEO', 'GEO']);
        $table->text('tle'); // Untuk data koordinat orbit
        $table->boolean('is_active')->default(true);
        $table->text('description')->nullable();
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('satellites');
    }
};
