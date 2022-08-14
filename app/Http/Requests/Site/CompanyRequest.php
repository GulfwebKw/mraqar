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
        if (! in_array($this->method(), ['PUT', 'PATCH'])) { // create
            $rules = [
                'image' => 'nullable|image|mimes:jpg,png,jpeg|max:1024',
                'company_name' => 'required|max:250',
                'company_phone' => 'required|digits:8|unique:users,company_phone', // todo site: company_phone integer for slug
                'email' => 'nullable|email',
                'instagram' => 'nullable',
                'twitter' => 'nullable',
            ];
        } else { // edit
            $rules['company_phone'] = 'required|digits:8|unique:users,company_phone,' . $this->user()->id;
        }
        return $rules;
    }
}
