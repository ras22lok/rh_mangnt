<?php

use App\Http\Controllers\{MainController, ProfileController, AuthController, ConfirmAccountController, DepartmentController, RhUserController};
use App\Http\Middleware\{ValidateColaborator, ValidateCreateDepartment, ValidatePassword};
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

Route::controller(ConfirmAccountController::class)->middleware('guest')->group(function() {
    Route::get('/confirmacao-conta/{token}', 'confirmAccount')->name('confirmar-conta');
    Route::post('/confirmacao-conta', 'confirmAccountSubmit')->name('confirmar-conta-db');

    
});

Route::controller(MainController::class)->middleware('auth')->group(function() {
    Route::get('/', 'index')->name('home');
    Route::controller(ProfileController::class)->group(function() {
        Route::get('/user/perfil', 'index')->name('user.perfil');
        Route::post('/user/alterar-senha', 'updatePassword')->name('user.alterar-senha')->middleware(ValidatePassword::class);
        Route::post('/user/alterar-dados', 'updateData')->name('user.alterar-dados');
    });

    Route::controller(DepartmentController::class)->group(function() {
        Route::get('/departamento/listar', 'index')->name('departamento.listar');
        Route::get('/departamento/criar', 'create')->name('departamento.criar');
        Route::post('/departamento/criar', 'store')->name('departamento.criar-db')->middleware(ValidateCreateDepartment::class);
        Route::get('/departamento/editar/{id}', 'editar')->name('departamento.editar');
        Route::post('/departamento/editar', 'update')->name('departamento.editar-db')->middleware(ValidateCreateDepartment::class);
        Route::get('/departamento/confirmar-remocao/{id}', 'remover')->name('departamento.confirmar-remocao');
        Route::get('/departamento/remover/{id}', 'delete')->name('departamento.remover');
    });

    Route::controller(RhUserController::class)->group(function() {
        Route::get('/recursos-humanos/listar', 'index')->name('recursos-humanos.listar');
        Route::get('/recursos-humanos/criar', 'create')->name('recursos-humanos.criar');
        Route::post('/recursos-humanos/criar', 'store')->name('recursos-humanos.criar-db')->middleware(ValidateColaborator::class);
        Route::get('/recursos-humanos/editar/{id}', 'editar')->name('recursos-humanos.editar');
        Route::post('/recursos-humanos/editar', 'update')->name('recursos-humanos.editar-db')->middleware(ValidateColaborator::class);
        Route::get('/recursos-humanos/confirmar-remocao/{id}', 'remover')->name('recursos-humanos.confirmar-remocao');
        Route::get('/recursos-humanos/remover/{id}', 'delete')->name('recursos-humanos.remover');
    });
});

Route::fallback(function() {
    return redirect('/');
});
