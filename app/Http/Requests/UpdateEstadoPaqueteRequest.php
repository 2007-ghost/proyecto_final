<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEstadoPaqueteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $estadoId = $this->route('estado_paquete')->id ?? null;

        return [
            'estado' => 'required|string|max:45|unique:estados_paquetes,estado,' . $estadoId,
        ];
    }
}
