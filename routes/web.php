<?php   

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;

//Paginas publicas
Route::get('/',[PageController::class,'index'])->name('home');
Route::get('/question/{question}',[QuestionController::class,'show'])->name('question.show');

Route::get('/diag', function () {
    return response()->json([
        'request_scheme' => request()->getScheme(),
        'host'           => request()->getHost(),
        'app_url'        => config('app.url'),
        'home_url'       => url('/'),
    ]);
});

//Paginas protegidas
Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    // crear pregunta
    Route::get('/ask', [QuestionController::class,'create'])->name('questions.create');
    Route::post('/questions', [QuestionController::class,'store'])->name('questions.store');

    // editar/actualizar/eliminar (las haremos en el paso 3 del proyecto)
    Route::delete('/questions/{question}',[QuestionController::class,'destroy'])->name('questions.destroy');
    Route::get('/questions/{question}/edit', [QuestionController::class,'edit'])->name('questions.edit');
    Route::put('/questions/{question}', [QuestionController::class,'update'])->name('questions.update');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

    //Responder preguntas
    Route::post('/answers/{question}',[AnswerController::class,'store'])->name('answers.store');
});




Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


require __DIR__.'/auth.php';
