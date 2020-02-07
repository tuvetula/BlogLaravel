<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'first_name' => 'bail|required|between:2,80',
            'name' => 'bail|required|between:2,50|alpha',
            'avatar' => 'image|mimes:jpeg,png,jpg|max:2048'
        ];
    }
}
