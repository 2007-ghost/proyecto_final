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
        return new DetallePaqueteResource($detalle->load(['paquete', 'tipoMercancia']));
    }

    public function show(DetallePaquete $detalle_paquete)
    {
        return new DetallePaqueteResource($detalle_paquete->load(['paquete', 'tipoMercancia']));
    }

    public function update(UpdateDetallePaqueteRequest $request, DetallePaquete $detalle_paquete)
    {
        $detalle_paquete->update($request->validated());
        return new DetallePaqueteResource($detalle_paquete->load(['paquete', 'tipoMercancia']));
    }

    public function destroy(DetallePaquete $detalle_paquete)
    {
        $detalle_paquete->delete();
        return response()->json(['message' => 'Detalle de paquete eliminado'], 200);
    }
}
