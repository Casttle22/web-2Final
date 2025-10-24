<x-forum.layouts.app>
    <div class="max-w-3xl mx-auto py-10">
        <h2 class="text-2xl font-semibold mb-6">Editar pregunta</h2>

        <form method="POST" action="{{ route('questions.update', $question) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm mb-1">Título</label>
                <input type="text" name="title" value="{{ old('title', $question->title) }}"
                       class="w-full rounded border border-slate-700 bg-slate-900/40 px-3 py-2"
                       required maxlength="180">
                @error('title') <p class="text-sm text-rose-400 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm mb-1">Categoría</label>
                <select name="category_id"
                        class="w-full rounded border border-slate-700 bg-slate-900/40 px-3 py-2" required>
                    <option value="">— Selecciona —</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}"
                            @selected(old('category_id', $question->category_id) == $cat->id)>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') <p class="text-sm text-rose-400 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm mb-1">Contenido</label>
                <textarea name="content" rows="8"
                          class="w-full rounded border border-slate-700 bg-slate-900/40 px-3 py-2"
                          required>{{ old('content', $question->content) }}</textarea>
                @error('content') <p class="text-sm text-rose-400 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center gap-3">
                <button class="px-4 py-2 rounded bg-indigo-600 hover:bg-indigo-700 text-white">
                    Guardar cambios
                </button>

                <a href="{{ route('question.show', $question) }}"
                   class="text-slate-400 hover:text-slate-200">Cancelar</a>
            </div>
        </form>
    </div>
</x-forum.layouts.app>
