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
        Schema::create('salary_imports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('period_id')
                ->constrained('salary_periods')
                ->cascadeOnDelete();
            $table->string('type'); // PNS / PPPK
            $table->string('zip_filename');
            $table->string('zip_path');
            $table->foreignId('uploaded_by')
                ->constrained('users');
            $table->string('status')->default('PROCESSING');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salary_imports');
    }
};
