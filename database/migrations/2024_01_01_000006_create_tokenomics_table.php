<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tokenomics', function (Blueprint $table) {
            $table->id();
            $table->string('section_badge', 100)->nullable();
            $table->string('section_title', 500)->nullable();
            $table->text('section_subtitle')->nullable();
            $table->string('token_name', 50)->default('AETHER');
            $table->string('token_ticker', 10)->default('ATA');
            $table->string('token_supply', 100)->nullable();
            $table->string('lp_token_name', 50)->default('AIA');
            $table->text('lp_token_description')->nullable();
            $table->json('allocation_json')->nullable();
            $table->json('stats_json')->nullable();
            $table->json('mechanics_json')->nullable();
            $table->json('flywheel_steps_json')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tokenomics');
    }
};
