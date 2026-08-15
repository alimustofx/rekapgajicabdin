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
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('period_id')
                ->constrained('salary_periods')
                ->cascadeOnDelete();

            $table->foreignId('school_id')
                ->constrained('schools')
                ->cascadeOnDelete();

            $table->string('status')->default('REQUIRED');
            // REQUIRED / UPLOADED / APPROVED / REVISION

            $table->foreignId('current_file_id')->nullable();
            $table->timestamp('uploaded_at')->nullable();
            $table->timestamp('approved_at')->nullable();

            $table->foreignId('approved_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->text('revision_notes')->nullable();
            $table->timestamps();

            $table->unique(['period_id', 'school_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payrolls');
    }
};
