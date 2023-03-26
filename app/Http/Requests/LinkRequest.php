<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LinkRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|string|unique:links',
            'short_description' => 'required|string',
            'link' => 'required|string|url|unique:links',
            'type' => 'required|string',
            'difficulty' => 'required|string',
            'tags' => 'required',
            'tags.*' => 'required|exists:tags,id',
        ];
    }
}
