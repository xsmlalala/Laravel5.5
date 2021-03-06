<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

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
                    Laravel 
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
                <div class="links">
                    @foreach ($info as $v)
                        <span>{{ $v->username }}</span>&nbsp;&nbsp;&nbsp;<button><a href="{{url('/add',$v->id)}}">加好友</a></button><br><br>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </body>
</html>
