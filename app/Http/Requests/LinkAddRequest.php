<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LinkAddRequest extends FormRequest
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
            'life_time'=> 'required|numeric|min:0.1|max:24',
            'max_visit'=> 'required|integer',
            'url'=> 'required|string',
            'token'=> 'required|unique:links|string|max:8',
        ];
    }
}
