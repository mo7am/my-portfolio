<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Translatable columns per table.
     *
     * @var array<string, list<string>>
     */
    private array $map = [
        'users' => [
            'first_name',
            'second_name',
            'third_name',
            'address',
            'nationality',
            'objective',
            'job_title',
            'job_description',
        ],
        'experiences' => ['title', 'company', 'location', 'description'],
        'educationals' => ['educational', 'institution', 'degree', 'field', 'location'],
        'skills' => ['skill', 'level'],
        'languages' => ['language', 'description'],
        'projects' => ['title', 'role', 'description', 'tags', 'other'],
        'project_works' => ['project_work'],
        'awards' => ['title', 'issuer', 'description'],
        'certifications' => ['title', 'issuer'],
        'courses' => ['title', 'provider', 'description'],
        'volunteerings' => ['organization', 'role', 'description'],
        'cv_references' => ['name', 'position', 'company'],
        'websites' => ['name'],
    ];

    public function up(): void
    {
        foreach ($this->map as $table => $columns) {
            if (! Schema::hasTable($table)) {
                continue;
            }

            foreach ($columns as $column) {
                if (! Schema::hasColumn($table, $column)) {
                    continue;
                }

                $this->convertColumnToJson($table, $column);
            }
        }
    }

    public function down(): void
    {
        foreach ($this->map as $table => $columns) {
            if (! Schema::hasTable($table)) {
                continue;
            }

            foreach ($columns as $column) {
                if (! Schema::hasColumn($table, $column)) {
                    continue;
                }

                $this->convertColumnToText($table, $column);
            }
        }
    }

    private function convertColumnToJson(string $table, string $column): void
    {
        $driver = Schema::getConnection()->getDriverName();

        $rows = DB::table($table)->select('id', $column)->get();

        foreach ($rows as $row) {
            $value = $row->{$column};
            $encoded = $this->wrapAsLocaleJson($value, $column);

            DB::table($table)->where('id', $row->id)->update([
                $column => $encoded,
            ]);
        }

        if ($driver === 'mysql') {
            DB::statement("ALTER TABLE `{$table}` MODIFY `{$column}` JSON NULL");
        } else {
            Schema::table($table, function (Blueprint $blueprint) use ($column) {
                $blueprint->json($column)->nullable()->change();
            });
        }
    }

    private function convertColumnToText(string $table, string $column): void
    {
        $rows = DB::table($table)->select('id', $column)->get();

        foreach ($rows as $row) {
            $plain = $this->unwrapLocaleJson($row->{$column}, $column);

            DB::table($table)->where('id', $row->id)->update([
                $column => is_array($plain) ? json_encode($plain, JSON_UNESCAPED_UNICODE) : $plain,
            ]);
        }

        $driver = Schema::getConnection()->getDriverName();

        if ($driver === 'mysql') {
            $type = in_array($column, ['description', 'objective', 'job_description', 'other'], true)
                ? 'TEXT'
                : 'VARCHAR(255)';
            DB::statement("ALTER TABLE `{$table}` MODIFY `{$column}` {$type} NULL");
        }
    }

    private function wrapAsLocaleJson(mixed $value, string $column): ?string
    {
        if ($value === null || $value === '') {
            return null;
        }

        if (is_string($value)) {
            $decoded = json_decode($value, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                // Already locale map {"en":...} or legacy tags list.
                if ($column === 'tags' && array_is_list($decoded)) {
                    return json_encode(['en' => $decoded], JSON_UNESCAPED_UNICODE);
                }

                if (! array_is_list($decoded)) {
                    return json_encode($decoded, JSON_UNESCAPED_UNICODE);
                }
            }

            // Existing monolingual content → English key only (Arabic stays empty until filled).
            return json_encode(['en' => $value], JSON_UNESCAPED_UNICODE);
        }

        return json_encode(['en' => $value], JSON_UNESCAPED_UNICODE);
    }

    private function unwrapLocaleJson(mixed $value, string $column): mixed
    {
        if ($value === null || $value === '') {
            return null;
        }

        $decoded = is_string($value) ? json_decode($value, true) : $value;

        if (! is_array($decoded)) {
            return $value;
        }

        if ($column === 'tags') {
            return $decoded['en'] ?? $decoded['ar'] ?? [];
        }

        return $decoded['en'] ?? $decoded['ar'] ?? null;
    }
};
