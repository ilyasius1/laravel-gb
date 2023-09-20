<?php

namespace App\Http\Requests\Parser;

use App\Enums\ParserType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class ParserRequest extends FormRequest
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
            'type' => ['required', new Enum(ParserType::class)],
            'sources' => ['sometimes', 'nullable','array','exists:news_sources,id'],
            'sources.*' => ['exists:news_sources,id']
        ];
    }
}