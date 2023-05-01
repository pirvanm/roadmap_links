<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LinkUpdateRequest extends FormRequest
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
            'id' => 'required|exists:links,id',
            'title' => 'required|string|unique:links,title,' . $this->request->get('id'),
            'short_description' => 'required|string',
            'link' => 'required|string|url|unique:links,link,' . $this->request->get('id'),
            'type' => 'required|string',
            'difficulty' => 'required|string',
            'tags' => 'required',
            'tags.*' => 'required|exists:tags,id',
            'status' => 'boolean',
        ];
    }
}
