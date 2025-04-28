<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateCreateDepartment
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $request->validate([
            'name' => 'required|string|max:50|unique:departments',
        ],[
            'name.required' => 'Esse campo é obrigatório!',
            'name.string' => 'Esse campo deve ser do tipo texto!',
            'name.max' => 'Esse campo deve conter no máximo :max caracteres!',
            'name.unique' => 'O departamento informado já existe!',
        ]);
        return $next($request);
    }
}
