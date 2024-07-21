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
        Schema::create('applicants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('full_name')->comment('Nama Lengkap');
            $table->string('birth_place')->comment('Tempat Lahir');
            $table->date('birth_date')->comment('Tanggal Lahir');
            $table->enum('gender', ['M', 'F'])->comment('Jenis Kelamin');
            $table->text('address')->comment('Alamat');
            $table->string('phone_number', 20)->comment('Nomor Telepon');
            $table->string('identity_number', 50)->nullable()->comment('Nomor KTP atau kartu identitas lainnya');
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
