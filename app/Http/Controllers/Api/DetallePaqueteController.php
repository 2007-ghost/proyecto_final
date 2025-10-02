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
    
    /**
 * @OA\Get(
 *     path="/api/detalles-paquetes",
 *     summary="Listar detalles de paquetes",
 *     description="Obtiene un listado paginado de todos los detalles de paquetes junto con su paquete y tipo de mercancía.",
 *     tags={"Detalles de Paquetes"},
 *     security={{"sanctum":{}}},
 *     @OA\Response(
 *         response=200,
 *         description="Lista de detalles de paquetes",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/DetallePaquete")
 *         )
 *     )
 * )
 */
    public function index()
    {
        $detalles = DetallePaquete::with(['paquete', 'tipoMercancia'])->paginate(10);
        return DetallePaqueteResource::collection($detalles);
    }

/**
 * @OA\Post(
 *     path="/api/detalles-paquetes",
 *     summary="Crear un nuevo detalle de paquete",
 *     tags={"Detalles de Paquetes"},
 *     security={{"sanctum":{}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"paquete_id","tipo_mercancia_id","dimension","peso","fecha_entrega"},
 *             @OA\Property(property="paquete_id", type="integer", example=1),
 *             @OA\Property(property="tipo_mercancia_id", type="integer", example=2),
 *             @OA\Property(property="dimension", type="string", example="50x40x30 cm"),
 *             @OA\Property(property="peso", type="number", format="float", example=25.5),
 *             @OA\Property(property="fecha_entrega", type="string", format="date", example="2025-10-15")
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Detalle de paquete creado correctamente",
 *         @OA\JsonContent(ref="#/components/schemas/DetallePaquete")
 *     )
 * )
 */

    public function store(StoreDetallePaqueteRequest $request)
    {
        $detalle = DetallePaquete::create($request->validated());
        return new DetallePaqueteResource($detalle->load(['paquete', 'tipoMercancia']));
    }
/**
 * @OA\Get(
 *     path="/api/detalles-paquetes/{id}",
 *     summary="Mostrar un detalle de paquete",
 *     description="Devuelve la información de un detalle de paquete específico junto con su paquete y tipo de mercancía.",
 *     tags={"Detalles de Paquetes"},
 *     security={{"sanctum":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID del detalle de paquete",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Detalle de paquete encontrado",
 *         @OA\JsonContent(ref="#/components/schemas/DetallePaquete")
 *     )
 * )
 */

    public function show(DetallePaquete $detalle_paquete)
    {
        return new DetallePaqueteResource($detalle_paquete->load(['paquete', 'tipoMercancia']));
    }

/**
 * @OA\Put(
 *     path="/api/detalles-paquetes/{id}",
 *     summary="Actualizar un detalle de paquete",
 *     tags={"Detalles de Paquetes"},
 *     security={{"sanctum":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID del detalle de paquete",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="paquete_id", type="integer", example=1),
 *             @OA\Property(property="tipo_mercancia_id", type="integer", example=3),
 *             @OA\Property(property="dimension", type="string", example="60x45x35 cm"),
 *             @OA\Property(property="peso", type="number", format="float", example=30.2),
 *             @OA\Property(property="fecha_entrega", type="string", format="date", example="2025-11-01")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Detalle de paquete actualizado correctamente",
 *         @OA\JsonContent(ref="#/components/schemas/DetallePaquete")
 *     )
 * )
 */

    public function update(UpdateDetallePaqueteRequest $request, DetallePaquete $detalle_paquete)
    {
        $detalle_paquete->update($request->validated());
        return new DetallePaqueteResource($detalle_paquete->load(['paquete', 'tipoMercancia']));
    }
/**
 * @OA\Delete(
 *     path="/api/detalles-paquetes/{id}",
 *     summary="Eliminar un detalle de paquete",
 *     tags={"Detalles de Paquetes"},
 *     security={{"sanctum":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID del detalle de paquete",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Detalle de paquete eliminado correctamente",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="message", type="string", example="Detalle de paquete eliminado")
 *         )
 *     )
 * )
 */

    public function destroy(DetallePaquete $detalle_paquete)
    {
        $detalle_paquete->delete();
        return response()->json(['message' => 'Detalle de paquete eliminado'], 200);
    }

}
