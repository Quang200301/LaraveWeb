<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable
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



Route::get('/apicrud.data',[APIController::class, 'getDataFromAPI']);


// xóa API data
Route::delete('/apicrud.data/{id}', [APIController::class, 'destroy'])->name('apicrud.data.delete');

// thêm API data
// Route::get('/apicrud.data', [APIController::class, 'getDataFromAPI'])->name('apicrud.data.getDataFromAPI');
// Route::post('/apicrud.data.add', [APIController::class, 'add']);

Route::get('/apicrud.addadd',[APIController::class, 'getadd']);
Route::post('/add', [APIController::class, 'add']);



// ----------------------------- login----------------------------------------
Route::get('/register', function () {			
	return view('users.register');			
	});	

Route::post('/register',[UserController::class,'Register']);

Route::get('/login', function () {						
	return view('users.login');						
	});						
Route::post('/login',[UserController::class,'Login']);
Route::get('/logout',[UserController::class,'Logout']);



Route::get('add-to-cart/{id}', [PageController::class, 'getAddToCart'])->name('themgiohang');												
Route::get('del-cart/{id}', [PageController::class, 'getDelItemCart'])->name('xoagiohang');												





	// -----------PDF-----------------------------------------//
	Route::post('/upload-pdf', 'PDFController@uploadPDF');
