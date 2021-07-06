<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $roles = auth()->user()->roles;
        $_token = request()->_token;
        if ($roles == 'admin' && isset($_token)) 
        {
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $uniqueOrExists = 'unique:tags';
        if (request()->isMethod('PUT')) {
            $uniqueOrExists = '';
        }
        return [
            'name' => 'required|max:125|alpha_dash|'.$uniqueOrExists
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tag name is required!',
            'name.max' => 'Tag name may not be greater than 125 characters!',
            'name.alpa_dash' => 'Tags may only contain letters, numbers, dashes and underscores.'
        ];
    }
}
