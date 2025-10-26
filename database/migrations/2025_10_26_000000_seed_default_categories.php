<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $now = now();

        $rows = collect([
            ['name' => 'Laravel',         'color' => '#F9322C'],
            ['name' => 'PHP',             'color' => '#777BB3'],
            ['name' => 'JavaScript',      'color' => '#F7DF1E'],
            ['name' => 'HTML & CSS',      'color' => '#E34F26'],
            ['name' => 'Bases de datos',  'color' => '#4E9A06'],
            ['name' => 'DevOps',          'color' => '#0EA5E9'],
            ['name' => 'Docker',          'color' => '#2496ED'],
            ['name' => 'Testing',         'color' => '#A855F7'],
            ['name' => 'Otros',           'color' => '#6B7280'],
        ])->map(fn ($r) => $r + [
            'created_at' => $now,
            'updated_at' => $now,
        ])->all();

        // Evita duplicados si esta migración corre más de una vez
        DB::table('categories')->upsert($rows, ['name'], ['color', 'updated_at']);
    }

    public function down(): void
    {
        DB::table('categories')->whereIn('name', [
            'Laravel','PHP','JavaScript','HTML & CSS',
            'Bases de datos','DevOps','Docker','Testing','Otros',
        ])->delete();
    }
};
