<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ConfirmAccountController extends Controller
{
    public function confirmAccount($token): View|RedirectResponse {
        $user = User::where('remember_token', $token)->get();
        return (!empty($user)) ? view('auth.confirm-account' ,['token' => $token]) : redirect()->route('home');
    }

    public function confirmAccountSubmit(Request $request): View|RedirectResponse {
        $request->validate([
            'token' => 'required|string|size:60',
            'password' => 'required|confirmed|min:8|max:16|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
        ],[
            'token.required' => 'Token invalido',
            'token.string' => 'Token invalido',
            'token.size' => 'Token invalido',
            'password.required' => 'O campo senha é obrigatório!',
            'password.min' => 'O campo senha deve ter no minimo :min caracteres!',
            'password.max' => 'O campo senha deve ter no maximo :max caracteres!',
            'password.confirmed' => 'O campo senha deve ser igual à confirmação da senha!',
            'password.regex' => 'A senha deve ter no minimo 8 caracteres, no maximo 16 caracteres, ter um caracter maiusculo, 1 minusculo e 1 digito!',
        ]);
        $user = User::where('remember_token', $request->token)->get();
        if(!$user){
            return redirect()->route('home');
        }
        $dados['password'] = bcrypt($request->password);
        $dados['remember_token'] =  NULL;
        $dados['email_verified_at'] =  now();
        $token = $request->token;
        unset($request);
        try {
            User::where('remember_token', $token)->update($dados);
            unset($dados);
            // echo "<pre>";
            // print_r($user);die;
            // return redirect()->route('login')->with(['status' => "Senha cadastrada com sucesso!"]);
            return view('auth.welcome', ['user' => $user]);
        } catch (\Exception $e) {
            return redirect()->route('login')->with(['server_success' => "Erro ao cadastrar a senha!"]);
            // return $e->getMessage();
        }
    }
}
