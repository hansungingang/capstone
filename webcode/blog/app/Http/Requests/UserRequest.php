<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required',
            'type' => 'required'
        ];
    }

    public function update(User $user){
        User::where('id',$user->id)->update([
            'name' => $this->get('name'),
            'email' => $this->get('email'),
            'type' => $this->get('type')
        ]);

        return User::where('id',$user->id)->first();
    }
}
