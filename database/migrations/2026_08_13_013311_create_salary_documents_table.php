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
        Schema::create('salary_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('import_id')
                ->constrained('salary_imports')
                ->cascadeOnDelete();
            $table->foreignId('school_id')
                ->nullable()
                ->constrained('schools')
                ->nullOnDelete();
            $table->string('type');
            $table->string('filename');
            $table->string('file_path');
            $table->unsignedInteger('version')->default(1);
            $table->boolean('is_current')->default(true);
            $table->boolean('is_matched')->default(true);
            $table->foreignId('uploaded_by')
                ->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salary_documents');
    }
};
