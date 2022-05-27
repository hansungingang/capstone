<?php

namespace App\Http\Requests;

use App\Models\Notice;
use Illuminate\Foundation\Http\FormRequest;

class NoticeRequest extends FormRequest
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
            'title'=>'required',
            'content' => 'required'
        ];
    }

    public function store(){
        return Notice::Create([
            'title' => $this->get('title'),
            'content' => $this->get('content')
        ]);
    }

    public function update(Notice $notice){
        Notice::where('id',$notice->id)->update([
            'title' => $this->get('title'),
            'content' => $this->get('content')
        ]);
    }
}
