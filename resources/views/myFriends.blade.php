<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="_token" content="{{ csrf_token() }}"/>

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 60vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    @if($id != '')
                    Laravel 欢迎 {{$u}}
                    @else
                    Laravel 111
                    @endif
                </div>

                <div class="links">
                    @if($id != '')
                    <a href="{{ url('/home') }}">首页</a>
                    <a href="{{ url('/center') }}">个人中心</a>
                    <a href="{{ url('/myFriends') }}">我的好友</a>
                    @else
                    <a href="{{ url('/login') }}">登录</a>
                    @endif
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="{{ url('/register') }}">注册</a>
                </div><br><br><br><br>
                @if($id != '')
                <div class="links" style="border:1px solid white;margin-left: 0%;float:left;">
                    @foreach ($info as $v)
                        <!-- <a href="{{url('/chat',$v->id)}}"><button>{{ $v->username }}</button></a><br><br> -->
                        <button onclick="chat({{$v->id}})">{{ $v->username }}</button><br><br>
                    @endforeach
                </div>
                <div class="links" id="dialog_box" style="border:1px solid red;float:left;width:72%;height:500px;margin-left: 20px;display:none">
                    <button style="margin-left: -80%">11111</button><br><br>
                    <button style="margin-left:  80%">22222</button><br><br>
                </div>
                @endif
            </div>
        </div>
       <!--  <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>  -->
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="https://cdn.bootcss.com/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.bootcss.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script type="text/javascript">
            function chat(type){
                $("#dialog_box").css("display","block");
                var received_id = type;
                alert(received_id);
                $.ajax({
                    type:'post',
                    url:"{{url('/getmsg')}}",
                    data:{received_id:received_id},
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    success:function(data){
                        console.log(data);
                        $str = "";
                        for(var i-0;i<result.data.length;i++){
                            user=result.data[i];
                            for(var k in user){
                                user[i]=k; //将key值存入user数组中
                                userv[i]=obj[k]; //将value值存入userva数组中
                            }
                        }
                        $("#msg").html(data.msg);
                    }
                });
            }
        </script>
    </body>
</html>
