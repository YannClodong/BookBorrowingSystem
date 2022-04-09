<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookFormRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'genres' => 'array',
            'genres.*' => 'exists:App\Models\Genre,id',
            'title' => 'required|between:3,255',
            'authors' => 'required|between:3,255',
            'description' => 'nullable',
            'released_at' => 'required|date',
            'cover_image' => 'nullable|between:0,255',
            'pages' => 'required|integer|min:1',
            'language_code' => 'required',
            'isbn' => 'required|between:10,13',
            'in_stock' => 'required|integer|min:1'
        ];
    }
}
