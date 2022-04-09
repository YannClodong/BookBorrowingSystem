<?php

namespace App\Http\Requests;

use App\Models\GenreStyle;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class GenreFormRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3',
            'style' => [ 'required', new Enum(GenreStyle::class)]
        ];
    }

    public function customValidated() {
        return $this->validated();
    }
}
