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
        Schema::create('shifts', function (Blueprint $table) {
            $table->id();
            $table->string('name');                          // Nama Shift (Pagi 1, Sore 2, dst.)
            $table->string('code')->unique();                // Shift Kode (singkat, unik)
            $table->string('alias')->nullable();             // Nama Lain Shift
            $table->time('start_time');                      // Jam Awal Shift
            $table->time('end_time');                        // Jam Akhir Shift
            $table->boolean('cross_midnight')->default(false); // Beda Tanggal Masuk/Pulang
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shifts');
    }
};
