<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /**
     * Autentica a un usuario usando nombre y contraseña.
     */
    public function LoginUser(Request $request)
    {
        $request->validate([
            'user' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('name', $request->user)->first();

        if (!$user) {
            return response()->json(['error' => 'El usuario que ingresaste no existe o no está registrado.'], 404);
        }

        if (!Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'La contraseña que ingresaste no es correcta.'], 401);
        }

        Auth::login($user);

        return response()->json(['redirect' => route('DashboardViews')], 200);
    }

    /**
     * Registra un nuevo usuario con validación detallada.
     */
    public function RegisterUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:users,name',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'required|in:Administrador,Cajero,Supervisor',
            'birthdate' => 'required|date',
            'document_number' => 'required|string|max:30|unique:users,document_number',
            'phone_number' => 'required|string|max:30',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'Error de validación',
                'details' => $validator->errors()
            ], 422);
        }

        try {
            $userNew = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'birthdate' => $request->birthdate,
                'document_number' => $request->document_number,
                'phone_number' => $request->phone_number,
            ]);

            return response()->json([
                'message' => 'Usuario registrado correctamente.',
                'redirect' => route('LoginViews')
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al registrar el usuario: ' . $e->getMessage()
            ], 500);
        }
    }
}
