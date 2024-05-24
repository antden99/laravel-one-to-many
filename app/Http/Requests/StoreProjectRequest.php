<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
            'name'=>'required|min:5|max:20',
            'cover_image'=>'required|image|max:1000',
            'description'=>'nullable|max:255',
            'type_id'=>'nullable|exists:types,id',   //qui praticamente dico che type_id può essere nullable, ma se c'è, deve esistere e appartenere alla tabella types, confrontandola con i suoi id
            'start_date'=>'required',
            'end_date'=>'nullable',
        ];
    }
}
