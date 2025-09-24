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
        'dimension' => 'required|numeric', // Si en DB es decimal/float
        'peso' => 'required|numeric',      // Igual
        'fecha_entrega' => 'required|date',
    ];
}

}
