<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCamioneroRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $camioneroId = $this->route('camionero')->id ?? null;

        return [
            'documento' => 'required|string|max:10|unique:camioneros,documento,' . $camioneroId,
            'nombre' => 'required|string|max:45',
            'apellido' => 'required|string|max:45',
            'fecha_nacimiento' => 'required|date',
            'licencia' => 'required|string|max:10',
            'telefono' => 'required|string|max:15',
        ];
    }
}
