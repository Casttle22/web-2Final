<?php

return [
    // dónde Vite deja los assets respecto a public/
    'build_path' => 'build',

    'manifest'   => 'build/.vite/manifest.json',

    // entrypoints
    'entrypoints' => [
        'resources/css/app.css',
        'resources/js/app.js',
    ],
];
