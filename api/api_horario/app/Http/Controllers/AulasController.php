<?php

namespace App\Http\Controllers;

use App\Models\Aulas;
use Illuminate\Http\Request;

class AulasController extends Controller
{
    public function get_all_aulas()
    {
        try {
            $registros = Aulas::all();

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

    public function get_aula($id)
    {
        try {
            $registro = Aulas::where("AulaID", $id)->first();
            
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

    public function store_aula(Request $request)
    {
        try {
            
            $descripcion = $request->get("descripcion");
            $tipo_aula = $request->get("tipo_aula");
            $edificio = $request->get("edificio");
            $capacidad = $request->get("capacidad");
            $cupos = $request->get("cupos");
            $estado = $request->get("estado");
            
            $registro = new Aulas([
                'Descripcion' => $descripcion,
                'TipoAulaID' => $tipo_aula,
                'EdificioID' => $edificio,
                'Capacidad' => $capacidad,
                'CuposReservados' => $cupos,
                'Estado' => $estado,
            ]);

            $registro->save();

            return response()->json([
                "estado" => true,
                "mensaje" => "Aula Registrado",
                "data" => [
                    "usuario" => $registro
                ]
            ]);
        }catch (\Throwable $th) {
            return response()->json([
                "estado" => false,
                "message" => $th->getMessage()
            ], 401);
        }
    }

    public function update_aula(Request $request)
    {
        try {

            $IdAula = $request->get("id_aula");
            $descripcion = $request->get("descripcion");
            $tipo_aula = $request->get("tipo_aula");
            $edificio = $request->get("edificio");
            $capacidad = $request->get("capacidad");
            $cupos = $request->get("cupos");
            $estado = $request->get("estado");

            $registro = Aulas::updateOrCreate([
                'AulaID' => $IdAula,
                ], [
                'Descripcion' => $descripcion,
                'TipoAulaID' => $tipo_aula,
                'EdificioID' => $edificio,
                'Capacidad' => $capacidad,
                'CuposReservados' => $cupos,
                'Estado' => $estado,
            ]);

            return response()->json([
                "estado" => true,
                "mensaje" => "Aula Actualizada",
                "data" => [
                    "usuario" => $registro
                ]
            ]);
        }catch (\Throwable $th) {
            return response()->json([
                "estado" => false,
                "message" => $th->getMessage()
            ], 401);
        }
    }

    public function destroy_aula(Request $request)
    {
        try {

            $id = $request->get("id_aula");

            Aulas::where("AulaID", $id)->delete();
            
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
