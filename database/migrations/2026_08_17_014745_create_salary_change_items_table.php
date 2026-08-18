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
        Schema::create('salary_change_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('submission_id')
                ->constrained('salary_change_submissions')
                ->cascadeOnDelete();

            $table->string('nama');
            $table->string('nip');

            $table->string('gol_baru')->nullable();
            $table->string('istri_suami_baru')->nullable();
            $table->string('anak_baru')->nullable();
            $table->string('gaji_pokok_baru')->nullable();
            $table->string('tunj_struktural_baru')->nullable();
            $table->string('tunj_fungsional_baru')->nullable();
            $table->string('masa_kerja_baru')->nullable();

            $table->string('gol_lama')->nullable();
            $table->string('istri_suami_lama')->nullable();
            $table->string('anak_lama')->nullable();
            $table->string('gaji_pokok_lama')->nullable();
            $table->string('tunj_struktural_lama')->nullable();
            $table->string('tunj_fungsional_lama')->nullable();
            $table->string('masa_kerja_lama')->nullable();

            $table->string('kategori');

            $table->string('file_path');
            $table->string('file_name');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salary_change_items');
    }
};
