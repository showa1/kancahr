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
        Schema::create('org_structures', function (Blueprint $table) {
            $table->id();
            $table->string('sk_number')->nullable()->comment('Nomor SK');
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete()->comment('Nama Pegawai');
            $table->foreignId('department_id')->nullable()->constrained()->nullOnDelete()->comment('Unit Kerja');
            $table->foreignId('position_id')->nullable()->constrained()->nullOnDelete()->comment('Jabatan');
            $table->foreignId('reports_to_id')->nullable()->constrained('org_structures')->nullOnDelete()->comment('Bertanggung Jawab Kepada');
            $table->string('acting_role')->nullable()->comment('Pelaksana Kerja');
            $table->integer('formation')->default(1)->comment('Formasi/Kuota');
            $table->integer('sort_order')->default(1)->comment('Urutan');
            $table->date('period_start')->nullable();
            $table->date('period_end')->nullable();
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('org_structures');
    }
};
