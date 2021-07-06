<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $uniqueOrExists = 'unique:posts';
        if (FormRequest::isMethod('PUT')) {
            $uniqueOrExists = '';
        }

        return [
            'title' => 'required|max:125|regex:/^[a-zA-Z0-9\s]+$/|'.$uniqueOrExists,
            'body' => 'required|string',
            'tags' => 'array|max:5',
            'tags.*' => 'alpha_dash',
            'category' => 'nullable|exists:categories,id',
            'thumb' => 'image|nullable|max:2048'
        ];

    }

    public function messages()
    {
        return [
            'title.required' => 'Title is required!',
            'title.max' => 'Title may not be greater than 125 characters!',
            'title.regex' => 'Title may only contain letters and numbers',
            'body.required' => 'Body is required!',
            'tags.max' => 'Total of tags may not be greater than 5 words!',
            'tags.*.alpha_dash' => 'Tags may only contain letters, numbers, dashes and underscores.',
            'category.exists' => 'Category not exists!'
        ];
    }
}
