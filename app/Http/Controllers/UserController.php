<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  Illuminate\Support\Facades\Auth;
use App\Models\User;
use  Illuminate\Support\Facades\Hash;
use  Illuminate\Support\Facades\Session;
use Symfony\Component\Console\Input\Input;



class UserController extends Controller
{
    public function Login(Request $request){
        $login = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if(Auth::attempt($login)){
            $user=Auth::User();
            Session::put('user',$user);
            echo '<script>alert("Đăng nhập thành công.");window.location.assign("/");</script>';
        }else{
            echo'<script> alert("đăng nhập thất bại.");window.location.assign("login");</script>';
        }
    }
    public function Logout(){
        Session::forget('user');
        Session::forget('cart');
        return redirect('login');
    }

    public function Register(Request $request){
        $input=$request->validate([
            'name'=>'required|string',
            'email'=>'required|email|unique:users',
            'password'=>'required',
            'c_password'=>'required|same:password'
        ]);
        $input['password']=bcrypt($input['password']);
        User::create($input);
        echo '<script>
            alert(" Đăng ký thành công. Vui lòng đăng nhập.");
            window.location.assign("login");
        </script>';
    }


}
