<?php

declare(strict_types=1);

namespace App\Http\Requests\NewsSource;

use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'category_id' => ['sometimes', 'nullable','string','exists:categories,id'],
            'item_field' => ['required', 'string', 'min:3', 'max: 200'],
            'title' => ['required', 'string', 'min:3', 'max: 200'],
            'link' => ['required', 'string', 'min:7', 'max: 200'],
            'title_field' => ['required', 'string', 'min:2', 'max:50'],
            'author_field' => ['nullable', 'string', 'min:2', 'max:50'],
            'image_field' => ['sometimes','max:50'],
            'description_field' => ['required', 'string', 'min:2', 'max:50'],
            'origin_link_field' => ['nullable', 'string', 'min:3', 'max: 200'],
            'pub_date_field' => ['nullable', 'string', 'min:2', 'max: 200'],
        ];
    }
}
