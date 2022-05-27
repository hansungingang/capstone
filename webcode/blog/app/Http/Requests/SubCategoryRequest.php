<?php

namespace App\Http\Requests;

use App\Models\SubCategory;
use Illuminate\Foundation\Http\FormRequest;

class SubCategoryRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required',
            'category_id'=>'required|Integer'
        ];
    }

    public function store(){
        $data = [
            'name'=>$this->get('name'),
            'category_id' => $this->get('category_id'),
            'count' => 1
        ];

        return SubCategory::Create($data);
    }
}
