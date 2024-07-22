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
        Schema::create('educations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('applicant_id')->constrained('applicants')->cascadeOnDelete();
            $table->enum('education_level', ['SMA/SMK', 'D1', 'D2', 'D3', 'D4', 'S1']);
            $table->string('institution_name')->comment('Nama Instansi / Pendidikan');
            $table->string('major')->comment('Jurusan / Program Studi');
            $table->year('start_year')->comment('Tahun Mulai Ajaran / Pendidikan');
            $table->year('end_year')->comment('Tahun Lulus Ajaran / Pendidikan');
            $table->decimal('gpa', 3, 2)->comment('IPK atau nilai rata-rata');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education');
    }
};
