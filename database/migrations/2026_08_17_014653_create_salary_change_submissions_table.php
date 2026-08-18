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
        Schema::create('salary_change_submissions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('period_id')
                ->constrained('salary_periods')
                ->cascadeOnDelete();

            $table->foreignId('school_id')
                ->constrained('schools')
                ->cascadeOnDelete();

            $table->string('type');

            $table->string('status')
                ->default('SUBMITTED');

            $table->foreignId('submitted_by')
                ->constrained('users');

            $table->timestamp('submitted_at')
                ->nullable();

            $table->foreignId('processed_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('processed_at')
                ->nullable();

            $table->timestamps();

            $table->unique([
                'period_id',
                'school_id',
                'type'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salary_change_submissions');
    }
};
