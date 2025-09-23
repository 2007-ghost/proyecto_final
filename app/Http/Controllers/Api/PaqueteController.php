<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Paquete;
use App\Http\Requests\StorePaqueteRequest;
use App\Http\Requests\UpdatePaqueteRequest;
use App\Http\Resources\PaqueteResource;

class PaqueteController extends Controller
{
    public function index()
    {
        $paquetes = Paquete::with(['camionero', 'estado'])->paginate(10);
        return PaqueteResource::collection($paquetes);
    }

    public function store(StorePaqueteRequest $request)
    {
        $paquete = Paquete::create($request->validated());
        return new PaqueteResource($paquete->load(['camionero', 'estado']));
    }

    public function show(Paquete $paquete)
    {
        return new PaqueteResource($paquete->load(['camionero', 'estado']));
    }

    public function update(UpdatePaqueteRequest $request, Paquete $paquete)
    {
        $paquete->update($request->validated());
        return new PaqueteResource($paquete->load(['camionero', 'estado']));
    }

    public function destroy(Paquete $paquete)
    {
        $paquete->delete();
        return response()->json(['message' => 'Paquete eliminado'], 200);
    }
}
