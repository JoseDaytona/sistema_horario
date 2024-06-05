<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Usuarios;

class UsuarioController extends Controller
{
    public function get_all_usuarios()
    {
        try {
            $registros = Usuarios::all();

            return response()->json([
                "estado" => true,
                "data" => $registros
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                "estado" => false,
                "message" => $th->getMessage()
            ], 401);
        }

    }

    public function get_usuario($id)
    {
        try {
            $registro = Usuarios::where("UsuarioID", $id)->first();
            
            if(empty($registro))
            {
                return response()->json([
                    "estado" => false,
                    "mensaje" => "Codigo No Encontrado",
                ], 401);
            }
            
            return response()->json([
                "estado" => true,
                "data" => $registro
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                "estado" => false,
                "message" => $th->getMessage()
            ], 401);
        }
    }

    public function store_usuario(Request $request)
    {
        try {

            $usuario = $request->get("usuario");

            $existe_usuario = Usuarios::where("Usuario", $usuario)->exists();
            
            if($existe_usuario)
            {
                return response()->json([
                    "estado" => false,
                    "message" => "Este nombre de usuario ya esta registrado"
                ], 401);
            }

            $tipoUsuario = $request->get("tipoUsuario");
            $estado = $request->get("estado");
            $Clave = Hash::make($request->get("Clave"));
            $CodEmpleado = $request->get("id_empleado");
            
            $registro = new Usuarios([
                'Usuario' => $usuario,
                'Clave' => $Clave,
                'TipoUsuario' => $tipoUsuario,
                'Estado' => $estado,
                'EmpleadoID' => $CodEmpleado
            ]);

            $registro->save();

            return response()->json([
                "estado" => true,
                "mensaje" => "Usuario Registrado",
                "data" => $registro
            ]);
        }catch (\Throwable $th) {
            return response()->json([
                "estado" => false,
                "message" => $th->getMessage()
            ], 401);
        }
    }

    public function update_usuario(Request $request)
    {
        try {
            $IdUsuario = $request->get("id_usuario");
            $usuario = $request->get("usuario");

            $existe_usuario = Usuarios::where("Usuario", $usuario)->where("UsuarioID", "!=", $IdUsuario)->exists();
            
            if($existe_usuario)
            {
                return response()->json([
                    "estado" => false,
                    "message" => "Este nombre de usuario ya esta registrado"
                ], 401);
            }

            $tipoUsuario = $request->get("tipoUsuario");
            $estado = $request->get("estado");
            $CodEmpleado = $request->get("empleadoId");

            $registro = Usuarios::updateOrCreate([
                'UsuarioID' => $IdUsuario,
                ], [
                'Usuario' => $usuario,
                'TipoUsuario' => $tipoUsuario,
                'Estado' => $estado,
                'EmpleadoID' => $CodEmpleado
            ]);

            return response()->json([
                "estado" => true,
                "mensaje" => "Usuario Actualizado",
                "data" => $registro
            ]);
        }catch (\Throwable $th) {
            return response()->json([
                "estado" => false,
                "message" => $th->getMessage()
            ], 401);
        }
    }

    public function update_password_usuario(Request $request)
    {
        try {
            $IdUsuario = $request->get("id_usuario");
            
            $Clave = Hash::make($request->get("clave"));

            $registro = Usuarios::updateOrCreate([
                'UsuarioID' => $IdUsuario,
                ], [
                'Clave' => $Clave
            ]);

            return response()->json([
                "estado" => true,
                "mensaje" => "Clave Actualizada",
                "data" => $registro
            ]);
        }catch (\Throwable $th) {
            return response()->json([
                "estado" => false,
                "message" => $th->getMessage()
            ], 401);
        }
    }

    public function destroy_usuario(Request $request)
    {
        try {

            $id = $request->get("id_usuario");

            Usuarios::where("UsuarioID", $id)->delete();
            
            return response()->json([
                "estado" => true,
                "message" => "Registro Eliminado Satisfactoriamente"
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                "estado" => false,
                "message" => $th->getMessage()
            ], 401);
        }
    }
}
