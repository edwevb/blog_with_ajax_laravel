<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        $uniqueOrExists = 'unique:categories';
        if (CategoryRequest::isMethod('PUT')) {
            $uniqueOrExists = '';
        }
        return [
            'name' => 'required|max:125|regex:/^[a-zA-Z0-9\s]+$/|'.$uniqueOrExists
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Category name is required!',
            'name.max' => 'Category name may not be greater than 125 characters!',
            'name.regex' => 'Category name may only contain letters and numbers'
        ];
    }
}
