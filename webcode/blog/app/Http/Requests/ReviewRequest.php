<?php

namespace App\Http\Requests;

use App\Models\Lecture;
use App\Models\Review;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ReviewRequest extends FormRequest
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
            'content' => 'required|string',
            'star' => 'required|integer',
            'difficulty' => 'required|integer',
            'parent_review'=>'nullable|integer'
        ];
    }

    public function store(Lecture $lecture){
        $data = [
            'content' => $this->get('content'),
            'star' => $this->get('star'),
            'difficulty' => $this->get('difficulty'),
            'parent_review' => $this->get('parent_review'),
            'user_id' => Auth::id(),
            'lecture_id' => $lecture->id
        ];

        return Review::Create($data);
    }
}
