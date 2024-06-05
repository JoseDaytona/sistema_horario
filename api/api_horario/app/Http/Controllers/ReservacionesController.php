<?php

namespace App\Http\Controllers;

use App\Models\Reservaciones;
use Illuminate\Http\Request;

class ReservacionesController extends Controller
{
    public function get_all_reservaciones()
    {
        try {
            $registros = Reservaciones::all();

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

    public function get_reservacion($id)
    {
        try {
            $registro = Reservaciones::where("ReservacionID", $id)->first();
            
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

    public function store_reservacion(Request $request)
    {
        try {
            
            $IdUsuario = 0; //Id() Helper
            $IdEmpleado = $request->get("id_empleado");
            $IdAula = $request->get("id_aula");
            $FechaReservacion = $request->get("fecha_reservacion");
            $CantidadHoras = $request->get("cantidad_hora");
            $Comentario = $request->get("comentario");
            $Estado = $request->get("estado");
            
            $registro = new Reservaciones([
                'EmpleadoID' => $IdEmpleado,
                'AulaID' => $IdAula,
                'UsuarioID' => $IdUsuario,
                'FechaReservacion' => $FechaReservacion,
                'CantidadHoras' => $CantidadHoras,
                'Comentario' => $Comentario,
                'Estado' => $Estado
            ]);

            $registro->save();

            return response()->json([
                "estado" => true,
                "mensaje" => "Reservación Registrada",
                "data" => $registro
            ]);
        }catch (\Throwable $th) {
            return response()->json([
                "estado" => false,
                "message" => $th->getMessage()
            ], 401);
        }
    }

    public function update_reservacion(Request $request)
    {
        try {

            $IdReservacion = $request->get("id_reservacion");
            $IdUsuario = 0; //Id() Helper
            $IdEmpleado = $request->get("id_empleado");
            $IdAula = $request->get("id_aula");
            $FechaReservacion = $request->get("fecha_reservacion");
            $CantidadHoras = $request->get("cantidad_hora");
            $Comentario = $request->get("comentario");
            $Estado = $request->get("estado");

            $registro = Reservaciones::updateOrCreate([
                'ReservacionID' => $IdReservacion,
                ], [
                'EmpleadoID' => $IdEmpleado,
                'AulaID' => $IdAula,
                'UsuarioID' => $IdUsuario,
                'FechaReservacion' => $FechaReservacion,
                'CantidadHoras' => $CantidadHoras,
                'Comentario' => $Comentario,
                'Estado' => $Estado
            ]);

            return response()->json([
                "estado" => true,
                "mensaje" => "Reservación Actualizada",
                "data" => $registro
            ]);
        }catch (\Throwable $th) {
            return response()->json([
                "estado" => false,
                "message" => $th->getMessage()
            ], 401);
        }
    }

    public function destroy_reservacion(Request $request)
    {
        try {

            $id = $request->get("id_reservacion");

            Reservaciones::where("ReservacionID", $id)->delete();
            
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
