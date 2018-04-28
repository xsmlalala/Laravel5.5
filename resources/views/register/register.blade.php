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
                    注册
                </div>
                <form action="{{url('/registerinfo')}}" method="post">
                <div class="links">
                    {{csrf_field()}}
                   用户名：<input type="text" name='username' placeholder="请输入用户名"><br><br><br>
                   密&nbsp;&nbsp;&nbsp;码：<input type="password" name='password' placeholder="请输入密码"><br><br><br>
                   确认密码：<input type="password" name='password1' placeholder="请再次输入密码"><br><br><br>
                    <input type="submit" value="注册"><a href="{{url('/login')}}"><input type="button" value="登录"></a>
                </div>
                </form>
            </div>
        </div>
    </body>
</html>
