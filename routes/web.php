<?php
namespace App\Http\Controllers;


use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

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

;


// GET: được sử dụng để lấy thông tin từ sever theo URI đã cung cấp.


// POST: gửi thông tin tới sever thông qua các biểu mẫu http (đăng kí chả hạn ...);
Route::get('/signup',[SignupController::class ,'index']);

Route::post('/signup',[SignupController::class ,'displayInfor']);




Route::get('/', [PageController::class,'getIndex']);
Route::get('/master',[PageController::class,'getIndex']);
Route::get('/su',[PageController::class,'slide']);

Route::get('/suu',[PageController::class,'getLoaiSP']);

Route::get('/type/{id}',[PageController::class,'getloaiSp']);

Route::get('/page.loai_sanpham/{type}',[
    'as'=>'loai_sanpham',
    'user'=>'PageController@getLoaiSp'
]);

Route::get('/admin', [PageController::class, 'getIndexAdmin']);												

Route::get('/admin-add-form', [PageController::class, 'getAdminAdd']);														

Route::post('/admin-add-form', [PageController::class, 'postAdminAdd']);												

Route::get('/admin-edit-form/{id}', [PageController::class, 'getAdminEdit']);													

Route::post('/admin-edit',[PageController::class, 'postAdminEdit']);
Route::get('/contact',[PageController::class,'getContact']);

Route::get('/about',[PageController::class,'getAbout']);

Route::get('/type/{id}',[PageController::class,'getLoaiSp']);

Route::get('detail/{id}',[PageController::class,'getDetail']);

Route::post('/admin-delete/{id}', [PageController::class, 'postAdminDelete']);														




