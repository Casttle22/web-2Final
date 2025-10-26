<?php

return [
    // dónde Vite deja los assets respecto a public/
    'build_path' => 'build',

    // 👇 Laravel 12 + Vite 5/7 suelen escribir el manifest en .vite/manifest.json
    'manifest'   => 'build/.vite/manifest.json',

    // tus entrypoints
    'entrypoints' => [
        'resources/css/app.css',
        'resources/js/app.js',
    ],
];
