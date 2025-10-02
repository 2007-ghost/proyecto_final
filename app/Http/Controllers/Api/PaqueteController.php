<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Paquete;
use App\Http\Requests\StorePaqueteRequest;
use App\Http\Requests\UpdatePaqueteRequest;
use App\Http\Resources\PaqueteResource;

class PaqueteController extends Controller
{
    /**
 * @OA\Get(
 *     path="/api/paquetes",
 *     summary="Listar paquetes",
 *     description="Obtiene un listado paginado de paquetes con sus relaciones (camionero y estado).",
 *     tags={"Paquetes"},
 *     security={{"sanctum":{}}},
 *     @OA\Response(
 *         response=200,
 *         description="Lista de paquetes",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/Paquete")
 *         )
 *     )
 * )
 */


    public function index()
    {
        $paquetes = Paquete::with(['camionero', 'estado'])->paginate(10);
        return PaqueteResource::collection($paquetes);
    }

/**
 * @OA\Post(
 *     path="/api/paquetes",
 *     summary="Crear un nuevo paquete",
 *     tags={"Paquetes"},
 *     security={{"sanctum":{}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"descripcion","peso","camionero_id","estado_id"},
 *             @OA\Property(property="descripcion", type="string", example="Electrodoméstico"),
 *             @OA\Property(property="peso", type="number", format="float", example=15.7),
 *             @OA\Property(property="camionero_id", type="integer", example=1),
 *             @OA\Property(property="estado_id", type="integer", example=2)
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Paquete creado correctamente",
 *         @OA\JsonContent(ref="#/components/schemas/Paquete")
 *     )
 * )
 */

    public function store(StorePaqueteRequest $request)
    {
        $paquete = Paquete::create($request->validated());
        return new PaqueteResource($paquete->load(['camionero', 'estado']));
    }

/**
 * @OA\Get(
 *     path="/api/paquetes/{id}",
 *     summary="Mostrar un paquete",
 *     description="Devuelve la información de un paquete específico con sus relaciones.",
 *     tags={"Paquetes"},
 *     security={{"sanctum":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID del paquete",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Paquete encontrado",
 *         @OA\JsonContent(ref="#/components/schemas/Paquete")
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Paquete no encontrado",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="message", type="string", example="Paquete no encontrado")
 *         )
 *     )
 * )
 */

    public function show(Paquete $paquete)
    {
        return new PaqueteResource($paquete->load(['camionero', 'estado']));
    }

/**
 * @OA\Put(
 *     path="/api/paquetes/{id}",
 *     summary="Actualizar un paquete",
 *     tags={"Paquetes"},
 *     security={{"sanctum":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID del paquete",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="descripcion", type="string", example="Muebles"),
 *             @OA\Property(property="peso", type="number", format="float", example=50.5),
 *             @OA\Property(property="camionero_id", type="integer", example=2),
 *             @OA\Property(property="estado_id", type="integer", example=3)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Paquete actualizado correctamente",
 *         @OA\JsonContent(ref="#/components/schemas/Paquete")
 *     )
 * )
 */

    public function update(UpdatePaqueteRequest $request, Paquete $paquete)
    {
        $paquete->update($request->validated());
        return new PaqueteResource($paquete->load(['camionero', 'estado']));
    }
/**
 * @OA\Delete(
 *     path="/api/paquetes/{id}",
 *     summary="Eliminar un paquete",
 *     tags={"Paquetes"},
 *     security={{"sanctum":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID del paquete",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Paquete eliminado correctamente",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="message", type="string", example="Paquete eliminado")
 *         )
 *     )
 * )
 */


    public function destroy(Paquete $paquete)
    {
        $paquete->delete();
        return response()->json(['message' => 'Paquete eliminado'], 200);
    }

}
