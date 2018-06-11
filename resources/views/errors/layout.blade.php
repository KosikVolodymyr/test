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
        <style>
            .errors {
                margin-top: 10%;
            }
            .errors h1 {
                font-size: 80px;
            }
            .errors span {
                display: block;
                font-size: 30px;
            }
        </style>
    </head>

    <body>
       

        <div class="main-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center errors">
                        @yield('error_content')
                    </div>
                </div>
            </div>
        </div>

       
        
    </body>
</html>

