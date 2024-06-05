<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use Illuminate\Http\Request;

class CampusController extends Controller
{
    public function get_all_campus()
    {
        try {
            $registros = Campus::all();

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

    public function get_campus($id)
    {
        try {
            $registro = Campus::where("CampusID", $id)->first();
            
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

    public function store_campus(Request $request)
    {
        try {
            
            $descripcion = $request->get("descripcion");
            $estado = $request->get("estado");
            
            $registro = new Campus([
                'Descripcion' => $descripcion,
                'Estado' => $estado,
            ]);

            $registro->save();

            return response()->json([
                "estado" => true,
                "mensaje" => "Campus Registrado",
                "data" => $registro
            ]);
        }catch (\Throwable $th) {
            return response()->json([
                "estado" => false,
                "message" => $th->getMessage()
            ], 401);
        }
    }

    public function update_campus(Request $request)
    {
        try {

            $IdCampus = $request->get("id_campus");
            $descripcion = $request->get("descripcion");
            $estado = $request->get("estado");

            $registro = Campus::updateOrCreate([
                'CampusID' => $IdCampus,
                ], [
                'Descripcion' => $descripcion,
                'Estado' => $estado,
            ]);

            return response()->json([
                "estado" => true,
                "mensaje" => "Campus Actualizado",
                "data" => $registro
            ]);
        }catch (\Throwable $th) {
            return response()->json([
                "estado" => false,
                "message" => $th->getMessage()
            ], 401);
        }
    }

    public function destroy_campus(Request $request)
    {
        try {

            $id = $request->get("id_campus");

            Campus::where("CampusID", $id)->delete();
            
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
