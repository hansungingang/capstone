<?php

namespace App\Http\Requests;

use App\Models\Lecture;
use App\Models\PlatformReview;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PlatformReviewRequest extends FormRequest
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
            'platform_name' => 'required',
            'title' => 'nullable',
            'content' => 'required',
            'user_name' => 'required'
        ];
    }

    public function store(Lecture $lecture){
        $data = [
            'platform_name' => $this->get('platform_name'),
            'title' => $this->get('title'),
            'content' => $this->get('content'),
            'user_name' => $this->get('user_name'),
            'lecture_id' => $lecture->id
        ];

        return PlatformReview::Create($data);
    }
}
