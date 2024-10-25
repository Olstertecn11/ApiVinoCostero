<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ], [
            'email.required' => 'El campo correo es requerido.',
            'email.email' => 'Debe de proporcionar un formato de correo valido.',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                    ? response()->json(['message' => 'Se ha enviado un enlace a tu correo para restablecer la contraseña.'])
                    : response()->json(['message' => 'No se ha encontrado un usuario con el correo proporcionado.'], 404);
    }
}
