<x-forum.layouts.app>
  <div class="max-w-3xl mx-auto mt-10 space-y-6">
    {{-- Mensaje flash --}}
    @if (session('status'))
      <div class="p-3 rounded bg-emerald-600/10 text-emerald-600">
        {{ session('status') }}
      </div>
    @endif

    <h1 class="text-2xl font-semibold">Nueva pregunta</h1>

    <form action="{{ route('questions.store') }}" method="POST" class="space-y-4">
      @csrf

      <div>
        <label class="block mb-1 text-sm">Título *</label>
        <input type="text" name="title" value="{{ old('title') }}"
               class="w-full rounded border border-neutral-700 bg-neutral-900 px-3 py-2"
               required maxlength="120">
        @error('title')
          <p class="mt-1 text-sm text-rose-500">{{ $message }}</p>
        @enderror
      </div>

      <div>
        <label class="block mb-1 text-sm">Categoría *</label>
        <select name="category_id"
                class="w-full rounded border border-neutral-700 bg-neutral-900 px-3 py-2" required>
          <option value="">— Selecciona —</option>
          @foreach ($categories as $cat)
            <option value="{{ $cat->id }}" @selected(old('category_id')==$cat->id)>
              {{ $cat->name }}
            </option>
          @endforeach
        </select>
        @error('category_id')
          <p class="mt-1 text-sm text-rose-500">{{ $message }}</p>
        @enderror
      </div>

      <div>
        <label class="block mb-1 text-sm">Contenido *</label>
        <textarea name="content" rows="7"
                  class="w-full rounded border border-neutral-700 bg-neutral-900 px-3 py-2"
                  required maxlength="1900">{{ old('content') }}</textarea>
        @error('content')
          <p class="mt-1 text-sm text-rose-500">{{ $message }}</p>
        @enderror
      </div>

      <div class="flex items-center gap-3">
        <button class="px-4 py-2 rounded bg-indigo-600 text-white hover:bg-indigo-700">
          Publicar
        </button>
        <a href="{{ route('home') }}" class="text-sm hover:underline">Cancelar</a>
      </div>
    </form>
  </div>
</x-forum.layouts.app>
