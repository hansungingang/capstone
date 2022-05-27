<?php

namespace App\Http\Requests;

use App\Models\Lecture;
use App\Models\LecturePlatform;
use Illuminate\Foundation\Http\FormRequest;

class LectureRequest extends FormRequest
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
            'instructor_name' => 'required',
            'platform_name' => 'required',
            'platform_name.*' => 'string|max:50',
            'price' => 'required',
            'price.*' => 'string|max:50',
            'url' => 'required',
            'url.*' => 'string',
            'watch_time' => 'required',
            'watch_time.*' => 'integer',
            'end_time' => 'nullable',
            'end_time.*' => 'nullable|date',
            'content' => 'required|string',
            'file_id' => 'required',
            'category_id' => 'required'
        ];
    }

    public function store(){
        $insert_lecture = array(
            'name' => $this->get('name'),
            'instructor_name' => $this->get('instructor_name'),
            'content' => $this->get('content'),
            'category_id' => $this->get('category_id'),
            'file_id' => $this->get('file_id')
        );
        $lecture = Lecture::create($insert_lecture);
        
        for($i=0; $i<count($this->get('platform_name')); $i++){
            $tempArray = array(
                'lecture_id'=> $lecture->id,
                'platform_name' => $this->get('platform_name')[$i],
                'url' => $this->get('url')[$i],
                'price' => $this->get('price')[$i],
                'end_time' => !empty($this->get('end_time')[$i]) ? $this->get('end_time')[$i] : null,
                'watch_time' => !empty($this->get('watch_time')[$i]) ? $this->get('watch_time')[$i] : 0
            );
            LecturePlatform::create($tempArray);
        }

        return $lecture->id;
    }
    
    public function update(Lecture $lecture){
        $insert_lecture = array(
            'name' => $this->get('name'),
            'instructor_name' => $this->get('instructor_name'),
            'content' => $this->get('content'),
            'category_id' => $this->get('category_id'),
            'file_id' => $this->get('file_id')
        );
        $lectureUpdate = Lecture::find($lecture->id)->update($insert_lecture);

        LecturePlatform::where('lecture_id',$lecture->id)->delete();

        for($i=0; $i<count($this->get('platform_name')); $i++){
            $tempArray = array(
                'lecture_id'=> $lecture->id,
                'platform_name' => $this->get('platform_name')[$i],
                'url' => $this->get('url')[$i],
                'price' => $this->get('price')[$i],
                'end_time' => !empty($this->get('end_time')[$i]) ? $this->get('end_time')[$i] : null,
                'watch_time' => !empty($this->get('watch_time')[$i]) ? $this->get('watch_time')[$i] : 0
            );
            LecturePlatform::create($tempArray);
        }

        return $lecture->id;
    }
}
