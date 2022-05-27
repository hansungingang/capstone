<?php

use App\Http\Controllers\Api\Advertise\AdvertiseApiController;
use App\Http\Controllers\Api\Lecture\LectureApiController;
use App\Http\Controllers\Api\PassportAuthController;
use App\Http\Controllers\Api\UploadLectureController;
use App\Http\Controllers\Api\UploadSubCategoryController;
use App\Http\Controllers\Api\User\UserController;
use App\Http\Controllers\Api\Inquire\InquireApiController;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login',[PassportAuthController::class,'login'])->name('api.login');
Route::group(['middleware'=>'auth:api'],function(Router $router){
    Route::post('uploadThumbNail',[UploadLectureController::class,'uploadThumbNail'])->name('api.thumbnail');
    Route::post('uploadLecture',[UploadLectureController::class,'uploadLecture'])->name('api.lecture');
    Route::post('uploadSubCategory',[UploadSubCategoryController::class,'uploadSubCategory'])->name('api.subCategory');
    Route::get('allUser',[UserController::class,'getAllUser'])->name('api.user');
    Route::get('oneUser/{user}',[UserController::class,'getOneUser'])->name('api.oneUser');
    Route::put('user/update/{user}',[UserController::class,'updateUser'])->name('api.updateUser');
    Route::group(['prefix' => 'user'],function(){
        Route::get('search',[UserController::class,'searchByEmail'])->name('api.user.search');
    });
    Route::group(['prefix' => 'inquire'],function(){   
        Route::get('get/all',[InquireApiController::class,'getAllInquiries'])->name('api.inquire.all');
        Route::get('get/{inquire}',[InquireApiController::class,'getOneInquire'])->name('api.inquire.one');
        Route::put('update/{inquire}',[InquireApiController::class,'updateOneInquire'])->name('api.inquire.update');
    });
    Route::group(['prefix' => 'advertise'],function(){
        Route::get('get/area/all',[AdvertiseApiController::class,'getAllAdvertiseAreas'])->name('api.advertise.area.all');
        Route::get('get/{adArea}',[AdvertiseApiController::class,'getMappingListByAdvertiseId'])->name('api.advertise.get');
        Route::post('store/{adArea}',[AdvertiseApiController::class,'storeMappingList'])->name('api.store.adMapping');
        Route::delete('delete/{adMapping}',[AdvertiseApiController::class,'deleteMapping'])->name('api.delete.adMapping');
    });

    Route::group(['prefix' => 'lecture'],function(){
        Route::get('get/all',[LectureApiController::class,'getAllLectures'])->name('api.lecture.all');
    });
});
