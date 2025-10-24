<?php

namespace App\Policies;

use App\Models\Question;
use App\Models\User;

class QuestionPolicy
{
    /**
     * Cualquiera puede ver preguntas públicas.
     */
    public function view(?User $user, Question $question): bool
    {
        return true;
    }

    /**
     * Crear pregunta: requiere estar autenticado.
     */
    public function create(User $user): bool
    {
        return $user !== null;
    }

    /**
     * Actualizar: sólo el dueño.
     */
    public function update(User $user, Question $question): bool
    {
        return $user->id === $question->user_id;
    }

    /**
     * Eliminar: sólo el dueño.
     */
    public function delete(User $user, Question $question): bool
    {
        return $user->id === $question->user_id;
    }

    // (Opcionales para a futuro)
    public function restore(User $user, Question $question): bool
    {
        return $user->id === $question->user_id;
    }

    public function forceDelete(User $user, Question $question): bool
    {
        return $user->id === $question->user_id;
    }
}
