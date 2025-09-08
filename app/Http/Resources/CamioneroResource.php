<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CamioneroResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'documento' => $this->documento,
            'nombre' => $this->nombre,
            'apellido' => $this->apellido,
            'fecha_nacimiento' => $this->fecha_nacimiento,
            'licencia' => $this->licencia,
            'telefono' => $this->telefono,
            // Cargamos camiones solo si la relación está cargada
            'camiones' => $this->whenLoaded('camiones', function() {
                return $this->camiones->map(function($camion) {
                    return [
                        'id' => $camion->id,
                        'placa' => $camion->placa,
                        'modelo' => $camion->modelo,
                    ];
                });
            }),
            // Cargamos paquetes solo si la relación está cargada
            'paquetes' => $this->whenLoaded('paquetes', function() {
                return $this->paquetes->map(function($paquete) {
                    return [
                        'id' => $paquete->id,
                        'estado_id' => $paquete->estado_id,
                        'direccion' => $paquete->direccion,
                        'fecha_creacion' => $paquete->created_at,
                    ];
                });
            }),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
