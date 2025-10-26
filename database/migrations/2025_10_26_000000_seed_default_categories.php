<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        // Ajusta/añade las categorías que quieras
        $names = [
            'Laravel',
            'PHP',
            'JavaScript',
            'HTML & CSS',
            'Bases de datos',
            'DevOps',
            'Docker',
            'Testing',
            'Otros',
        ];

        $rows = collect($names)->map(fn ($name) => [
            'name'       => $name,
            'slug'       => Str::slug($name),
            'created_at' => now(),
            'updated_at' => now(),
        ])->all();

        // Evita duplicados si la migración corre más de una vez
        DB::table('categories')->upsert($rows, ['slug'], ['name', 'updated_at']);
    }

    public function down(): void
    {
        DB::table('categories')->whereIn('slug', [
            'laravel','php','javascript','html-css','bases-de-datos','devops','docker','testing','otros',
        ])->delete();
    }
};
