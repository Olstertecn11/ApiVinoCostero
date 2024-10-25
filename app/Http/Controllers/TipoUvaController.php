<?php

namespace App\Http\Controllers;

use App\Models\TipoUva;
use App\Models\Parcela;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TipoUvaController extends Controller
{
    public function index()
    {
        $tipos_uvas = DB::table('tipos_uvas')
            ->join('parcelas', 'tipos_uvas.parcela_id', '=', 'parcelas.id')
            ->select(
                'tipos_uvas.id',
                'tipos_uvas.nombre_uva',
                'tipos_uvas.tamano_uva',
                'tipos_uvas.color_uva',
                'tipos_uvas.tiempo_maduracion',
                'tipos_uvas.created_at',
                'tipos_uvas.updated_at',
                'parcelas.nombre_parcela as nombre_parcela'
            )
            ->get();
        return response()->json($tipos_uvas);
    }

    public function show($id)
    {
        $tipo_uva = TipoUva::with('parcela')->find($id);
        if (!$tipo_uva) {
            return response()->json(['message' => 'Tipo de uva no encontrado'], 404);
        }
        return response()->json($tipo_uva);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_uva' => 'required|string|max:255',
            'tamano_uva' => 'required|string|max:255',
            'color_uva' => 'required|string|max:100',
            'tiempo_maduracion' => 'required|integer',
            'parcela_id' => 'required|exists:parcelas,id'
        ]);

        // Crear el tipo de uva
        $tipo_uva = TipoUva::create($request->all());

        return response()->json($tipo_uva, 201);
    }

    // Actualizar un tipo de uva existente
    public function update(Request $request, $id)
    {
        $tipo_uva = TipoUva::find($id);
        if (!$tipo_uva) {
            return response()->json(['message' => 'Tipo de uva no encontrado'], 404);
        }

        // Validar los datos
        $request->validate([
            'nombre_uva' => 'string|max:255',
            'tamano_uva' => 'string|max:255',
            'color_uva' => 'string|max:100',
            'tiempo_maduracion' => 'integer',
            'parcela_id' => 'exists:parcelas,id'
        ]);

        // Actualizar el tipo de uva
        $tipo_uva->update($request->all());

        return response()->json($tipo_uva);
    }

    // Eliminar un tipo de uva
    public function destroy($id)
    {
        $tipo_uva = TipoUva::find($id);
        if (!$tipo_uva) {
            return response()->json(['message' => 'Tipo de uva no encontrado'], 404);
        }

        // Eliminar el tipo de uva
        $tipo_uva->delete();

        return response()->json(['message' => 'Tipo de uva eliminado correctamente']);
    }
}
