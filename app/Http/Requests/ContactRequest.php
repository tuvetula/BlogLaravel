<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'name' => 'bail|required|between:2,80|alpha',
            'first_name' => 'bail|required|between:2,80|alpha',
            'email' => 'bail|required|email',
            'messages' => 'bail|required|max:250'
        ];
    }
}
