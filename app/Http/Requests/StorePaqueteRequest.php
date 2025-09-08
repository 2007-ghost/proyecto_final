<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaqueteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'camionero_id' => 'required|exists:camioneros,id',
            'estado_id' => 'required|exists:estados_paquetes,id',
            'direccion' => 'required|string|max:25',
        ];
    }
}
