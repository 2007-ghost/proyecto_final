<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EstadoPaquete;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEstadoPaqueteRequest;
use App\Http\Requests\UpdateEstadoPaqueteRequest;
use App\Http\Resources\EstadoPaqueteResource;
use Illuminate\Database\QueryException;

class EstadoPaqueteController extends Controller
{
    public function index()
    {
        $estados = EstadoPaquete::paginate(10);
        return EstadoPaqueteResource::collection($estados);
    }

    public function store(StoreEstadoPaqueteRequest $request)
    {
        $estado = EstadoPaquete::create($request->validated());
        return new EstadoPaqueteResource($estado);
    }

public function show($id)
{
    $estado = EstadoPaquete::find($id);

    if (!$estado) {
        return response()->json(['message' => 'Estado no encontrado'], 404);
    }

    return new EstadoPaqueteResource($estado);
}



// app/Http/Controllers/Api/EstadoPaqueteController.php

    // ... index, store, show (ok)

    public function update(\App\Http\Requests\UpdateEstadoPaqueteRequest $request, $id)
    {
        $estado = EstadoPaquete::findOrFail($id);

        // usa validated() si usas FormRequest
        $estado->update($request->validated());

        return new EstadoPaqueteResource($estado);
    }

    public function destroy($id)
    {
        $estado = EstadoPaquete::findOrFail($id);

        try {
            $estado->delete();
        } catch (QueryException $e) {
            // conflicto de integridad referencial u otra restricción DB
            return response()->json([
                'message' => 'No se puede eliminar el estado: existen registros relacionados.',
                'error' => $e->getMessage()
            ], 409);
        }

        return response()->json(['message' => 'Estado eliminado'], 200);
    }
}