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
        Schema::create('contractors', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('stage_id')->constrained('stages')->nullable();
            $table->integer('sort')->nullable();
            $table->unsignedBigInteger('project_id')->constrained('projects');
            $table->unsignedBigInteger('user_id')->constrained('users');
            $table->text('comments')->nullable();
            $table->string('start_date')->nullable();
            $table->string('finish_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contractors');
    }
};
