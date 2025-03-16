<?php

namespace App\Http\Requests\Admin;

use App\Enums\PostPublished;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
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
        $rules = [
            'title' => 'required|max:255',
            'slug' => 'required|max:255|unique:posts,slug,' . ($this->post?->id ?? 'NULL'),
            // 'slug' => [
            //     'required',
            //     'max:255',
            //     Rule::unique('posts', 'slug')->ignore($this->post?->id),
            // ],
            'category_id' => 'required|exists:categories,id',
        ];
        // Si es un CREATE (POST), hacer que 'body' sea obligatorio
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['excerpt'] = $this->input('published') == PostPublished::Publicado->value ? 'required' : 'nullable';
            $rules['body'] = $this->input('published') == PostPublished::Publicado->value ? 'required' : 'nullable';
            // $rules['published'] = 'required|in:1,2';
            $rules['published'] =  ['required', Rule::in([PostPublished::Borrador->value, PostPublished::Publicado->value])];
            $rules['tags'] = 'nullable|array';
            $rules['image_path'] = 'nullable|image|max:1024';
        }

        return $rules;
    }
}
