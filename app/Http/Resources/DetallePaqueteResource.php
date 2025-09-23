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
            'tipo_mercancia_id' => $this->tipo_mercancia_id,
            'dimension' => $this->dimension,
            'peso' => $this->peso,
            'fecha_entrega' => $this->fecha_entrega,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            // Relaciones opcionales
            'paquete' => $this->whenLoaded('paquete'),
            'tipo_mercancia' => $this->whenLoaded('tipoMercancia'),
        ];
    }
}
