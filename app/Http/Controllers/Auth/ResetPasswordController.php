<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class ResetPasswordController extends Controller
{
    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'email.required' => 'El campo correo es requerido.',
            'email.email' => 'Debe de proporcionar un formato de correo valido.',
            'token.required' => 'El token es requerido.',
            'password.required' => 'El campo contraseña es requerido.',
            'password.min' => 'El campo contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'La confirmación de la contraseña no coincide.',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = \Hash::make($password);
                $user->save();
            }
        );

        return $status === Password::PASSWORD_RESET
                    ? response()->json(['message' => 'La contraseña se ha restablecido con éxito.'])
                    : response()->json(['message' => 'El enlace de restablecimiento es inválido o ha expirado.'], 400);
    }
}
