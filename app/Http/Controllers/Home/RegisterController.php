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
    public function getmsg(Request $request)
    {
        $online_id = $request->session()->get('id');
        $send_id = $online_id[0]->id;
        $received_id = (int)$_POST['received_id'];
        $count = DB::select("select count(id) from messages where(received_id={$received_id} and send_id = {$send_id}) or (received_id={$send_id} and send_id = {$received_id})");
        $status = DB::table('user')->where("id","=",$received_id)->pluck('username');
        $num = $count[3]->count(id);
        // $where = "(received_id={$received_id} and send_id = {$send_id}) or (received_id={$send_id} and send_id = {$received_id})"
        $check = DB::select("select * from messages where(received_id={$received_id} and send_id = {$send_id}) or (received_id={$send_id} and send_id = {$received_id}) order by id");
        // dump($status);dump($check);die;
        return response()->json(array($check,$status,$received_id,$num));
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
             return back()->with('error','用户名已存在！~');
        }
    }
}