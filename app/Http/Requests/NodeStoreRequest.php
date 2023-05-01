<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NodeStoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'parent.id' => 'required|exists:nodes,id',
            'name' => 'required|string',
            'description' => 'nullable|string',
            'status' => 'nullable|boolean',
        ];
    }
}
