<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidatePassword
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $request->validate([
            'current_password' => 'required',
            'new_password'     => 'required|min:8|max:16|different:current_password',
            'new_password_confirmation'     => 'same:new_password',
        ],[
            'new_password.different' => 'A nova senha deve ser diferente da senha atual',
            'new_password_confirmation.same' => 'A confirmação de senha e a nova senha devem ser iguais',
        ]);
        return $next($request);
    }
}
