<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateColaborator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!isset($request->id)) {
            $request->validate([
                'name' => 'required|min:3|max:255',
                'email' => 'required|email|unique:users,email',
                'department_id' => 'required',
                'address' => 'required|max:100',
                'zip_code' => 'required|max:10',
                'city' => 'required|max:50',
                'phone' => 'required|max:20',
                'salary' => 'required|decimal:2',
                'admission_date' => 'required|date_format:Y-m-d',
            ],[
                'name.required' => 'O campo nome é obrigatório!',
                'name.min' => 'O campo nome deve conter no minimo :min caracteres',
                'name.max' => 'O campo nome deve conter no maximo :max caracteres',
                'email.required' => 'O campo e-mail é obrigatório!',
                'email.email' => 'O campo e-mail deve ser um e-mail valido',
                'email.unique' => 'Esse e-mail já existe',
                'department_id.required' => 'O campo departamento é obrigatório!',
                'department_id.exists' => 'O departamento informado não existe!',
                'address.required' => 'O campo endereço é obrigatório!',
                'address.max' => 'O campo endereço deve conter no maximo :max caracteres',
                'zip_code.required' => 'O campo cep é obrigatório!',
                'zip_code.max' => 'O campo cep deve conter no maximo :max caracteres',
                'city.required' => 'O campo cidade é obrigatório!',
                'city.max' => 'O campo cidade deve conter no maximo :max caracteres',
                'phone.required' => 'O campo telefone é obrigatório!',
                'phone.max' => 'O campo telefone deve conter no maximo :max caracteres',
                'salary.required' => 'O campo salario é obrigatório!',
                'salary.decimal' => 'O campo decimal deve conter :decimal digitos após o ponto',
                'admission_date.required' => 'O campo data de admissão é obrigatório!',
                'admission_date.decimal' => 'O campo data de admissão deve ser no formato 0000-00-00 Ano-mes-dia',
            ]);
        } else {
            $request->validate([
                'name' => 'required|min:3|max:255',
                'department_id' => 'required',
                'address' => 'required|max:100',
                'zip_code' => 'required|max:10',
                'city' => 'required|max:50',
                'phone' => 'required|max:20',
                'salary' => 'required|decimal:2',
                'admission_date' => 'required|date_format:Y-m-d',
            ],[
                'name.required' => 'O campo nome é obrigatório!',
                'name.min' => 'O campo nome deve conter no minimo :min caracteres',
                'name.max' => 'O campo nome deve conter no maximo :max caracteres',
                'department_id.required' => 'O campo departamento é obrigatório!',
                'department_id.exists' => 'O departamento informado não existe!',
                'address.required' => 'O campo endereço é obrigatório!',
                'address.max' => 'O campo endereço deve conter no maximo :max caracteres',
                'zip_code.required' => 'O campo cep é obrigatório!',
                'zip_code.max' => 'O campo cep deve conter no maximo :max caracteres',
                'city.required' => 'O campo cidade é obrigatório!',
                'city.max' => 'O campo cidade deve conter no maximo :max caracteres',
                'phone.required' => 'O campo telefone é obrigatório!',
                'phone.max' => 'O campo telefone deve conter no maximo :max caracteres',
                'salary.required' => 'O campo salario é obrigatório!',
                'salary.decimal' => 'O campo decimal deve conter :decimal digitos após o ponto',
                'admission_date.required' => 'O campo data de admissão é obrigatório!',
                'admission_date.decimal' => 'O campo data de admissão deve ser no formato 0000-00-00 Ano-mes-dia',
            ]);
        }

        return $next($request);
    }
}
