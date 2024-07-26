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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('full_name')->comment('Nama Lengkap');
            $table->string('birth_place')->comment('Tempat Lahir');
            $table->date('birth_date')->comment('Tanggal Lahir');
            $table->enum('gender', ['M', 'F'])->comment('Jenis Kelamin');
            $table->enum('status', \App\Enums\ApplicationStatusEnum::toArray())
                ->default(\App\Enums\ApplicationStatusEnum::DRAFT->value)
                ->comment('Status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicants');
    }
};
