<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('hero_sections')
            ->where('headline', 'Future is Chainless.')
            ->update(['headline' => 'The Future is Chainless.']);
    }

    public function down(): void
    {
        DB::table('hero_sections')
            ->where('headline', 'The Future is Chainless.')
            ->update(['headline' => 'Future is Chainless.']);
    }
};
