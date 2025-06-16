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
        Schema::create('stages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('stage_id')->constrained('stages')->nullable();
            $table->integer('sort');
            $table->unsignedBigInteger('project_id')->constrained('projects');
            $table->unsignedBigInteger('user_id')->constrained('users');
            $table->string('start_date')->nullable();
            $table->string('finish_date')->nullable();
            $table->string('status')->nullable()->default('status_0');
            $table->string('status_0')->nullable()->default(null);
            $table->string('status_1')->nullable()->default(null);
            $table->string('status_2')->nullable()->default(null);
            $table->string('status_3')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stages');
    }
};
