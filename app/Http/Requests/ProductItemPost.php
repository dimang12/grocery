<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductItemPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'product_name' => 'required|max:128',
            'category_id' => 'required|numeric',
            'slug' => 'nullable',
            'price' => 'required|numeric|min:0',
            'size' => 'required',
            'SKU' => 'required',
            'origin' => 'nullable',
            'image' => 'nullable',

            'profile' => 'max:1024',
            'detail' => 'max:1024',
            'our_story' => 'nullable'
        ];
    }
}
