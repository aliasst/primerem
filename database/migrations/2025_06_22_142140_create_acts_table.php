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
        Schema::create('acts', function (Blueprint $table) {
            $table->id()->from(1001);
            $table->unsignedBigInteger('user_id')->index()->constrained('users');
            $table->unsignedBigInteger('project_id')->constrained('projects')->default(0);
            $table->string('act_number')->nullable();
            $table->string('status')->nullable()->default('status_1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acts');
    }
};
