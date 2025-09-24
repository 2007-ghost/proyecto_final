<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Camion;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCamionRequest;
use App\Http\Requests\UpdateCamionRequest;
use App\Http\Resources\CamionResource;
    /**
 * @OA\Get(
 *     path="/api/camiones",
 *     operationId="getCamiones",
 *     tags={"Camiones"},
 *     summary="Lista todos los camiones",
 *     @OA\Response(
 *         response=200,
 *         description="Lista de camiones",
 *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Camion"))
 *     )
 * )
 */

/**
 * @OA\Post(
 *     path="/api/camiones",
 *     operationId="crearCamion",
 *     tags={"Camiones"},
 *     summary="Crea un nuevo camión",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/Camion")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Camión creado",
 *         @OA\JsonContent(ref="#/components/schemas/Camion")
 *     )
 * )
 */

/**
 * @OA\Put(
 *     path="/api/camiones/{id}",
 *     operationId="actualizarCamion",
 *     tags={"Camiones"},
 *     summary="Actualiza un camión",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID del camión",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/Camion")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Camión actualizado",
 *         @OA\JsonContent(ref="#/components/schemas/Camion")
 *     )
 * )
 */

/**
 * @OA\Delete(
 *     path="/api/camiones/{id}",
 *     operationId="eliminarCamion",
 *     tags={"Camiones"},
 *     summary="Elimina un camión",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID del camión",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Camión eliminado",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Camión eliminado correctamente")
 *         )
 *     )
 * )
 */

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
