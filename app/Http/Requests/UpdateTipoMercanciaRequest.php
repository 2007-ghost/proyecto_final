<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTipoMercanciaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $tipoId = $this->route('tipo_mercancia')->id ?? null;

        return [
            'tipo' => 'required|string|max:45|unique:tipo_mercancia,tipo,' . $tipoId,
        ];
    }
}
