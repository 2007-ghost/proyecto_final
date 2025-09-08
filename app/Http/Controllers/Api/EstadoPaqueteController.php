<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EstadoPaquete;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEstadoPaqueteRequest;
use App\Http\Requests\UpdateEstadoPaqueteRequest;
use App\Http\Resources\EstadoPaqueteResource;

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

    public function show(EstadoPaquete $estadoPaquete)
    {
        return new EstadoPaqueteResource($estadoPaquete);
    }

    public function update(UpdateEstadoPaqueteRequest $request, EstadoPaquete $estadoPaquete)
    {
        $estadoPaquete->update($request->validated());
        return new EstadoPaqueteResource($estadoPaquete);
    }

    public function destroy(EstadoPaquete $estadoPaquete)
    {
        $estadoPaquete->delete();
        return response()->json(['message' => 'Estado eliminado'], 200);
    }
}
