<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDetallePaqueteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'paquete_id' => 'required|exists:paquetes,id',
            'tipo_mercancia_id' => 'required|exists:tipo_mercancia,id',
            'dimension' => 'required|string|max:45',
            'peso' => 'required|string|max:45',
            'fecha_entrega' => 'required|date',
        ];
    }
}
