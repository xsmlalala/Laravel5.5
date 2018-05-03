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

            #button{
                margin-left: 88%;
                height:24px;
                width:50px;
            }
            #dialog_box{
                background: -webkit-linear-gradient(top,white,lightblue,skyblue);
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
                <input type="hidden" id='send_id' name="send_id" value="{{$id}}">
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
                <div class="links" id="dialog_box" style="border:1px solid white;float:left;width:72%;height:530px;margin-left: 20px;display:none;">
                    <div id="received_user" style="float:left;width:90%;height:27px;margin-left: 20px;display:block">
                        
                    </div>
                    <div id="messages" style="float:left;width:90%;height:372px;margin-left: 20px;display:block">
                       <!--  <button style="margin-left: -80%">11111</button><br><br>
                        <button style="margin-left:  80%">22222</button><br><br> -->
                    </div>
                    <div id="send_message" style="float:left;width:90%;height:125px;margin-left: 20px;display:block">
                        <!-- <textarea rows="8" cols="51" autofocus></textarea> -->
                        <textarea rows="6" cols="54" style= "overflow:hidden; resize:none;border:0;background-color:transparent;" name="content" id="text" autofocus></textarea>
                        <button id='button' onclick="send_message()">发送</button>
                    </div>
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
                $("#dialog_box").css("display","none");
                var send_id = $("#send_id").val();
                var received_id = type;
                $.ajax({
                    type:'post',
                    url:"{{url('/getmsg')}}",
                    data:{received_id:received_id},
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    success:function(data){ 
                        console.log(data);
                        var str = "";
                        for(var i=0;i<data[0].length;i++){
                            if(data[0][i].send_id == send_id){
                                str += "<button style='margin-right:  -76%'>"+data[0][i].content+"</button><br><br>";
                            }else{
                                str += "<button style='margin-left:  -76%'>"+data[0][i].content+"</button><br><br>";
                            }
                        }
                        var str2 = "<span style='font-size:18px;color:#0c0;font-weight:bold;'>"+data[1]+"</span><input type='hidden' id='received_id' value='"+data[2]+"'>";
                        $("#dialog_box").css("display","block");
                        $("#messages").html(str);
                        $("#received_user").html(str2);
                    }
                });
            }
            function send_message(){
                var received_id = $("#received_id").val();
                var text = $("#text").val();
                $.ajax({
                    type:'post',
                    url:"{{url('/send_message')}}",
                    data:{received_id:received_id,text:text},
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    success:function(data){
                        console.log(data);
                        var str = "";
                        if(data[1] == send_id){
                            str += "<button style='margin-left:  -76%'>"+data[0]+"</button><br><br>";
                        }else{
                            str += "<button style='margin-right:  -76%'>"+data[0]+"</button><br><br>";
                        }
                        $("#messages").append(str);
                        $("#text").val("");
                    }
                });
            }
        </script>
    </body>
</html>
