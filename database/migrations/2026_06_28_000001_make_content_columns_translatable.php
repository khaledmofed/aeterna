<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    private array $tables = [
        'hero_sections'       => ['badge_text', 'headline', 'subheadline', 'cta_primary_text', 'cta_secondary_text', 'email_placeholder', 'email_cta'],
        'solutions'           => ['challenge', 'current_state', 'aeterna_solution'],
        'architecture_layers' => ['name', 'description'],
        'tokenomics'          => ['section_badge', 'section_title', 'section_subtitle'],
        'roadmap_stages'      => ['name', 'timeframe'],
        'use_cases'           => ['title', 'description'],
        'footer_links'        => ['group_name', 'label'],
        'nav_items'           => ['label'],
        'explorer_pages'      => ['title', 'description', 'tag'],
    ];

    public function up(): void
    {
        foreach ($this->tables as $table => $columns) {
            Schema::table($table, function (Blueprint $t) use ($columns) {
                foreach ($columns as $col) {
                    $t->text($col)->nullable()->change();
                }
            });
        }

        foreach ($this->tables as $table => $columns) {
            foreach (DB::table($table)->get() as $row) {
                $update = [];
                foreach ($columns as $col) {
                    $val = $row->{$col};
                    if ($val !== null && !$this->isJson($val)) {
                        $update[$col] = json_encode(['en' => $val], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                    }
                }
                if (!empty($update)) {
                    DB::table($table)->where('id', $row->id)->update($update);
                }
            }
        }
    }

    public function down(): void
    {
        foreach ($this->tables as $table => $columns) {
            foreach (DB::table($table)->get() as $row) {
                $update = [];
                foreach ($columns as $col) {
                    $val = $row->{$col};
                    if ($val !== null && $this->isJson($val)) {
                        $decoded = json_decode($val, true);
                        $update[$col] = $decoded['en'] ?? null;
                    }
                }
                if (!empty($update)) {
                    DB::table($table)->where('id', $row->id)->update($update);
                }
            }
        }
    }

    private function isJson(string $value): bool
    {
        if (!str_starts_with(trim($value), '{')) {
            return false;
        }
        json_decode($value);
        return json_last_error() === JSON_ERROR_NONE;
    }
};
