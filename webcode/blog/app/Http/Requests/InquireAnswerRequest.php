<?php

namespace App\Http\Requests;

use App\Models\Inquire;
use Illuminate\Foundation\Http\FormRequest;

class InquireAnswerRequest extends FormRequest
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
            'answer' => 'required'
        ];
    }

    public function updateAnswer(Inquire $inquire){
        Inquire::where('id',$inquire->id)->update([
            'answer' => $this->get('answer'),
        ]);
        return Inquire::find($inquire->id);   
    }
}
