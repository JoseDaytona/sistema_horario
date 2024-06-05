<?php

namespace App\Http\Controllers;

use App\Models\Empleados;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    public function get_all_empleados()
    {
        try {
            $registros = Empleados::all();

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

    public function get_empleado($id)
    {
        try {
            $registro = Empleados::where("EmpleadoID", $id)->first();
            
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

    public function store_empleado(Request $request)
    {
        try {

            $cedula = $request->get("cedula");

            $existe_doc = Empleados::where("Cedula", $cedula)->exists();

            if($existe_doc)
            {
                return response()->json([
                    "estado" => false,
                    "message" => "Este documento de identidad ya esta registrado"
                ], 401);
            }
            
            $nombre = $request->get("nombre");
            $tandaLabor = $request->get("tanda_labor");
            $FechaIngreso = $request->get("fecha_ingreso");
            $CorreoElectronico = $request->get("correo_electronico");
            $NoCarnet = $request->get("noCarnet");
            $Estado = $request->get("estado");

            $registro = new Empleados([
                'Nombre' => $nombre,
                'Cedula' => $cedula,
                'TandaLabor' => $tandaLabor,
                'FechaIngreso' => $FechaIngreso,
                'CorreoElectronico' => $CorreoElectronico,
                'NoCarnet' => $NoCarnet,
                'Estado' => $Estado
            ]);

            $registro->save();

            return response()->json([
                "estado" => true,
                "mensaje" => "Empleado Registrado",
                "data" => $registro
            ]);
        }catch (\Throwable $th) {
            return response()->json([
                "estado" => false,
                "message" => $th->getMessage()
            ], 401);
        }
    }

    public function update_empleado(Request $request)
    {
        try {

            $IdEmpleado = $request->get("id_empleado");

            $cedula = $request->get("cedula");

            $existe_doc = Empleados::where("Cedula", $cedula)->where("EmpleadoID", "!=", $IdEmpleado)->exists();

            if($existe_doc)
            {
                return response()->json([
                    "estado" => false,
                    "message" => "Este documento de identidad ya esta registrado"
                ], 401);
            }

            $nombre = $request->get("nombre");
            $tandaLabor = $request->get("tanda_labor");
            $FechaIngreso = $request->get("fecha_ingreso");
            $CorreoElectronico = $request->get("correo_electronico");
            $NoCarnet = $request->get("noCarnet");
            $Estado = $request->get("estado");

            $registro = Empleados::updateOrCreate([
                'EmpleadoID' => $IdEmpleado,
                ], [
                'Nombre' => $nombre,
                'Cedula' => $cedula,
                'TandaLabor' => $tandaLabor,
                'FechaIngreso' => $FechaIngreso,
                'CorreoElectronico' => $CorreoElectronico,
                'NoCarnet' => $NoCarnet,
                'Estado' => $Estado
            ]);

            return response()->json([
                "estado" => true,
                "mensaje" => "Empleado Actualizado",
                "data" => $registro
            ]);
        }catch (\Throwable $th) {
            return response()->json([
                "estado" => false,
                "message" => $th->getMessage()
            ], 401);
        }
    }

    public function destroy_empleado(Request $request)
    {
        try {

            $id = $request->get("id_empleado");

            Empleados::where("EmpleadoID", $id)->delete();
            
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
