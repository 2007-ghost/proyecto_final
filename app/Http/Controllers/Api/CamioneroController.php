<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCamioneroRequest;
use App\Http\Requests\UpdateCamioneroRequest;
use App\Http\Resources\CamioneroResource;
use App\Models\Camionero;
use Illuminate\Http\Request;

class CamioneroController extends Controller
{
    // Listar todos los camioneros
    public function index()
{
    // Cargar camiones y paquetes junto con los camioneros
    $camioneros = Camionero::with(['camiones', 'paquetes'])->paginate(10);

    return CamioneroResource::collection($camioneros);
}

    // Crear un nuevo camionero
    public function store(StoreCamioneroRequest $request)
    {
        $camionero = Camionero::create($request->validated());
        return new CamioneroResource($camionero);
    }


    // Mostrar un camionero
    public function show(Camionero $camionero)
    {
        $camionero->load('camiones');
        return new CamioneroResource($camionero);
    }

    // Actualizar un camionero
    public function update(UpdateCamioneroRequest $request, Camionero $camionero)
    {
        $camionero->update($request->validated());
        return new CamioneroResource($camionero);
    }

    // Eliminar un camionero
    public function destroy(Camionero $camionero)
    {
        $camionero->delete();
        return response()->json(['message' => 'Camionero eliminado correctamente'], 200);
    }
}
