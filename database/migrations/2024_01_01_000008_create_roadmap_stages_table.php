<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('roadmap_stages', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('stage_number');
            $table->string('name', 100);
            $table->string('timeframe', 100)->nullable();
            $table->enum('status', ['completed', 'active', 'upcoming'])->default('upcoming');
            $table->json('milestones_json')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('roadmap_stages');
    }
};
