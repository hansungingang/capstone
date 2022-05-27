<?php

namespace App\Services\Image;

use App\Http\Requests\ImageRequest;
use App\Models\File;
use Illuminate\Support\Facades\Auth;

class ImageService {
    function uploadToS3(ImageRequest $request){
        $path = 'basic/';
        $file = $request->file('upload');    
        $name = date("YmdHis").mt_rand().".".$file->getClientOriginalExtension();
        $file->storeAs($path,$name,'s3'); 

        $insert['name'] = $name;
        $insert['path'] = $path.$name;
        $insert['extension'] = $file->getClientOriginalExtension();
        $insert['size'] = $file->getSize();
        $insert['mime_type'] = $file->getMimeType();
        $insert['user_id'] = Auth::id();

        return File::create($insert);
    }
}


?>