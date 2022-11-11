<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'location' => 'required|string|max:250',
            'name' => 'required|string|max:250',
            'item_type' => 'nullable|string|max:45',
            'item' => 'nullable|string|max:45',
            'extra_name' => 'nullable|string|max:45',
            'extra_data' => 'nullable|string|max:250',
            'file' => 'nullable|file'
        ];
    }

    public function attributes()
    {
        return [
            'location' => 'ubicación',
            'name' => 'nombre',
            'item_type' => 'tipo de elemento',
            'item' => 'identificador del elemento',
            'extra_name' => 'nombre dato extra',
            'extra_data' => 'dato extra',
            'file' => 'archivo',
        ];
    }
}
