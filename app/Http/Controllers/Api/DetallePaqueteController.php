<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DetallePaquete;
use Illuminate\Http\Request;
use App\Http\Requests\StoreDetallePaqueteRequest;
use App\Http\Requests\UpdateDetallePaqueteRequest;
use App\Http\Resources\DetallePaqueteResource;
/**
 * @OA\Get(
 *     path="/api/detalles-paquetes",
 *     operationId="getDetallesPaquetes",
 *     tags={"DetallesPaquetes"},
 *     summary="Lista todos los detalles de paquetes",
 *     @OA\Response(
 *         response=200,
 *         description="Lista de detalles",
 *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/DetallePaquete"))
 *     )
 * )
 */

/**
 * @OA\Post(
 *     path="/api/detalles-paquetes",
 *     operationId="crearDetallePaquete",
 *     tags={"DetallesPaquetes"},
 *     summary="Crea un detalle de paquete",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/DetallePaquete")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Detalle creado",
 *         @OA\JsonContent(ref="#/components/schemas/DetallePaquete")
 *     )
 * )
 */

/**
 * @OA\Put(
 *     path="/api/detalles-paquetes/{id}",
 *     operationId="actualizarDetallePaquete",
 *     tags={"DetallesPaquetes"},
 *     summary="Actualiza un detalle de paquete",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID del detalle",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/DetallePaquete")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Detalle actualizado",
 *         @OA\JsonContent(ref="#/components/schemas/DetallePaquete")
 *     )
 * )
 */

/**
 * @OA\Delete(
 *     path="/api/detalles-paquetes/{id}",
 *     operationId="eliminarDetallePaquete",
 *     tags={"DetallesPaquetes"},
 *     summary="Elimina un detalle de paquete",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID del detalle",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Detalle eliminado",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Detalle eliminado correctamente")
 *         )
 *     )
 * )
 */

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
