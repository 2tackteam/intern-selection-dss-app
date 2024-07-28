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
        Schema::create('criterias', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Nama Kriteria');
            $table->decimal('weight', 5, 2)->comment('Bobot Kriteria');
            $table->enum('type', ['string', 'number'])->default('string')->comment('Type Kriteria');
            $table->string('relation_attribute')->comment('Atribut Relasi - Kriteria');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('criterias');
    }
};
