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
        Schema::create('sub_criterias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('criteria_id')->constrained('criterias');
            $table->string('name')->comment('Nama Sub Kriteria');
            $table->decimal('weight', 5, 2)->comment('Bobot Kriteria');
            $table->decimal('min_value', 5, 2)->comment('Nilai Minimum Sub Kriteria')->nullable();
            $table->decimal('max_value', 5, 2)->comment('Nilai Maximum Sub Kriteria')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_criterias');
    }
};
