<?php

use App\Http\Controllers\{MainController, ProfileController, AuthController, DepartmentController};
use App\Http\Middleware\ValidatePassword;
use App\Models\User;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\{Mail, Route};

// Rota para testar o envio de e-mail
Route::get('/teste-email', function () {
    try {
        Mail::raw('Teste de envio de e-mail', function(Message $message) {
            $message->to('teste@teste.com')
                    ->subject('Isso é um teste de envio')
                    ->from(env('MAIL_FROM_ADDRESS'));
        });
        return "E-mail enviado com sucesso!";
    } catch (\Exception $e) {
        return $e->getMessage();
    }
});

Route::controller(MainController::class)->middleware('auth')->group(function() {
    Route::get('/', 'index')->name('home');

    Route::controller(ProfileController::class)->group(function() {
        Route::get('/user/perfil', 'index')->name('user.perfil');
        Route::post('/user/alterar-senha', 'updatePassword')->name('user.alterar-senha')->middleware(ValidatePassword::class);
        Route::post('/user/alterar-dados', 'updateData')->name('user.alterar-dados');
    });

    Route::controller(DepartmentController::class)->group(function() {
        Route::get('/departamento', 'index')->name('departamento');
    });
});

Route::fallback(function() {
    return redirect('/');
});
