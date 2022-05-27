<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Services\Image\ImageService;
use Exception;
use Illuminate\Support\Facades\DB;

class FileController extends Controller
{
    public function store(Request $request){
        $this->validate($request, [
            'files' => 'required',
            'files.*' => 'mimes:csv,txt,xlx,xls,pdf|max:2048'
        ]);

        if($request->hasFile('files')){
            foreach($request->file('files') as $file){
                $name = $file->getClientOriginalName();
                $file->storeAs('files/', $name,'s3');  
                $data = array(
                    'name' => $file->getClientOriginalName(),
                    'extension' => $file->getClientOriginalExtension(),
                    'path' => 'files/'.$name,
                    'size' => $file->getSize(),
                    'mime_type' => $file->getMimeType()
                );

                File::create($data);
            }
            return response()->json(['success'=>'Multiple Image has been uploaded into db and storage directory']);
        }else{
            return response()->json(["message" => "Please try again."]);
        }
    }

    public function imageUploadPostS3ReturnId(ImageRequest $request,ImageService $imageService)
    {
        DB::beginTransaction();
        try{
            $result = $imageService->uploadToS3($request)->id;
            DB::commit();
        }catch(Exception $ex){
            $result = null;
            DB::rollBack();
            return redirect()->back()->with('message','에러가 발생하였습니다.');
        }

        return $result;
    }

    public function imageUploadPostS3Ckeditor(ImageRequest $request, ImageService $imageService)
    {        
        return json_encode([
            'default' => route('basicImage',['name' => $imageService->uploadToS3($request)->name])
        ]);
    }
    
    public function getImageWithFile(File $file)
    {
        return Storage::disk('s3')->get($file->path);
    } 

    public function getImageWithName($name)
    {
        return Storage::disk('s3')->get('basic/'.$name);
    }
}
