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
        Schema::create('salary_statuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('period_id')
                ->constrained('salary_periods')
                ->cascadeOnDelete();
            $table->foreignId('school_id')
                ->constrained('schools')
                ->cascadeOnDelete();
            $table->string('type');
            $table->string('status')->default('WAITING_VERIFICATION');
            $table->foreignId('current_document_id')
                ->nullable()
                ->constrained('salary_documents')
                ->nullOnDelete();
            $table->timestamp('fixed_at')->nullable();
            $table->foreignId('fixed_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
            $table->timestamps();

            $table->unique(['period_id', 'school_id', 'type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salary_statuses');
    }
};
