<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foro de programación</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
@livewireScriptConfig
<body class="min-h-screen bg-gradient-to-b from-neutral-950 to-neutral-900 text-white">
    <div class="px-4 border-b border-neutral-800">
        <x-forum.navbar />
    </div>
    
    <div class="mx-auto max-w-4xl px-4 pb-8">
        {{ $slot }}
        @if (session('status'))
        <div class="mx-auto max-w-4xl mt-6 px-4">
            <div class="p-3 rounded bg-emerald-600/10 text-emerald-400">
            {{ session('status') }}
            </div>
        </div>
        @endif

    </div>
</body>
</html>