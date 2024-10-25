<?php
namespace App\Http\Controllers;

use App\Models\Parcela;
use Illuminate\Http\Request;

class ParcelaController extends Controller
{
    // Método para listar todas las parcelas
    public function index()
    {
        $parcelas = Parcela::all();
        return response()->json($parcelas);
    }

    // Método para mostrar una parcela específica
    public function show($id)
    {
        $parcela = Parcela::find($id);
        if (!$parcela) {
            return response()->json(['message' => 'Parcela no encontrada'], 404);
        }
        return response()->json($parcela);
    }

    // Método para crear una nueva parcela
    public function store(Request $request)
    {
        // Validar los datos
        $request->validate([
            'nombre_parcela' => 'required|string|max:255',
            'ubicacion' => 'required|string|max:255',
            'superficie' => 'required|numeric',
            'tipo_suelo' => 'required|string|max:100',
        ]);

        // Crear la parcela
        $parcela = Parcela::create($request->all());

        return response()->json($parcela, 201);
    }

    // Método para actualizar una parcela existente
    public function update(Request $request, $id)
    {
        $parcela = Parcela::find($id);
        if (!$parcela) {
            return response()->json(['message' => 'Parcela no encontrada'], 404);
        }

        // Validar los datos
        $request->validate([
            'nombre_parcela' => 'string|max:255',
            'ubicacion' => 'string|max:255',
            'superficie' => 'numeric',
            'tipo_suelo' => 'string|max:100',
        ]);

        // Actualizar la parcela
        $parcela->update($request->all());

        return response()->json($parcela);
    }

    // Método para eliminar una parcela
    public function destroy($id)
    {
        $parcela = Parcela::find($id);
        if (!$parcela) {
            return response()->json(['message' => 'Parcela no encontrada'], 404);
        }

        // Eliminar la parcela
        $parcela->delete();

        return response()->json(['message' => 'Parcela eliminada correctamente']);
    }
}
