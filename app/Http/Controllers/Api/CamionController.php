<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Camion;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCamionRequest;
use App\Http\Requests\UpdateCamionRequest;
use App\Http\Resources\CamionResource;

class CamionController extends Controller
{
    public function index()
    {
        $camiones = Camion::paginate(10);
        return CamionResource::collection($camiones);
    }

    public function store(StoreCamionRequest $request)
    {
        $camion = Camion::create($request->validated());
        return new CamionResource($camion);
    }

    public function show(Camion $camion)
    {
        return new CamionResource($camion);
    }

    public function update(UpdateCamionRequest $request, Camion $camion)
    {
        $camion->update($request->validated());
        return new CamionResource($camion);
    }

    public function destroy(Camion $camion)
    {
        $camion->delete();
        return response()->json(['message' => 'Camión eliminado'], 200);
    }
}
