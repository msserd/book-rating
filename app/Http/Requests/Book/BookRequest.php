<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'genre' => ['nullable', 'string'],
            'img' => ['nullable', 'string'],
            'adult' => ['nullable', 'boolean'],
        ];
    }

    /**
     * Обработка полей перед валидацией
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'adult' => $this->boolean('adult'),
            'genre' => is_array($this->genre) ? implode(', ', $this->genre) : '',
        ]);
    }

    /**
     * Сообщения об ошибках
     */
    public function messages()
    {
        return [
            'title.required'    => 'Введите название книги.',
            'title.max'    => 'Название должно быть меньше 256 символов.',
        ];
    }
}
