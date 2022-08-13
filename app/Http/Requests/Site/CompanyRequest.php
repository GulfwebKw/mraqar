<?php

namespace App\Http\Requests\site;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:1024',
            'company_name' => 'required',
            'email' => 'required|email',
            'instagram' => 'nullable', // todo site: validation socials and image
            'twitter' => 'nullable',
        ];
    }
}
