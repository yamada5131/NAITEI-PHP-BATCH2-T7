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
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|url',
            'qty_in_stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:product_categories,id',
            'price' => 'required|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'name.max' => 'The name field must not exceed 255 characters.',
            'name.string' => 'The name field must be a string.',
            'description.required' => 'The description field is required.',
            'description.string' => 'The description field must be a string.',
            'image.required' => 'The image field is required.',
            'image.url' => 'The image field must be a valid URL.',
            'qty_in_stock.required' => 'The quantity in stock field is required.',
            'qty_in_stock.integer' => 'The quantity in stock field must be an integer.',
            'qty_in_stock.min' => 'The quantity in stock field must be at least 0.',
            'category_id.exists' => 'The selected category is invalid.',
            'category_id.required' => 'The category field is required.',
            'price.required' => 'The price field is required.',
            'price.numeric' => 'The price field must be a number.',
            'price.min' => 'The price field must be at least 0.',
        ];
    }
}
