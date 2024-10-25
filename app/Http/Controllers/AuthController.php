<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\RoleUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ], [
                'name.required' => 'El campo nombre es requerido.',
                'name.string' => 'El campo nombre debe ser texto.',
                'name.max' => 'El campo nombre no puede ser mayor de 255 caracteres.',
                'email.required' => 'El campo correo es requerido.',
                'email.string' => 'El campo correo debe ser texto.',
                'email.email' => 'El campo correo debe ser una dirección de correo válida.',
                'email.max' => 'El campo correo no puede ser mayor de 255 caracteres.',
                'email.unique' => 'El correo ya está registrado.',
                'password.required' => 'El campo contraseña es requerido.',
                'password.string' => 'El campo contraseña debe ser texto.',
                'password.min' => 'El campo contraseña debe tener al menos 8 caracteres.',
                'password.confirmed' => 'La confirmación de la contraseña no coincide.',
            ]);

            DB::beginTransaction();
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);

                $role = Role::where('name', 'Usuario')->firstOrFail();

                RoleUser::create([
                    'role_id' => $role->id,
                    'user_id' => $user->id,
                ]);

                $token = $user->createToken('auth_token')->plainTextToken;
            DB::commit();
                return response()->json([
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                    'success' => true,
                    'message' => 'El usuario se ha registrado correctamente.'
                ], 200);

        } catch (ValidationException $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Errores de Validación.',
                'errors' => $e->errors()
            ], 422);
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ],
        [
            'email.required' => 'El campo correo es requerido.',
            'email.email' => 'El campo correo debe ser una dirección de correo válida.',
            'password.required' => 'El campo contraseña es requerido.',
            'password.string' => 'El campo contraseña debe ser texto.',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Correo o contraseña incorrectos, revise por favor.'
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Usuario logueado correctamente',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user->toArray(),
            'roles' => $user->roles->pluck('name'),
        ], 200);
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();
        return response()->json([
            'message' => 'Sesion cerrada correctamente'
        ]);
    }

    public function me()
    {
        $user = Auth::user();
        $user->load('roles');

        return response()->json([
            'user' => $user,
            'roles' => $user->roles->pluck('name'),
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        try {
            // Validar los datos de la solicitud
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
                'user_image' => [
                    'nullable',
                    'string',
                    function ($attribute, $value, $fail) {
                        // Verificar que sea una cadena Base64 válida
                        if (!preg_match('/^data:image\/(jpeg|png|gif|bmp|webp);base64,/', $value)) {
                            return $fail('El campo ' . $attribute . ' debe contener una imagen válida en formato Base64.');
                        }

                        // Extraer los datos de la imagen y verificar si es una cadena Base64 válida
                        $data = substr($value, strpos($value, ',') + 1);
                        if (!base64_decode($data, true)) {
                            return $fail('El campo ' . $attribute . ' debe contener una imagen válida en formato Base64.');
                        }
                    }
                ],
            ], [
                'name.required' => 'El campo nombre es requerido.',
                'name.string' => 'El campo nombre debe ser texto.',
                'name.max' => 'El campo nombre no puede ser mayor de 255 caracteres.',
                'email.required' => 'El campo correo es requerido.',
                'email.string' => 'El campo correo debe ser texto.',
                'email.email' => 'Debe proporcionar un formato de correo válido.',
                'email.max' => 'El campo correo no puede ser mayor de 255 caracteres.',
                'email.unique' => 'El correo ya está registrado.',
                'user_image.string' => 'El campo imagen de usuario debe ser texto.',
            ]);


            // Actualizar el usuario con los datos validados
            $user->update($request->only('name', 'email', 'user_image'));

            return response()->json([
                'success' => true,
                'message' => 'Información del usuario actulizada correctamente.'
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Errores de Validación.',
                'errors' => $e->errors()
            ], 422);
        }

    }

    public function index()
    {
        try {
            $users = User::with('roles')->get(); // Incluye los roles de cada usuario
            return response()->json([
                'success' => true,
                'users' => $users
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener los usuarios.',
            ], 500);
        }
    }

}


