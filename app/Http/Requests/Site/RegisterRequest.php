<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required',
            'mobile' => 'required|digits:8|unique:users',
            'password' => ['required','min:8','confirmed'],
            'email' => 'required|email|unique:users',
            'type_usage'=>'required|in:company,individual',
            'language'=>'required|in:ar,en',
        ];
    }
}
