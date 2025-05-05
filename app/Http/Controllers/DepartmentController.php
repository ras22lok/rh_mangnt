<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Services\VerifyId;
use Illuminate\Http\{RedirectResponse, Request};
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DepartmentController extends Controller
{
    public function index(): View|RedirectResponse {
        // Se a gate for true retorne a view se não retorne para a página anterior
        return Auth::user()->can('admin') ? view('department.departments', ['departments' => Department::all()]) : redirect()->back();
    }

    public function create(): View|RedirectResponse {
        return Auth::user()->can('admin') ? view('department.add-departament') : redirect()->back();
    }

    public function store(Request $request): RedirectResponse {
        if(Auth::user()->cannot('admin')) {
            return redirect()->back();
        }
        $dados = $request->toArray();
        unset($request);
        try {
            Department::create($dados);
            return redirect()->route('departamento.listar')->with(['server_success' => 'Departamento criado com sucesso!']);
        } catch (\Exception $e) {
            return redirect()->route('departamento.listar')->with(['server_error' => 'Erro ao criar o departamento!']);
        }
    }

    public function editar($id): View|RedirectResponse {
        if(Auth::user()->cannot('admin') OR intval(VerifyId::checkCryptdado($request->id)) < 3) {
            return redirect()->back();
        }
        $departamento = Department::find(VerifyId::checkCryptdado($id));
        if(!$departamento) {
            redirect()->back();
        }
        return view('department.edit-department', ['department' => $departamento]);
    }

    public function update(Request $request): RedirectResponse {
        if(Auth::user()->cannot('admin') OR intval(VerifyId::checkCryptdado($request->id)) < 3) {
            return redirect()->back();
        }
        $departamento = Department::find(VerifyId::checkCryptdado($request->id));
        if(!$departamento) {
            return redirect()->back()->withInput()->with(['server_error' => 'Erro ao atualizar o departamento!']);
        }
        $departamento->name = $request->name;
        try {
            $departamento->save();
            return redirect()->route('departamento.listar')->with(['server_success' => 'Departamento atualizado com sucesso!']);
        } catch (\Exception $e) {
            return redirect()->route('departamento.listar')->with(['server_error' => 'Erro ao atualizar o departamento!']);
        }
    }

    public function remover($id): View|RedirectResponse {
        if(Auth::user()->cannot('admin') OR intval(VerifyId::checkCryptdado($id)) < 3) {
            return redirect()->back();
        }
        $departamento = Department::find(VerifyId::checkCryptdado($id));
        if(!$departamento) {
            return redirect()->back()->withInput()->with(['server_error' => 'Erro ao remover o departamento!']);
        }
        return view('department.delete-department', compact('departamento'));
    }

    public function delete($id): RedirectResponse {
        if(Auth::user()->cannot('admin') OR intval(VerifyId::checkCryptdado($id)) < 3) {
            return redirect()->back();
        }
        try {
            $departamento = Department::find(VerifyId::checkCryptdado($id));
            if(!$departamento) {
                return redirect()->back()->withInput()->with(['server_error' => 'Erro ao remover o departamento!']);
            }
            $departamento->delete();
            return redirect()->route('departamento.listar')->with(['server_success' => "Departamento removido com sucesso!"]);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with(['server_error' => 'Erro ao remover o departamento!']);
        }
    }
}
