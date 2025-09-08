<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaqueteResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'camionero' => new CamioneroResource($this->whenLoaded('camionero')),
            'estado' => $this->estado,
            'direccion' => $this->direccion,
            'detalles' => $this->detallesPaquetes->map(function($detalle) {
                return [
                    'id' => $detalle->id,
                    'tipo_mercancia' => $detalle->tipoMercancia->tipo ?? null,
                    'dimension' => $detalle->dimension,
                    'peso' => $detalle->peso,
                    'fecha_entrega' => $detalle->fecha_entrega
                ];
            }),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
