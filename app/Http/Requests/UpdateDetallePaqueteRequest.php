<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDetallePaqueteRequest extends FormRequest
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
        'dimension' => 'required|numeric',
        'peso' => 'required|numeric',
        'fecha_entrega' => 'required|date',
    ];
}
}
