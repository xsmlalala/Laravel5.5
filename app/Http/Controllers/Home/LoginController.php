<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Auth;
use App\User;
use Gregwar\Captcha\CaptchaBuilder;
use Session;

class LoginController extends Controller
{
    public function home(Request $request)
    {
        $username = $request->session()->get('username');
        $id = $request->session()->get('id');
        if($id == null){
            return view("home",['u'=>$username,'id'=>$id]);
        }else{

            $info1 = DB::table('friends')
                ->where('user_id', '=', $id[0]->id)
                ->pluck('other_id');
            $userid_arr = array();
            foreach($info1 as $k1=>$v1){
                $userid_arr[] = $v1;
            }
            $userid_arr[] = $id[0]->id;

            if($info1 == null){
                $info = DB::table('user')
                    ->get();
                $arr = array();
                foreach($info as $k=>$v){
                    if($v->id != $id[0]->id){
                        $arr[] = $v;
                    }
                }
            }else{
                $arr = DB::table('user')
                    ->whereNotIn('id', $userid_arr)
                    ->get();
            }
            return view("home",['info' => $arr,'u'=>$username,'id'=>$id]);
        }
    }
    public function index()
    {
        return view("login.login");
    }
    public function myFriends(Request $request)
    {
        $id = $request->session()->get('id');
        $send_id = $id[0]->id;
        $username = $request->session()->get('username');
        $info1 = DB::table('friends')
            ->where('user_id', '=', $id[0]->id)
            ->pluck('other_id');
        $userid_arr = array();
        foreach($info1 as $k1=>$v1){
            $userid_arr[] = $v1;
        }
        $arr = DB::table('user')
                    ->whereIn('id', $userid_arr)
                    ->get();
        return view("myFriends",['info' => $arr,'u'=>$username,'id'=>$send_id]);
    }
    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        $check = DB::select("select * from user where username='{$username}' and password='{$password}'");
        if ($check != null) {
            $id = DB::select("select id from user where username='{$username}' and password='{$password}'");
            $request->session()->put('username', $username);
            $request->session()->put('id', $id);
            return redirect('/home');
        }else{
             return back()->with('error','密码或者用户名错误');
        }
    }
    public function send_message(Request $request){
        $received_id = (int)$_POST['received_id'];
        $content = $_POST['text'];
        $id = $request->session()->get('id');
        $send_id = $id[0]->id;
        $sendtime = time();
        $check = DB::table('messages')->insert(
            ['content' => $content, 'received_id' => $received_id, 'send_id' => $send_id,'sendtime' => $sendtime]
        );
        return response()->json(array($content,$send_id));
    }
}