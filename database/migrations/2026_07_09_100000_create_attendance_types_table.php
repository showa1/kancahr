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
        Schema::create('attendance_types', function (Blueprint $table) {
            $table->id();
            $table->string('code', 20)->unique();           // Kode unik: HADIR, TERLAMBAT, ALPA
            $table->string('name', 100);                    // Nama tampilan
            $table->integer('machine_status_code')->nullable(); // Kode raw dari mesin (0, 1, dst)
            $table->string('color', 30)->default('gray');   // Warna badge: emerald, yellow, red, dll.
            $table->boolean('affects_payroll')->default(false); // Mempengaruhi penggajian
            $table->integer('late_tolerance_minutes')->default(0); // Toleransi menit (0 = tidak berlaku)
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
        Schema::dropIfExists('attendance_types');
    }
};
