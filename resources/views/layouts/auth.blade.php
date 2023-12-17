<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> {{get_option('site_title') && get_option('site_title') != '' ? get_option('site_title') : 'Sadik'}} | Log in</title>
    <link rel="icon" href="{{ asset('images/sfavicon.png') }}" type="image/gif" sizes="64x64">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/smart-forms56b8.css?version=4.2') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/smart-addons.css') }}">
    <!--font-fontawesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
        integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
        integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Montez&display=swap" rel="stylesheet">
<!-- Parslay.min.css -->
<link rel="stylesheet" href="{{ asset('assets/css/parsley.css') }}">
    <style>
        .smart-forms .form-footer {
            background: transparent;
        }

        .smart-forms .button i {
            font-size: 20px;
            margin-right: 10px;
        }

        .col-md-7 {
            position: ;
        }

        .footer-content {
            position: absolute;
            bottom: 20px;
            left: 40px;
        }

        a:hover {
            text-decoration: none;
        }

        .style-font {
            font-family: 'Montez', cursive;
        }
    </style>
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        
  
        @yield('content')

    </div>

    <!-- jQuery -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <!-- Popper js -->
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/js/bootstrap.min.js')}} "></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('auth/js/theme.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/parsley.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('install/js/growl.min.js') }}"></script>
    <script async src="https://unpkg.com/typer-dot-js@0.1.0/typer.js"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function notify(message, type){
            $.growl({
                message: message
            },{
                type: type,
                allow_dismiss: true,
                label: 'Cancel',
                className: 'btn-xs btn-inverse',
                placement: {
                    from: "top",
                    align: "right"
                },
                delay: 5000,
                animate: {
                        enter: 'animated fadeInRight',
                        exit: 'animated fadeOutRight'
                },
                offset: {
                    x: 30,
                    y: 30
                }
            });
        };
    </script>
    @yield('scripts')
    </body>
</html>
