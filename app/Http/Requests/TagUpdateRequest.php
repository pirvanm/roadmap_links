<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagUpdateRequest extends FormRequest
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
            'id' => 'required|exists:tags,id',
            'tag' => 'required|string|unique:tags,tag,'  . $this->request->get('id'),
            'color' => 'required|string|unique:tags,color,' .  $this->request->get('id'),
            'status' => 'nullable|boolean',
        ];
    }
}
