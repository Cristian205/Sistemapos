<?php

namespace App\Http\Controllers;

use App\Models\Tienda;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class FunctionsController extends Controller
{
    public function RegistroPasoAPaso(Request $request)
    {
        // Validación básica
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'telefono' => 'required|string|max:20',
            'direccion' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'nit' => 'required|string|max:50',
            'plan_id' => 'required|integer|exists:planes,id',
            'categoria_id' => 'required|integer|exists:categoria_negocios,id',
            'password' => 'required|string|min:6',
            'logo' => 'nullable|image|max:2048'
        ]);

        try {
            DB::beginTransaction();

            $logoPath = null;
            if ($request->hasFile('logo')) {
                $logoPath = $request->file('logo')->store('logos', 'public');
            }

            $fechaInicio = Carbon::now();
            $fechaFinal = $fechaInicio->copy()->addMonth()->addDays(10);

            $tienda = Tienda::create([
                'nombre' => $request->nombre,
                'telefono' => $request->telefono,
                'email' => $request->email,
                'direccion' => $request->direccion,
                'nit' => $request->nit,
                'logo' => $logoPath,
                'descripcion' => $request->descripcion,
                'plan_id' => $request->plan_id,
                'categoria_id' => $request->categoria_id,
                'fecha_inicio' => $fechaInicio,
                'fecha_final' => $fechaFinal,
                'activa' => true,
                'ip_registro' => $request->ip(),
            ]);

            $user = User::create([
                'name' => $request->nombre,
                'email' => $request->email,
                'telefono' => $request->telefono,
                'password' => Hash::make($request->password),
                'tienda_id' => $tienda->id,
                'rol' => 'admin'
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'tienda' => $tienda,
                'usuario' => $user
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'mensaje' => 'Error al procesar la solicitud.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
