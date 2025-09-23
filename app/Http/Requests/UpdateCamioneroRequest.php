<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCamioneroRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $camioneroId = $this->route('camionero')->id ?? $this->route('camionero');

        return [
            'documento' => [
                'required',
                'string',
                'max:10',
                Rule::unique('camioneros', 'documento')->ignore($camioneroId),
            ],
            'nombre' => 'required|string|max:45',
            'apellido' => 'required|string|max:45',
            'fecha_nacimiento' => 'required|date',
            'licencia' => 'required|string|max:10',
            'telefono' => 'required|string|max:15',
        ];
    }
}
