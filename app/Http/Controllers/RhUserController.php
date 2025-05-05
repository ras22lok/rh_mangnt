<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmAccountEmail;
use App\Models\{User, Department, UserDetail};
use App\Services\VerifyId;
use Illuminate\Http\{RedirectResponse, Request};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\View\View;

class RhUserController extends Controller
{
    public function index(): View|RedirectResponse {
        return Auth::user()->can('admin') ? view('colaborators.list-rh-users', ['colaborators' => User::where('role', 'rh')->with('detail')->with('department')->get()]) : redirect()->back();
    }

    public function create(): View|RedirectResponse{
        return Auth::user()->can('admin') ? view('colaborators.add-rh-user', ['departments' => Department::select('id', 'name')->where('id', '2')->get()]) : redirect()->back();
    }

    public function store(Request $request): RedirectResponse {
        if (Auth::user()->cannot('admin') ) {
            return redirect()->back();
        }
        $dados = $request->toArray();
        $dados['role'] = 'rh';
        $dados['permissions'] = '["rh"]';
        $dados['password'] = bcrypt('Abc123456');
        // $dados['department_id'] = VerifyId::checkCryptdado($dados['department_id']);
        $dados['department_id'] = 2;
        unset($request, $dados['_token']);
        $permitidos = ['department_id', 'name', 'email', 'permissions', 'role', 'password', 'address', 'zip_code', 'city', 'phone', 'salary', 'admission_date'];
        $verificaDetalhes = ['address', 'zip_code', 'city', 'phone', 'salary', 'admission_date'];
        $detalhes = array();
        foreach($dados as $key => $value) {
            if(!in_array($key, $permitidos)) {
                unset($dados[$key]);
            } elseif(in_array($key, $verificaDetalhes)) {
                $detalhes[$key] = $value;
                unset($dados[$key]);
            }
        }
        unset($key, $value, $permitidos, $verificaDetalhes);
        try {
            $dados['remember_token'] = Str::random(60);
            $user = User::create($dados);
            $detalhes['user_id'] = $user->id;
            UserDetail::create($detalhes);
            Mail::to($user->email)->send(new ConfirmAccountEmail(route('confirmar-conta', $user->remember_token)));
            unset($user, $dados);


            return redirect()->route('recursos-humanos.listar')->with(['server_success' => 'Colaborador criado com sucesso!']);
        } catch (\Exception $e) {
            return redirect()->route('recursos-humanos.listar')->with(['server_error' => 'Erro ao criar o colaborador!']);
            // return redirect()->route('recursos-humanos.listar')->with(['server_error' => $e->getMessage()]);
        }
    }

    public function editar($id): View|RedirectResponse {
        if (Auth::user()->cannot('admin') OR !isset($id)) {
            return redirect()->back();
        }
        $colaborator = User::where('id', VerifyId::checkCryptdado($id))->with('detail')->first();
        $departments = Department::select('id', 'name')->where('id', '2')->get();
        return (!empty($colaborator)) ? view('colaborators.edit-rh-user', compact('colaborator', 'departments')): redirect()->back();
    }

    public function update(Request $request) {
        if (Auth::user()->cannot('admin') OR !isset($request->id)) {
            return redirect()->route('recursos-humanos.listar');
        }
        $dados = $request->toArray();
        $dados['department_id'] = 2;
        unset($request);
        $colaborator = User::where('id', VerifyId::checkCryptdado($dados['id']))->with('detail')->first();
        unset($colaborator->role,$colaborator->permissions);
        if (empty($colaborator)) {
            return redirect()->back()->withInput()->with(['server_error' => 'Erro ao atualizar o colaborador!']);
        }
        $permitidos = ['department_id', 'name', 'email', 'permissions', 'role', 'address', 'zip_code', 'city', 'phone', 'salary', 'admission_date'];
        $verificaDetalhes = ['address', 'zip_code', 'city', 'phone', 'salary', 'admission_date'];
        foreach($dados as $key => $value) {
            if(!in_array($key, $permitidos)) {
                unset($dados[$key]);
            } elseif (isset($colaborator->{$key}) AND $colaborator->{$key} == $value) {
                unset($dados[$key], $colaborator->{$key});
            } elseif(in_array($key, $verificaDetalhes)) {
                if (isset($colaborator->detail->{$key}) AND $colaborator->detail->{$key} == $value) {
                    unset($dados[$key], $colaborator->detail->{$key});
                } else {
                    $colaborator->detail->{$key} = $value;
                    unset($dados[$key]);
                }
            } else {
                $colaborator->{$key} = $value;
            }
        }
        unset($key, $value, $verificaDetalhes, $colaborator->email);
        $dados = $colaborator->toArray();
        $existeDadosAtualizar = 0;
        $detalhes = array();
        foreach ($dados as $key => $value) {
            if (in_array($key, $permitidos)) {
                $existeDadosAtualizar++;
            }
            if($key == 'detail') {
                foreach($dados[$key] as $key => $value) {
                    if (in_array($key, $permitidos)) {
                        $existeDadosAtualizar++;
                        $detalhes[$key] = ($key == 'salary') ? intval($value) : $value;
                    }
                }
            }
        }
        unset($dados, $dado, $permitidos);
        if (!$existeDadosAtualizar > 0) {
            return redirect()->route('recursos-humanos.listar')->with(['server_success' => 'Nenhuma informação para ser atualizada!']);
        }
        try {
            $colaborator->save();
            if (!empty($detalhes)) {
                $colaborator->detail->update($detalhes);
            }
            return redirect()->route('recursos-humanos.listar')->with(['server_success' => 'Dados atualizados com sucesso!']);
        } catch (\Exception $e) {
            return redirect()->route('recursos-humanos.listar')->with(['server_error' => 'Erro ao atualizar os dados!']);
            // return $e->getMessage();
        }
    }

    public function remover($id) {
        if (Auth::user()->cannot('admin') OR !isset($id)) {
            return redirect()->route('recursos-humanos.listar');
        }
        $colaborator = User::find(VerifyId::checkCryptdado($id));
        unset($id);
        return (empty($colaborator)) ? redirect()->back() : view('colaborators.delete-rh-user', compact('colaborator'));
    }

    public function delete($id) {
        if (Auth::user()->cannot('admin') OR !isset($id)) {
            return redirect()->route('recursos-humanos.listar');
        }
        try {
            User::where('id', VerifyId::checkCryptdado($id))->delete();
            return redirect()->route('recursos-humanos.listar')->with(['server_success' => "Colaborador removido com sucesso!"]);
        } catch (\Exception $e) {
            return redirect()->route('recursos-humanos.listar')->with(['server_error' => "Erro ao remover o colaborador!"]);
        }
    }
}
