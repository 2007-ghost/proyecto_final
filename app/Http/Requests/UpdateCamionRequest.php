<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCamionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $camionId = $this->route('camion')->id ?? null;

        return [
            'placa' => 'required|string|max:10|unique:camiones,placa,' . $camionId,
            'modelo' => 'required|string|max:10',
        ];
    }
}
