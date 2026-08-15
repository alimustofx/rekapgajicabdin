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
        Schema::create('revision_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('period_id')->constrained('salary_periods')->cascadeOnDelete();
            $table->foreignId('school_id')->constrained('schools')->cascadeOnDelete();
            $table->string('type');
            $table->foreignId('salary_document_id')->constrained('salary_documents')->cascadeOnDelete();
            $table->string('category');
            $table->text('description');
            $table->string('status')->default('OPEN'); // OPEN / RESOLVED
            $table->foreignId('created_by')->constrained('users');
            $table->timestamp('resolved_at')->nullable();
            $table->foreignId('resolved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('revision_requests');
    }
};
