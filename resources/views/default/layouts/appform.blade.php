<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>สำนักงานกองทุนน้ำมันเชื้อเพลิง (สกนช.)</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="สำนักงานกองทุนน้ำมันเชื้อเพลิง (สกนช.)" name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{url('assets/default')}}/images/favicon.ico">

        <link href="{{url('assets/default')}}/libs/jquery-toast/jquery.toast.min.css" rel="stylesheet" type="text/css" />
        <!-- App css -->
        <link href="{{url('assets/default')}}/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
        <link href="{{url('assets/default')}}/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="{{url('assets/default')}}/css/app.min.css" rel="stylesheet" type="text/css"  id="app-stylesheet" />

        @yield('css')
        <!-- Jquery Toast css -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@200&display=swap" rel="stylesheet">
        <style>
        * {
            font-family: 'Sarabun', sans-serif;
            font-size: 16px !important;
        }

        .header-title {
            font-family: 'Sarabun', sans-serif;
            font-size: 16px !important;
        }


        .dgr-color-custom {
            background-color: #3c4655 !important;
            border-color: #3c4655 !important;
        }

        .dgr-bg-color-custom {
            background-color: #3c4655 !important;
        }

        .datepicker {
            z-index: 1900000 !important;
        }

        .jq-toast-wrap {
            width: 300px !important;
            max-width: 300px !important;
        }

        .form-control {
            color: black !important;
        }
        </style>

        <!-- Vendor js -->
        <script src="{{url('assets/default')}}/js/vendor.min.js"></script>
    </head>

    <body style="color: black;">
        <?php 
        $authInfo = \Auth::user();
        ?>
        <!-- Begin page -->
        <div id="wrapper"> 
            
            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->
            <div class="content">

                @yield('content')

                <!-- Footer Start -->
                @include('default.partials.footer')

            </div>

        </div>

        
        <!-- END wrapper -->

        
        <!-- App js -->
        <script src="{{url('assets/default')}}/js/app.min.js"></script>

        <script src="{{URL('assets/js/script.js')}}"></script>

        @yield('js')

        <!-- Tost-->
        <script src="{{url('assets/default')}}/libs/jquery-toast/jquery.toast.min.js"></script>

        <!-- toastr init js-->
        <script src="{{url('assets/default')}}/js/pages/toastr.init.js"></script>
        
    </body>
</html>