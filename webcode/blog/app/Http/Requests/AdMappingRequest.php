<?php

namespace App\Http\Requests;

use App\Models\AdArea;
use App\Models\AdMapping;
use Illuminate\Foundation\Http\FormRequest;

class AdMappingRequest extends FormRequest
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
            'lecture_id' => 'required|unique:ad_mappings,lecture_id',
        ];
    }

    public function store(AdArea $adArea){
        $data = [
            'lecture_id' => $this->get('lecture_id'),
            'ad_area_id' => $adArea->id
        ];

        return AdMapping::Create($data);
    }
}
