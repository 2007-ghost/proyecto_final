<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCamioneroRequest;
use App\Http\Requests\UpdateCamioneroRequest;
use App\Http\Resources\CamioneroResource;
use App\Models\Camionero;
use Illuminate\Http\Request;
 /**
     * @OA\Get(
     *     path="/api/camioneros",
     *     operationId="getCamioneros",
     *     tags={"Camioneros"},
     *     summary="Lista todos los camioneros",
     *     @OA\Response(
     *         response=200,
     *         description="Lista de camioneros",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Camionero"))
     *     )
     * )
     */
      /**
     * @OA\Post(
     *     path="/api/camioneros",
     *     operationId="crearCamionero",
     *     tags={"Camioneros"},
     *     summary="Crea un nuevo camionero",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Camionero")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Camionero creado",
     *         @OA\JsonContent(ref="#/components/schemas/Camionero")
     *     )
     * )
     */
    /**
     * @OA\Put(
     *     path="/api/camioneros/{id}",
     *     operationId="actualizarCamionero",
     *     tags={"Camioneros"},
     *     summary="Actualiza un camionero",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del camionero",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Camionero")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Camionero actualizado",
     *         @OA\JsonContent(ref="#/components/schemas/Camionero")
     *     )
     * )
     */
    /**
     * @OA\Delete(
     *     path="/api/camioneros/{id}",
     *     operationId="eliminarCamionero",
     *     tags={"Camioneros"},
     *     summary="Elimina un camionero",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del camionero",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Camionero eliminado",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Camionero eliminado correctamente")
     *         )
     *     )
     * )
     */
class CamioneroController extends Controller
{
    // Listar todos los camioneros
    public function index()
{
    // Cargar camiones y paquetes junto con los camioneros
    $camioneros = Camionero::with(['camiones', 'paquetes'])->paginate(10);

    return CamioneroResource::collection($camioneros);
}

    // Crear un nuevo camionero
    public function store(StoreCamioneroRequest $request)
    {
        $camionero = Camionero::create($request->validated());
        return new CamioneroResource($camionero);
    }


    // Mostrar un camionero
    public function show(Camionero $camionero)
    {
        $camionero->load('camiones');
        return new CamioneroResource($camionero);
    }

    // Actualizar un camionero
    public function update(UpdateCamioneroRequest $request, Camionero $camionero)
    {
        $camionero->update($request->validated());
        return new CamioneroResource($camionero);
    }

    // Eliminar un camionero
    public function destroy(Camionero $camionero)
    {
        $camionero->delete();
        return response()->json(['message' => 'Camionero eliminado correctamente'], 200);
    }

}
