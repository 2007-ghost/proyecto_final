<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DetallePaqueteResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'paquete_id' => $this->paquete_id,
            'tipo_mercancia' => $this->tipoMercancia->tipo ?? null,
            'dimension' => $this->dimension,
            'peso' => $this->peso,
            'fecha_entrega' => $this->fecha_entrega,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
