<nav class="flex items-center justify-between h-16">
                <div>
                    <a href="{{ route('home') }}">
                       <x-forum.logo />
                    </a>
                </div>
                
                <div class="flex gap-4">
                    <a href="#" class="text-sm font-semibold">Foro</a>
                    <a href="#" class="text-sm font-semibold">Blog</a>
                </div>
                
                <div>
                    <a href="{{ route('login') }}" class="text-sm font-semibold">Log in &rarr;</a>
                </div>
 </nav>

<div class="ml-auto flex items-center gap-4">
  @auth
    <span class="text-sm text-slate-600">Hola, {{ auth()->user()->name }}</span>

    <a href="{{ route('questions.create') }}" class="px-3 py-2 rounded bg-indigo-600 text-white hover:bg-indigo-700">
       Preguntar
    </a>

    {{-- logout (POST) --}}
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button class="text-sm text-slate-600 hover:text-slate-900">Salir</button>
    </form>
  @else
    <a href="{{ route('login') }}" class="text-sm text-slate-600 hover:text-slate-900">
      Login →
    </a>
    <a href="{{ route('register') }}" class="text-sm text-slate-600 hover:text-slate-900">
      Registrarse
    </a>
  @endauth
</div>
