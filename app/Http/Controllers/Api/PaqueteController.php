<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Paquete;
use App\Http\Requests\StorePaqueteRequest;
use App\Http\Requests\UpdatePaqueteRequest;
use App\Http\Resources\PaqueteResource;
    /**
 * @OA\Get(
 *     path="/api/paquetes",
 *     operationId="getPaquetes",
 *     tags={"Paquetes"},
 *     summary="Lista todos los paquetes",
 *     @OA\Response(
 *         response=200,
 *         description="Lista de paquetes",
 *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Paquete"))
 *     )
 * )
 */

/**
 * @OA\Post(
 *     path="/api/paquetes",
 *     operationId="crearPaquete",
 *     tags={"Paquetes"},
 *     summary="Crea un paquete",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/Paquete")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Paquete creado",
 *         @OA\JsonContent(ref="#/components/schemas/Paquete")
 *     )
 * )
 */

/**
 * @OA\Put(
 *     path="/api/paquetes/{id}",
 *     operationId="actualizarPaquete",
 *     tags={"Paquetes"},
 *     summary="Actualiza un paquete",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID del paquete",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/Paquete")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Paquete actualizado",
 *         @OA\JsonContent(ref="#/components/schemas/Paquete")
 *     )
 * )
 */

/**
 * @OA\Delete(
 *     path="/api/paquetes/{id}",
 *     operationId="eliminarPaquete",
 *     tags={"Paquetes"},
 *     summary="Elimina un paquete",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID del paquete",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Paquete eliminado",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Paquete eliminado correctamente")
 *         )
 *     )
 * )
 */

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
