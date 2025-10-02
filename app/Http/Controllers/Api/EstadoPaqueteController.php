<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EstadoPaquete;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEstadoPaqueteRequest;
use App\Http\Requests\UpdateEstadoPaqueteRequest;
use App\Http\Resources\EstadoPaqueteResource;
use Illuminate\Database\QueryException;

class EstadoPaqueteController extends Controller
{
        /**
 * @OA\Get(
 *     path="/api/estados-paquetes",
 *     summary="Listar estados de paquetes",
 *     description="Obtiene un listado paginado de todos los estados de los paquetes.",
 *     tags={"Estados de Paquetes"},
 *     security={{"sanctum":{}}},
 *     @OA\Response(
 *         response=200,
 *         description="Lista de estados de paquetes",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/EstadoPaquete")
 *         )
 *     )
 * )
 */
    public function index()
    {
        $estados = EstadoPaquete::paginate(10);
        return EstadoPaqueteResource::collection($estados);
    }

/**
 * @OA\Post(
 *     path="/api/estados-paquetes",
 *     summary="Crear un nuevo estado de paquete",
 *     tags={"Estados de Paquetes"},
 *     security={{"sanctum":{}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"estado"},
 *             @OA\Property(property="estado", type="string", example="En tránsito")
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Estado de paquete creado correctamente",
 *         @OA\JsonContent(ref="#/components/schemas/EstadoPaquete")
 *     )
 * )
 */

    public function store(StoreEstadoPaqueteRequest $request)
    {
        $estado = EstadoPaquete::create($request->validated());
        return new EstadoPaqueteResource($estado);
    }
/**
 * @OA\Get(
 *     path="/api/estados-paquetes/{id}",
 *     summary="Mostrar un estado de paquete",
 *     description="Devuelve la información de un estado de paquete específico.",
 *     tags={"Estados de Paquetes"},
 *     security={{"sanctum":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID del estado de paquete",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Estado de paquete encontrado",
 *         @OA\JsonContent(ref="#/components/schemas/EstadoPaquete")
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Estado no encontrado",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="message", type="string", example="Estado no encontrado")
 *         )
 *     )
 * )
 */

public function show($id)
{
    $estado = EstadoPaquete::find($id);

    if (!$estado) {
        return response()->json(['message' => 'Estado no encontrado'], 404);
    }

    return new EstadoPaqueteResource($estado);
}

/**
 * @OA\Put(
 *     path="/api/estados-paquetes/{id}",
 *     summary="Actualizar un estado de paquete",
 *     tags={"Estados de Paquetes"},
 *     security={{"sanctum":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID del estado de paquete",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="estado", type="string", example="Entregado")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Estado de paquete actualizado correctamente",
 *         @OA\JsonContent(ref="#/components/schemas/EstadoPaquete")
 *     )
 * )
 */

    public function update(\App\Http\Requests\UpdateEstadoPaqueteRequest $request, $id)
    {
        $estado = EstadoPaquete::findOrFail($id);

        // usa validated() si usas FormRequest
        $estado->update($request->validated());

        return new EstadoPaqueteResource($estado);
    }

/**
 * @OA\Delete(
 *     path="/api/estados-paquetes/{id}",
 *     summary="Eliminar un estado de paquete",
 *     tags={"Estados de Paquetes"},
 *     security={{"sanctum":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID del estado de paquete",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Estado eliminado correctamente",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="message", type="string", example="Estado eliminado")
 *         )
 *     ),
 *     @OA\Response(
 *         response=409,
 *         description="No se puede eliminar el estado por integridad referencial",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="message", type="string", example="No se puede eliminar el estado: existen registros relacionados."),
 *             @OA\Property(property="error", type="string", example="SQLSTATE[23000]: Integrity constraint violation ...")
 *         )
 *     )
 * )
 */
    public function destroy($id)
    {
        $estado = EstadoPaquete::findOrFail($id);

        try {
            $estado->delete();
        } catch (QueryException $e) {
            // conflicto de integridad referencial u otra restricción DB
            return response()->json([
                'message' => 'No se puede eliminar el estado: existen registros relacionados.',
                'error' => $e->getMessage()
            ], 409);
        }

        return response()->json(['message' => 'Estado eliminado'], 200);
    }

}