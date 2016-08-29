<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header" style="color: #000000" align="middle">Admin</h1>
        </div>

    </div>
    <!-- /.navbar-header -->


    <head>
        <title>Bootstrap Case</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </head>


    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Admin</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="tablinks 1 active">
                    <a href="{{url('quan-li/them-truong')}}">Add University</a>
                </li>
                <li class="tablinks 2 ">
                    <a href="{{url('quan-li/them-cau-hoi')}}">Add Question</a>
                </li>
                <li class="tablinks 3 ">
                    <a href="{{url('quan-li/them-dap-an')}}">Add Answer</a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- /.navbar-static-side -->
</nav>
<script>
    var i, tablinks1,tablinks2,tablinks3;
    $(document).ready(function () {

        tablinks1 = document.getElementsByClassName("tablinks 1");
        tablinks2 = document.getElementsByClassName("tablinks 2");
        tablinks3 = document.getElementsByClassName("tablinks 3");
        if(location.pathname == "/quan-li/them-truong" || location.pathname == "/admin/search" ){
            tablinks1[0].className = tablinks1[0].className.replace(" 1", "1 active");
            tablinks2[0].className = tablinks2[0].className.replace(" active", "");
            tablinks3[0].className = tablinks3[0].className.replace(" active", "");
        }
        if(location.pathname == "/quan-li/them-cau-hoi" ){
            tablinks1[0].className = tablinks1[0].className.replace(" active", "");
            tablinks2[0].className = tablinks2[0].className.replace(" 2", "2 active");
            tablinks3[0].className = tablinks3[0].className.replace(" active", "");
        }
        if(location.pathname == "/quan-li/them-dap-an" ){
            tablinks1[0].className = tablinks1[0].className.replace(" active", "");
            tablinks2[0].className = tablinks2[0].className.replace(" active", "");
            tablinks3[0].className = tablinks3[0].className.replace(" 3", "3 active");
        }
    });

</script>