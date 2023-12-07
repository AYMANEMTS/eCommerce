<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'title' => 'required|min:5|max:100',
            'price' => 'required|numeric',
            'description' => 'required',
            'quantity' => 'required|numeric',
            'category_id' => 'nullable',
            'befor_price' => 'nullable',
            'payement_method'=>'required',
        ];
        if($this->route()->getActionMethod === 'store' ){
            $rules['image'] = 'required|image';
        }
        return $rules;
    }
}
