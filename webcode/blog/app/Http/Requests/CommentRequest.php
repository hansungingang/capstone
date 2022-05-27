<?php

namespace App\Http\Requests;

use App\Models\Board;
use App\Models\Comment;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'content' => 'required',
            'parent_comment_id' => 'nullable'
        ];
    }

    public function store(Board $board){
        $data = [
            'content' => $this->get('content'),
            'user_id' => Auth::id(),
            'board_id' => $board->id,
            'parent_comment_id' => $this->get('parent_comment_id')
        ];

        return Comment::Create($data);
    }

    public function update(Comment $comment){
        $data = [
            'content' => $this->get('content'),
        ];

        Comment::where('id',$comment->id)->update($data);
    }
}
