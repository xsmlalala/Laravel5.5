<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Auth;
use App\User;
use Gregwar\Captcha\CaptchaBuilder;
use Session;

class RegisterController extends Controller
{
    public function index()
    {
        return view("register.register");
    }
    public function add(Request $request,$id)
    {
        $online_id = $request->session()->get('id');
        $user_id = $online_id[0]->id;
        $other_id = (int)$id;
        $check = DB::table('friends')->insert(
            ['user_id' => $user_id, 'other_id' => $other_id]
        );
        return redirect('/home');
    }
    public function register(Request $request,$id)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        $check = DB::select("select * from user where username='{$username}'");
        if ($check == null) {
            DB::table('user')->insert(
                ['username' => $username, 'password' => $password]
            );
            return redirect('/login');
        }else{
//            return redirect('/login');
             return back()->with('error','用户名已存在！~');
        }
    }
}