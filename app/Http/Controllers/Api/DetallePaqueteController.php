<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DetallePaquete;
use Illuminate\Http\Request;
use App\Http\Requests\StoreDetallePaqueteRequest;
use App\Http\Requests\UpdateDetallePaqueteRequest;
use App\Http\Resources\DetallePaqueteResource;

class DetallePaqueteController extends Controller
{
    public function index()
    {
        $detalles = DetallePaquete::with(['paquete', 'tipoMercancia'])->paginate(10);
        return DetallePaqueteResource::collection($detalles);
    }

    public function store(StoreDetallePaqueteRequest $request)
    {
        $detalle = DetallePaquete::create($request->validated());
        return new DetallePaqueteResource($detalle);
    }

    public function show(DetallePaquete $detallePaquete)
    {
        return new DetallePaqueteResource($detallePaquete->load(['paquete', 'tipoMercancia']));
    }

    public function update(UpdateDetallePaqueteRequest $request, DetallePaquete $detallePaquete)
    {
        $detallePaquete->update($request->validated());
        return new DetallePaqueteResource($detallePaquete);
    }

    public function destroy(DetallePaquete $detallePaquete)
    {
        $detallePaquete->delete();
        return response()->json(['message' => 'Detalle eliminado'], 200);
    }
}
