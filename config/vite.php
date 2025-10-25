<?php

return [
    // Laravel buscará aquí en producción:
    'manifest' => base_path('public/build/manifest.json'),

    // no toques esto salvo que hayas cambiado el directorio del build
    'build_path' => 'build',

    // (opcional) si usas dev server local
    'dev_server' => [
        'url' => env('VITE_DEV_SERVER_URL'),
    ],
];
