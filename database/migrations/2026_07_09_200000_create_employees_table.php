<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();

            // ─── Data Pribadi ───────────────────────────────────────────────
            $table->string('nik')->unique()->comment('Nomor Induk Karyawan');
            $table->enum('identity_type', ['ktp', 'sim', 'passport'])->default('ktp');
            $table->string('identity_number')->nullable();
            $table->string('prefix_title')->nullable()->comment('Gelar Depan');
            $table->string('full_name');
            $table->string('initials', 10)->nullable()->comment('Inisial');
            $table->string('suffix_title')->nullable()->comment('Gelar Belakang');
            $table->string('nickname')->nullable()->comment('Nama Panggilan');
            $table->string('birth_place')->nullable();
            $table->date('birth_date')->nullable();
            $table->enum('gender', ['L', 'P'])->nullable();
            $table->enum('blood_type', ['A', 'B', 'AB', 'O'])->nullable();
            $table->enum('blood_rhesus', ['+', '-'])->nullable();
            $table->enum('religion', ['islam', 'kristen', 'katolik', 'hindu', 'budha', 'konghucu', 'lainnya'])->nullable();
            $table->string('ethnicity')->nullable()->comment('Suku');
            $table->string('nationality')->default('WNI');
            $table->enum('marital_status', ['belum_kawin', 'kawin', 'cerai_hidup', 'cerai_mati'])->nullable();
            $table->string('ptkp_code')->nullable();
            $table->string('tax_code')->nullable();

            // ─── Alamat & Kontak ────────────────────────────────────────────
            $table->text('address')->nullable()->comment('Alamat Tinggal');
            $table->text('ktp_address')->nullable()->comment('Alamat KTP');
            $table->string('province')->nullable();
            $table->string('district')->nullable()->comment('Kabupaten/Kota');
            $table->string('sub_district')->nullable()->comment('Kecamatan');
            $table->string('village')->nullable()->comment('Kelurahan');
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();

            // ─── Data Kepegawaian ───────────────────────────────────────────
            $table->foreignId('department_id')->nullable()->constrained('departments')->nullOnDelete();
            $table->foreignId('position_id')->nullable()->constrained('positions')->nullOnDelete();
            $table->foreignId('employment_status_id')->nullable()->constrained('employment_statuses')->nullOnDelete();
            $table->enum('education', ['sd', 'smp', 'sma', 'd1', 'd2', 'd3', 'd4', 's1', 's2', 's3'])->nullable();
            $table->string('education_major')->nullable()->comment('Jurusan');
            $table->enum('employee_type', ['tetap', 'kontrak', 'magang', 'freelance', 'outsourcing'])->default('tetap');
            $table->string('work_branch')->nullable()->comment('Cabang');
            $table->string('employee_grade')->nullable()->comment('Golongan');
            $table->string('grade')->nullable();
            $table->date('join_date')->nullable()->comment('Tanggal Bergabung');
            $table->date('contract_start_date')->nullable();
            $table->date('contract_end_date')->nullable();
            $table->string('contract_number')->nullable();
            $table->string('contract_file')->nullable();
            $table->text('contract_notes')->nullable();

            // ─── Keuangan & Pajak ───────────────────────────────────────────
            $table->string('npwp', 20)->nullable();
            $table->date('npwp_registration_date')->nullable();
            $table->text('npwp_address')->nullable();
            $table->string('bpjs_health_number')->nullable();
            $table->string('bpjs_employment_number')->nullable();
            $table->date('bpjs_join_date')->nullable();
            $table->date('bpjs_end_date')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_branch')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('bank_account_name')->nullable();
            $table->string('insurance_number')->nullable();
            $table->decimal('basic_salary', 15, 2)->default(0);
            $table->enum('pph21_method', ['gross', 'gross_up', 'netto'])->nullable();

            // ─── Data Tambahan ──────────────────────────────────────────────
            $table->decimal('height_cm', 5, 1)->nullable();
            $table->decimal('weight_kg', 5, 1)->nullable();
            $table->string('house_ownership')->nullable();
            $table->string('language_ability')->nullable();
            $table->text('skills')->nullable()->comment('Keterampilan');
            $table->text('expertise')->nullable()->comment('Keahlian');
            $table->text('interests')->nullable()->comment('Minat');
            $table->text('talents')->nullable()->comment('Bakat');

            // ─── Foto & Status ──────────────────────────────────────────────
            $table->string('photo')->nullable();
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
