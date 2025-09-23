<?php

namespace App\Http\Requests;  

use Illuminate\Foundation\Http\FormRequest;

class StoreCamioneroRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Cambia a false si quieres restringir acceso
    }

    public function rules(): array
    {
        return [
            'documento' => 'required|string|max:10|unique:camioneros,documento',
            'nombre' => 'required|string|max:45',
            'apellido' => 'required|string|max:45',
            'fecha_nacimiento' => 'required|date',
            'licencia' => 'required|string|max:10',
            'telefono' => 'required|string|max:15',
        ];
    }
}
