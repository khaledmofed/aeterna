<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    private array $fields = [
        'hero_sections'       => ['stats_json'],
        'architecture_layers' => ['features_json'],
        'tokenomics'          => ['stats_json', 'allocation_json', 'flywheel_steps_json', 'mechanics_json'],
        'roadmap_stages'      => ['milestones_json'],
        'use_cases'           => ['features_json'],
    ];

    public function up(): void
    {
        foreach ($this->fields as $table => $columns) {
            $rows = DB::table($table)->get(['id', ...$columns]);
            foreach ($rows as $row) {
                $updates = [];
                foreach ($columns as $col) {
                    $raw = $row->$col;
                    if ($raw && !$this->isLocaleWrapped($raw)) {
                        $updates[$col] = json_encode(['en' => $raw], JSON_UNESCAPED_UNICODE);
                    }
                }
                if ($updates) {
                    DB::table($table)->where('id', $row->id)->update($updates);
                }
            }
        }
    }

    public function down(): void
    {
        foreach ($this->fields as $table => $columns) {
            $rows = DB::table($table)->get(['id', ...$columns]);
            foreach ($rows as $row) {
                $updates = [];
                foreach ($columns as $col) {
                    $raw = $row->$col;
                    if ($raw && $this->isLocaleWrapped($raw)) {
                        $decoded = json_decode($raw, true);
                        $updates[$col] = $decoded['en'] ?? '[]';
                    }
                }
                if ($updates) {
                    DB::table($table)->where('id', $row->id)->update($updates);
                }
            }
        }
    }

    private function isLocaleWrapped(string $value): bool
    {
        $decoded = json_decode($value, true);
        return is_array($decoded) && array_key_exists('en', $decoded) && !isset($decoded[0]);
    }
};
