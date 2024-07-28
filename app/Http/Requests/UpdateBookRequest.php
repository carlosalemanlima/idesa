<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        $rules = [
            'title' => 'string|max:255',
            'isbn' => 'string|max:255',
            'published_date' => 'date'
        ];

        if ($this->has('author')) {
            $rules['author.author_id'] = 'required|exists:authors,id';
        }

        return $rules;
    }


    public function messages()
    {
        return [
            'author.author_id.exists' => 'The author (ID: :input) does not exist.',
        ];
    }
}
