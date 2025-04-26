<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\{RedirectResponse, Request};
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(): View {
        return view('user.profile');
    }

    public function updatePassword(Request $request): RedirectResponse {
        if (!password_verify($request->current_password, auth()->user()->password)) {
            return redirect()->back()->with(['server_error' => 'A senha atual informada é inválida']);
        }
        try {
            User::where('id', auth()->user()->id)->update(['password' => bcrypt($request->new_password)]);
            auth()->user()->password = bcrypt($request->new_password);
            return redirect()->back()->with(['server_success' => 'Senha alterada com sucesso!']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['server_error' => 'Erro ao alterar a senha']);
        }
    }

    public function updateData(Request $request) {
        $request->validate([
            'name' => 'required',
        ]);
        $verificar = array('name');
        $dados = $request->toArray();
        unset($request);
        foreach($dados as $key => $value) {
            if (isset(auth()->user()->{$key}) AND $value != '' AND auth()->user()->{$key} == $value) {
                unset($dados[$key]);
            }
            if (!in_array($key, $verificar)) {
                unset($dados[$key]);
            }
        }
        unset($dados['_token'], $dados['email'], $dados['email_verified_at']);
        try {
            if(!empty($dados)) {
                User::where('id', auth()->user()->id)->update($dados);
                return redirect()->back()->with(['server_success_data' => 'Dados atualizados com sucesso!']);
            }
            return redirect()->back()->with(['server_success_data' => 'Não há dados para atualizar.']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['server_error_data' => 'Erro ao atualizar os dados!']);
        }
    }
}
