<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\InquireController;
use App\Http\Controllers\InterestController;
use App\Http\Controllers\LectureController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Map\MapController;
use App\Http\Controllers\MyInfoController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\OfferingController;
use App\Http\Controllers\PlatformReviewController;
use App\Http\Controllers\PageViewController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\RecentController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SurveyController;
use App\Models\Lecture;
use App\Models\Participant;
use App\Models\Review;
use App\Models\Survey;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use Spatie\Analytics\AnalyticsFacade as Analytics;

use Spatie\Analytics\Period;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [MainController::class,'index'])->name('main');

Auth::routes();

Route::get('/test', function () {
    //fetch the most visited pages for today and the past week
    $d = Analytics::fetchVisitorsAndPageViews(Period::days(7));

    echo "<pre>";
    print_r($d);
    die();
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('file', FileController::class);
Route::group(['prefix' => 'file'], function () {
    Route::get('imageDownload/{file}', [FileController::class, 'getImageWithFile'])->name('imageDownload');
    Route::get('basicImage/{name}', [FileController::class, 'getImageWithName'])->name('basicImage');
    Route::post('imageUploadPostS3', [FileController::class, 'imageUploadPostS3Ckeditor'])->name('s3.image.upload');
    Route::post('lectureImageUpload', [FileController::class, 'imageUploadPostS3ReturnId']);
});

Route::group(['prefix' => 'lecture'], function () {
    Route::get('/', [LectureController::class, 'index'])->name('lecture.index');
    Route::post('/', [LectureController::class, 'store'])->name('lecture.store');
    Route::get('create', [LectureController::class, 'create'])->name('lecture.create');
    Route::get('show/{lecture}', [LectureController::class, 'show'])->name('lecture.show');
    Route::get('ajax_data', [LectureController::class, 'index_ajax_data']);
    Route::get('get/{lecture}', [LectureController::class, 'getLecture']);
    Route::get('edit/{lecture}',[LectureController::class, 'edit']);
    Route::put('update/{lecture}',[LectureController::class,'update'])->name('lecture.update');
});

Route::group(['prefix' => 'recent'], function () {
    Route::get('/', [RecentController::class, 'index'])->name('recent.index');
});

Route::group(['prefix' => 'interest'], function () {
    Route::get('/', [InterestController::class, 'index'])->name('interest.index');
    Route::post('/', [InterestController::class, 'store'])->name('interest.store');
    Route::delete('destroy', [InterestController::class, 'destroy'])->name('interest.destroy');
    Route::get('isInterested', [InterestController::class, 'isInterested']);
    Route::delete('multipleDestroy', [InterestController::class, 'multipleDestroy']);
});

Route::get('survey', [SurveyController::class, 'create'])->name('survey.create');
Route::post('survey', [SurveyController::class, 'store'])->name('survey.store');

Route::group(['prefix' => 'myinfo'], function () {
    Route::get('/', [MyInfoController::class, 'index'])->name('myinfo.index');
    Route::put('update', [MyInfoController::class, 'update'])->name('myinfo.update');
});

// Route::get('protected',['middleware' => ['auth','admin'], function(){
//     return "this page requires that you be logged in and an Admin";
// }]);

Route::post('forget-password',[ForgotPasswordController::class,'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}',[ForgotPasswordController::class,'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password',[ForgotPasswordController::class,'submitResetPasswordForm'])->name('reset.password.post');

Route::group(['prefix'=> 'review'],function(){
    Route::get('{lecture}',[ReviewController::class,'index'])->name('review.index');
    Route::post('{lecture}',[ReviewController::class,'store'])->name('review.store');
    Route::put('{review}',[ReviewController::class,'update'])->name('review.update');
    Route::delete('{review}',[ReviewController::class,'destroy'])->name('review.destroy');
});

Route::group(['prefix'=> 'platform_review'],function(){
    Route::get('{lecture}',[PlatformReviewController::class,'index'])->name('platform.review.index');
    Route::post('{lecture}',[PlatformReviewController::class,'store'])->name('platform.review.store');
    Route::put('{review}',[PlatformReviewController::class,'update'])->name('platform.review.update');
    Route::delete('{review}',[PlatformReviewController::class,'destroy'])->name('platform.review.destroy');
});

Route::group(['prefix'=>'pageview'],function(){
    Route::post('/',[PageViewController::class,'store'])->name('pageview.store');
});
Route::resource('board', BoardController::class);

Route::group(['prefix'=>'inquire'],function(){
    Route::get('/',[InquireController::class,'index'])->name('inquire.index');
    Route::post('/',[InquireController::class,'store'])->name('inquire.store');
});


Route::group(['prefix'=>'notice'],function(){
    Route::get('/',[NoticeController::class,'index'])->name('notice.index');
    Route::post('/',[NoticeController::class,'store'])->name('notice.store');
    Route::get('create',[NoticeController::class,'create'])->name('notice.create');
    Route::get('show/{notice}',[NoticeController::class,'show'])->name('notice.show');
    Route::get('edit/{notice}',[NoticeController::class,'edit'])->name('notice.edit');
    Route::put('update/{notice}',[NoticeController::class,'update'])->name('notice.update');
    Route::delete('destroy/{notice}',[NoticeController::class,'destroy'])->name('notice.destroy');
});

Route::group(['prefix'=>'comment'],function(){
    Route::get('{board}',[CommentController::class,'index'])->name('comment.index');    
    Route::middleware(['ajax.auth'])->group(function(){
        Route::post('{board}',[CommentController::class,'store'])->name('comment.store');
        Route::put('update/{comment}',[CommentController::class,'update'])->name('comment.update');
        Route::delete('destroy/{comment}',[CommentController::class,'destroy'])->name('comment.destroy');     
    });    
});

Route::group(['prefix' => 'admin','middleware'=>'admin'],function(){   
    #Route::get('/',[AdminController::class,'index'])->name('admin.index');
    Route::get('/{path?}',[AdminController::class,'index'])->where('path','.*')->name('admin.index');
});