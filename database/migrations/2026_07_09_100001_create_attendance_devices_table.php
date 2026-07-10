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
        Schema::create('attendance_devices', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);                        // Nama/label mesin
            $table->string('serial_number', 100)->nullable()->unique(); // Nomor seri mesin
            $table->string('brand', 50)->nullable();            // Brand: ZKTeco, Solution, dll.
            $table->string('model_name', 50)->nullable();       // Model: ZK-F22, F18, dll.
            $table->string('ip_address', 50)->nullable();       // IP Address mesin di LAN/WAN
            $table->string('location', 100)->nullable();        // Lokasi fisik: Lobby, Lantai 2, dll.
            $table->enum('integration_method', ['adms', 'sdk'])->default('adms'); // Metode integrasi
            $table->string('adms_token', 255)->nullable();      // Token webhook untuk metode ADMS
            $table->boolean('is_active')->default(true);
            $table->timestamp('last_sync_at')->nullable();      // Waktu terakhir sync data berhasil
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance_devices');
    }
};
