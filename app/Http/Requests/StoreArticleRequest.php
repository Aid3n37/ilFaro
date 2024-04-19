<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'=> 'required|unique:articles|min:3',
            'subtitle'=>'required|min:5',
            'body' => 'required|min:10',
            'image' => 'image|required|max:2048',
            'category' => 'required',
            //validate di tags -> vedi ArticleController.php
            'tags'=>'required'
        ];
    }
}
