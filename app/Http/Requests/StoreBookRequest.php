<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'isbn' => 'required|string|max:255',
            'published_date' => 'required|date',
            'author.author_id' => 'required|exists:authors,id'
        ];
    }


    public function messages()
    {
        return [
            'author.author_id.exists' => 'The author (ID: :input) does not exist.',
        ];
    }
}
