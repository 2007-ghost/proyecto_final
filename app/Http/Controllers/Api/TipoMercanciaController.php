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
    public function index()
    {
        $tipos = TipoMercancia::paginate(10);
        return TipoMercanciaResource::collection($tipos);
    }

    public function store(StoreTipoMercanciaRequest $request)
    {
        $tipo = TipoMercancia::create($request->validated());
        return new TipoMercanciaResource($tipo);
    }

    public function show(TipoMercancia $tipo_mercancia)
    {
        return new TipoMercanciaResource($tipo_mercancia);
    }

    public function update(UpdateTipoMercanciaRequest $request, TipoMercancia $tipo_mercancia)
    {
        $tipo_mercancia->update($request->validated());
        return new TipoMercanciaResource($tipo_mercancia);
    }

    public function destroy(TipoMercancia $tipo_mercancia)
    {
        $tipo_mercancia->delete();
        return response()->json(['message' => 'Tipo eliminado'], 200);
    }
}
