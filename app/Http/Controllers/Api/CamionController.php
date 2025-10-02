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
        /**
 * @OA\Get(
 *     path="/api/camiones",
 *     summary="Listar camiones",
 *     tags={"Camiones"},
 *     security={{"sanctum":{}}},
 *     @OA\Response(
 *         response=200,
 *         description="Lista de camiones",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/Camion")
 *         )
 *     )
 * )
 */
    public function index()
    {
        $camiones = Camion::paginate(10);
        return CamionResource::collection($camiones);
    }
/**
 * @OA\Post(
 *     path="/api/camiones",
 *     summary="Crear un nuevo camión",
 *     tags={"Camiones"},
 *     security={{"sanctum":{}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"placa","marca","modelo","capacidad"},
 *             @OA\Property(property="placa", type="string", example="ABC123"),
 *             @OA\Property(property="marca", type="string", example="Volvo"),
 *             @OA\Property(property="modelo", type="string", example="FH16"),
 *             @OA\Property(property="capacidad", type="number", format="float", example=15000)
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Camión creado",
 *         @OA\JsonContent(ref="#/components/schemas/Camion")
 *     )
 * )
 */

    public function store(StoreCamionRequest $request)
    {
        $camion = Camion::create($request->validated());
        return new CamionResource($camion);
    }
/**
 * @OA\Get(
 *     path="/api/camiones/{id}",
 *     summary="Mostrar un camión específico",
 *     tags={"Camiones"},
 *     security={{"sanctum":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID del camión",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Detalles del camión",
 *         @OA\JsonContent(ref="#/components/schemas/Camion")
 *     )
 * )
 */



    public function show(Camion $camion)
    {
        return new CamionResource($camion);
    }
/**
 * @OA\Put(
 *     path="/api/camiones/{id}",
 *     summary="Actualizar un camión",
 *     tags={"Camiones"},
 *     security={{"sanctum":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID del camión",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="placa", type="string", example="DEF456"),
 *             @OA\Property(property="marca", type="string", example="Mercedes"),
 *             @OA\Property(property="modelo", type="string", example="Actros"),
 *             @OA\Property(property="capacidad", type="number", format="float", example=20000)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Camión actualizado",
 *         @OA\JsonContent(ref="#/components/schemas/Camion")
 *     )
 * )
 */
    public function update(UpdateCamionRequest $request, Camion $camion)
    {
        $camion->update($request->validated());
        return new CamionResource($camion);
    }
    /**
 * @OA\Delete(
 *     path="/api/camiones/{id}",
 *     summary="Eliminar un camión",
 *     tags={"Camiones"},
 *     security={{"sanctum":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID del camión",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Camión eliminado correctamente",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="message", type="string", example="Camión eliminado")
 *         )
 *     )
 * )
 */

    public function destroy(Camion $camion)
    {
        $camion->delete();
        return response()->json(['message' => 'Camión eliminado'], 200);
    }

}
