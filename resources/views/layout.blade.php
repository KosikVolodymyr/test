<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Blog</title>

        <link rel="stylesheet" href="{{ asset('/css/front.css')}}">
        <script type="text/javascript" src="{{ asset('js/front.js')}}"></script>

        <!-- HTML5 shim and Respond.js IE9 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="assets/js/html5shiv.js"></script>
        <script src="assets/js/respond.js"></script>
        <![endif]-->
        
    </head>

    <body>
        <nav class="navbar main-menu navbar-default">
            <div class="container">
                <div class="menu-content">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="/"><h1>Blog</h1></a>
                    </div>


                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav pull-right">
                            @if(Auth::check())
                                <li><a href="/logout">Logout</a></li>
                                <li><span>{{Auth::user()->name}}</span></li>
                            @else
                                <li><a href="/register">Register</a></li>
                                <li><a href="/login">Login</a></li>
                            @endif
                        </ul>
                    </div>


                    <div class="show-search">
                        <form role="search" method="get" id="searchform" action="#">
                            <div>
                                <input type="text" placeholder="Search and hit enter..." name="s" id="s">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <div class="main-content">
            <div class="container">
                @yield('content')
            </div>
        </div>

        <footer class="navbar-fixed-bottom footer-widget-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                            @foreach($browsersList AS $browser)
                                <span>{{$browser->name}}: {{$browser->total}}</span> 
                            @endforeach
                    </div>
                </div>
            </div>
        </footer>
        <script type="text/javascript" src="{{ asset('/vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
    </body>
</html>