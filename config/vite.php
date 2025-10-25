<?php

return [
    // Archivo que Laravel usa para detectar el dev server (opcional)
    'hot_file' => env('VITE_HOT_FILE', storage_path('framework/vite.hot')),

    // ¡Clave importante! Debe coincidir con la carpeta donde Vite dejó el manifest
    'build_path' => 'build/.vite',

    // Si usas dev server en local
    'dev_server' => [
        'url' => env('VITE_DEV_SERVER_URL'),
    ],
];
