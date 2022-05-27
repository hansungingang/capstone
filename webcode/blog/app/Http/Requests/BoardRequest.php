<?php

namespace App\Http\Requests;

use App\Models\Board;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BoardRequest extends FormRequest
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
            'board_category_id' => 'required|exists:board_categories,id',
            'title' => 'required',
            'content' => 'required'
        ];
    }

    public function store(){
        $data = [
            'board_category_id' => $this->get('board_category_id'),
            'title' => $this->get('title'),
            'content' => $this->get('content'),
            'user_id' => Auth::id()
        ];

        return Board::Create($data);
    }

    public function update(Board $board){
        Board::where('id',$board->id)->update([
            'board_category_id' => $this->get('board_category_id'),
            'title' => $this->get('title'),
            'content' => $this->get('content')
        ]);
    }
}
