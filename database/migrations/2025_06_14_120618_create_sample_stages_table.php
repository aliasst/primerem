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
        Schema::create('sample_stages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('sample_stage_id')->constrained('sample_stages')->nullable();
            $table->integer('sort');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sample_stages');
    }
};
