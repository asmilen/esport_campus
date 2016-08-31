<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Thủ lĩnh campus</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="{{url('frontend/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('frontend/css/style.css')}}">
</head>

<body>
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="nav navbar-nav">
                <h1><a href="index.html">
                    <img src="images/logo.png" alt="">
                </a></h1>
            </div>
            <div class="navbar-right">
                <a href="" class="btn btn-default" data-toggle="modal" data-target="#frm-login">Đăng nhập</a>
            </div>
        </div>
        <!-- /.container -->
    </nav>
    <div class="img-bnr">
        <img src="images/img-intro.jpg" alt="">
    </div>
    <div class="nav-sub">
        <div class="container">
            <div class="row">
                <ul class="clearfix">
                    <li class="{{ (isset($page) && $page == 'index') ? 'active' : '' }}"><a href="{{url('/')}}">Thông tin</a></li>
                    <li class="{{ (isset($page) && $page == 'vong-1') ? 'active' : '' }}"><a href="{{url('/vong-1/buoc-1')}}">vòng 1: kiến thức</a></li>
                    <li class="{{ (isset($page) && $page == 'vong-2') ? 'active' : '' }}"><a href="{{url('/vong-2')}}">vòng 2: Hoạt động nhóm </a></li>
                    <li class="{{ (isset($page) && $page == 'vong-3') ? 'active' : '' }}"><a href="{{url('/vong-3')}}">Vòng 3: Phỏng vấn</a></li>
                </ul>
            </div>
        </div>
    </div>
    @yield('content')
    <div class="footer">
        <div class="container">
            <p>Esports for Student Campus (ESC) là một mạng lưới các câu lạc bộ dành cho các sinh viên đam mê với thể thao điện tử tại Việt Nam.</p>
        </div>
    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</body>

</html>
