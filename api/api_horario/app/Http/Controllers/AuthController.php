<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            
            $usuario = $request->get("usuario");

            $clave = $request->get("clave");

            if(empty($usuario))
            {
                return response()->json([
                    "message" => "Debe suministrar un usuario"
                ], 401);
            }

            if(empty($clave))
            {
                return response()->json([
                    "message" => "Debe Suministrar una clave"
                ], 401);
            }

            if(!Auth::attempt(['Usuario' => $usuario, 'Clave' => $clave]))
            {
                return response()->json([
                    "message" => "Credenciales Incorrectas"
                ], 401);
            }
            
            $usuario = Usuarios::where("Usuario", $usuario)->firstOrFail();
            
            $token = $usuario->createToken("auth_token")->plainTextToken;
        
            return response()->json([
                "message" => "Sesion Iniciada",
                "data" => [
                    "token_type" => "Bearer",
                    "access_token" => $token,
                    "usuario" => $usuario
                ]
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "estado" => false,
                "message" => $th->getMessage()
            ], 401);
        }
        
    }

    public function unauthorized()
    {
        return response()->json([
            "message" => "Credenciales Incorrectas"
        ], 401);
    }
}
