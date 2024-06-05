<?php

namespace App\Http\Controllers;

use App\Models\Edificios;
use Illuminate\Http\Request;

class EdificiosController extends Controller
{
    public function get_all_edificios()
    {
        try {
            $registros = Edificios::all();

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

    public function get_edificio($id)
    {
        try {
            $registro = Edificios::where("EdificioID", $id)->first();
            
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

    public function store_edificio(Request $request)
    {
        try {
            
            $descripcion = $request->get("descripcion");
            $IdCampus = $request->get("id_campus");
            $estado = $request->get("estado");
            
            $registro = new Edificios([
                'Descripcion' => $descripcion,
                'CampusID' => $IdCampus,
                'Estado' => $estado,
            ]);

            $registro->save();

            return response()->json([
                "estado" => true,
                "mensaje" => "Edificio Registrado",
                "data" => $registro
            ]);
        }catch (\Throwable $th) {
            return response()->json([
                "estado" => false,
                "message" => $th->getMessage()
            ], 401);
        }
    }

    public function update_edificio(Request $request)
    {
        try {

            $IdEdificio = $request->get("id_edificio");
            $descripcion = $request->get("descripcion");
            $IdCampus = $request->get("id_campus");
            $estado = $request->get("estado");

            $registro = Edificios::updateOrCreate([
                'EdificioID' => $IdEdificio,
                ], [
                'Descripcion' => $descripcion,
                'CampusID' => $IdCampus,
                'Estado' => $estado,
            ]);

            return response()->json([
                "estado" => true,
                "mensaje" => "Edificio Actualizado",
                "data" => $registro
            ]);
        }catch (\Throwable $th) {
            return response()->json([
                "estado" => false,
                "message" => $th->getMessage()
            ], 401);
        }
    }

    public function destroy_edificio(Request $request)
    {
        try {

            $id = $request->get("id_edificio");

            Edificios::where("EdificioID", $id)->delete();
            
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
