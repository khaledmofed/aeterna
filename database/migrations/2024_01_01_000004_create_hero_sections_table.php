<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('hero_sections', function (Blueprint $table) {
            $table->id();
            $table->string('badge_text', 255)->nullable();
            $table->string('headline', 500)->nullable();
            $table->text('subheadline')->nullable();
            $table->string('cta_primary_text', 100)->nullable();
            $table->string('cta_primary_url', 255)->nullable();
            $table->string('cta_secondary_text', 100)->nullable();
            $table->string('cta_secondary_url', 255)->nullable();
            $table->json('stats_json')->nullable();
            $table->string('email_placeholder', 255)->nullable();
            $table->string('email_cta', 100)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hero_sections');
    }
};
