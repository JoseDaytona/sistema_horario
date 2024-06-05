<?php

namespace App\Http\Controllers;

use App\Models\TiposAulas;

class ConsultaController extends Controller
{
    public function get_tipo_aulas()
    {
        try {
            $registro = TiposAulas::all();
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

    public function get_tipo_estado()
    {
        try {
            $registro = ["Activo", "Inactivo"];
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

    public function get_tipo_estado_reservacion()
    {
        try {
            $registro = ['Pendiente', 'Confirmada', 'Cancelada'];
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

    public function get_tipo_usuario()
    {
        try {
            $registro = ['Profesor', 'Estudiante', 'Empleado', 'Otro', 'Administrador'];
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

    public function get_tanda_labor()
    {
        try {
            $registro = ['Mañana', 'Tarde', 'Noche'];
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
}
