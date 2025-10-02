<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TipoMercancia;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTipoMercanciaRequest;
use App\Http\Requests\UpdateTipoMercanciaRequest;
use App\Http\Resources\TipoMercanciaResource;

class TipoMercanciaController extends Controller
{
        /**
 * @OA\Get(
 *     path="/api/tipos-mercancia",
 *     summary="Listar tipos de mercancía",
 *     description="Obtiene un listado paginado de tipos de mercancía.",
 *     tags={"Tipos de Mercancía"},
 *     security={{"sanctum":{}}},
 *     @OA\Response(
 *         response=200,
 *         description="Lista de tipos de mercancía",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/TipoMercancia")
 *         )
 *     )
 * )
 */


    public function index()
    {
        $tipos = TipoMercancia::paginate(10);
        return TipoMercanciaResource::collection($tipos);
    }
/**
 * @OA\Post(
 *     path="/api/tipos-mercancia",
 *     summary="Crear un nuevo tipo de mercancía",
 *     tags={"Tipos de Mercancía"},
 *     security={{"sanctum":{}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"nombre"},
 *             @OA\Property(property="nombre", type="string", example="Electrónica")
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Tipo de mercancía creado correctamente",
 *         @OA\JsonContent(ref="#/components/schemas/TipoMercancia")
 *     )
 * )
 */

    public function store(StoreTipoMercanciaRequest $request)
    {
        $tipo = TipoMercancia::create($request->validated());
        return new TipoMercanciaResource($tipo);
    }

/**
 * @OA\Get(
 *     path="/api/tipos-mercancia/{id}",
 *     summary="Mostrar un tipo de mercancía",
 *     description="Devuelve la información de un tipo de mercancía específico.",
 *     tags={"Tipos de Mercancía"},
 *     security={{"sanctum":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID del tipo de mercancía",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Tipo de mercancía encontrado",
 *         @OA\JsonContent(ref="#/components/schemas/TipoMercancia")
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Tipo de mercancía no encontrado",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="message", type="string", example="Tipo de mercancía no encontrado")
 *         )
 *     )
 * )
 */


    public function show(TipoMercancia $tipo_mercancia)
    {
        return new TipoMercanciaResource($tipo_mercancia);
    }

/**
 * @OA\Put(
 *     path="/api/tipos-mercancia/{id}",
 *     summary="Actualizar un tipo de mercancía",
 *     tags={"Tipos de Mercancía"},
 *     security={{"sanctum":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID del tipo de mercancía",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="nombre", type="string", example="Alimentos")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Tipo de mercancía actualizado correctamente",
 *         @OA\JsonContent(ref="#/components/schemas/TipoMercancia")
 *     )
 * )
 */

    public function update(UpdateTipoMercanciaRequest $request, TipoMercancia $tipo_mercancia)
    {
        $tipo_mercancia->update($request->validated());
        return new TipoMercanciaResource($tipo_mercancia);
    }
/**
 * @OA\Delete(
 *     path="/api/tipos-mercancia/{id}",
 *     summary="Eliminar un tipo de mercancía",
 *     tags={"Tipos de Mercancía"},
 *     security={{"sanctum":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID del tipo de mercancía",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Tipo de mercancía eliminado correctamente",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="message", type="string", example="Tipo eliminado")
 *         )
 *     )
 * )
 */

    public function destroy(TipoMercancia $tipo_mercancia)
    {
        $tipo_mercancia->delete();
        return response()->json(['message' => 'Tipo eliminado'], 200);
    }

}
