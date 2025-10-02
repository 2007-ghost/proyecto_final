<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCamioneroRequest;
use App\Http\Requests\UpdateCamioneroRequest;
use App\Http\Resources\CamioneroResource;
use App\Models\Camionero;
use Illuminate\Http\Request;

class CamioneroController extends Controller
{
    /**
 * @OA\Get(
 *     path="/api/camioneros",
 *     summary="Listar camioneros",
 *     description="Obtiene un listado paginado de todos los camioneros junto con sus camiones y paquetes.",
 *     tags={"Camioneros"},
 *     security={{"sanctum":{}}},
 *     @OA\Response(
 *         response=200,
 *         description="Lista de camioneros",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/Camionero")
 *         )
 *     )
 * )
 */
    // Listar todos los camioneros
    public function index()
{
    // Cargar camiones y paquetes junto con los camioneros
    $camioneros = Camionero::with(['camiones', 'paquetes'])->paginate(10);

    return CamioneroResource::collection($camioneros);
}
/**
 * @OA\Post(
 *     path="/api/camioneros",
 *     summary="Crear un nuevo camionero",
 *     tags={"Camioneros"},
 *     security={{"sanctum":{}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"documento","nombre","apellido","fecha_nacimiento","licencia","telefono"},
 *             @OA\Property(property="documento", type="string", example="123456789"),
 *             @OA\Property(property="nombre", type="string", example="Juan"),
 *             @OA\Property(property="apellido", type="string", example="Pérez"),
 *             @OA\Property(property="fecha_nacimiento", type="string", format="date", example="1985-06-15"),
 *             @OA\Property(property="licencia", type="string", example="C1"),
 *             @OA\Property(property="telefono", type="string", example="3201234567")
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Camionero creado correctamente",
 *         @OA\JsonContent(ref="#/components/schemas/Camionero")
 *     )
 * )
 */


    // Crear un nuevo camionero
    public function store(StoreCamioneroRequest $request)
    {
        $camionero = Camionero::create($request->validated());
        return new CamioneroResource($camionero);
    }

/**
 * @OA\Get(
 *     path="/api/camioneros/{id}",
 *     summary="Mostrar un camionero",
 *     description="Devuelve los datos de un camionero específico, incluyendo los camiones asociados.",
 *     tags={"Camioneros"},
 *     security={{"sanctum":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID del camionero",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Detalles del camionero",
 *         @OA\JsonContent(ref="#/components/schemas/Camionero")
 *     )
 * )
 */

    // Mostrar un camionero
    public function show(Camionero $camionero)
    {
        $camionero->load('camiones');
        return new CamioneroResource($camionero);
    }
/**
 * @OA\Put(
 *     path="/api/camioneros/{id}",
 *     summary="Actualizar un camionero",
 *     tags={"Camioneros"},
 *     security={{"sanctum":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID del camionero",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="documento", type="string", example="987654321"),
 *             @OA\Property(property="nombre", type="string", example="Carlos"),
 *             @OA\Property(property="apellido", type="string", example="García"),
 *             @OA\Property(property="fecha_nacimiento", type="string", format="date", example="1990-04-20"),
 *             @OA\Property(property="licencia", type="string", example="C2"),
 *             @OA\Property(property="telefono", type="string", example="3109876543")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Camionero actualizado correctamente",
 *         @OA\JsonContent(ref="#/components/schemas/Camionero")
 *     )
 * )
 */

    // Actualizar un camionero
    public function update(UpdateCamioneroRequest $request, Camionero $camionero)
    {
        $camionero->update($request->validated());
        return new CamioneroResource($camionero);
    }
/**
 * @OA\Delete(
 *     path="/api/camioneros/{id}",
 *     summary="Eliminar un camionero",
 *     tags={"Camioneros"},
 *     security={{"sanctum":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID del camionero",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Camionero eliminado correctamente",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="message", type="string", example="Camionero eliminado correctamente")
 *         )
 *     )
 * )
 */

    // Eliminar un camionero
    public function destroy(Camionero $camionero)
    {
        $camionero->delete();
        return response()->json(['message' => 'Camionero eliminado correctamente'], 200);
    }

}
