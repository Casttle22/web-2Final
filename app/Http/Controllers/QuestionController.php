<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Category;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class QuestionController extends Controller
{
    use AuthorizesRequests;

    public function show(Question $question){

        $question->load('answers','category','user');

        return view('questions.show',[
            'question' => $question,
        ]);
    }

    // 1) Mostrar formulario de creación
    public function create(){
        // categorías para el <select>
        $categories = Category::orderBy('name')->get();

        return view('questions.create', ['categories' => $categories,]);
    }

    // 2) Guardar la pregunta
    public function store(Request $request){
        // Validar
        $data = $request->validate([
            'title'       => ['required','string','max:120'],
            'content'     => ['required','string','max:1900'],
            'category_id' => ['required','exists:categories,id'],
        ]);

        // Crear asociando al usuario logueado
        $data['user_id'] = auth()->id();

        $question = Question::create($data);

        // Redirigir al detalle con mensaje
        return redirect()
            ->route('question.show', $question)
            ->with('status', '¡Tu pregunta fue publicada correctamente!');
    }

    public function update(Request $request, Question $question){
        $this->authorize('update', $question);

        $data = $request->validate([
            'title'       => ['required', 'string', 'max:180'],
            'category_id' => ['required', 'exists:categories,id'],
            'content'     => ['required', 'string', 'max:5000'],
        ]);

        $question->update($data);

        return redirect()
            ->route('question.show', $question)
            ->with('success', '¡Pregunta actualizada!');
    }

    public function edit(Question $question){
        // Solo dueño
        $this->authorize('update', $question);

        $categories = Category::orderBy('name')->get();

        return view('questions.edit', [
            'question'   => $question,
            'categories' => $categories,
        ]);
    }

    public function destroy(Question $question){
        $this->authorize('delete', $question);

        $question->delete();

        return redirect()
            ->route('home')
            ->with('success', '¡Pregunta eliminada!');
    }


}

