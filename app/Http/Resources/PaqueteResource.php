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
            'camionero_id' => $this->camionero_id,
            'estado_id' => $this->estado_id,
            'direccion' => $this->direccion,
            'camionero' => $this->camionero ? [
                'id' => $this->camionero->id,
                'nombre' => $this->camionero->nombre,
                'apellido' => $this->camionero->apellido
            ] : null,
            'estado' => $this->estado ? [
                'id' => $this->estado->id,
                'estado' => $this->estado->estado
            ] : null,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
