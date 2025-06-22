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
        Schema::create('stage_files', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->constrained('users');
            $table->integer('project_id')->constrained('projects')->onDelete('cascade');
            $table->integer('stage_id')->constrained('stages')->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('file_path')->nullable();
            $table->string('storage_path')->nullable();
            $table->string('mime_type')->nullable();
            $table->string('extension')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stage_files');
    }
};
