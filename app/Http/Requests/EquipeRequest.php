<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EquipeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    
    public function rules(): array
    {
        return [
            'login' => ['required', 'string'],
            'mdp' => ['required', 'string'],
        ];
    }

    public function messages()
    {
        return [
            
        ];
    }
}
