<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->role === 1;
     
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'judul' => 'required|string|max:255',
            'user_id' => 'required|string',
            'deskripsi' => 'required|string',
            'cover' => 'nullable|mimes:png,jpg,jpeg',
        ];
    }
}
