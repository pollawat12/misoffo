<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>เข้าระบบ - สำนักงานกองทุนน้ำมันเชื้อเพลิง (สกนช.)</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="สำนักงานกองทุนน้ำมันเชื้อเพลิง (สกนช.)" name="description" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    
    <!-- App css -->
    <link href="{{ url('assets/default') }}/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
    <link href="{{ url('assets/default') }}/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/default') }}/css/app.min.css" rel="stylesheet" type="text/css" id="app-stylesheet" />

    @yield('css')
    
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@200&display=swap" rel="stylesheet">
    <style>
    * {
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
    </style>

</head>

<body class="authentication-bg bg-primary authentication-bg-pattern d-flex align-items-center pb-0 vh-100 dgr-bg-color-custom">

    <div class="home-btn d-none d-sm-block">
        <a href="index.html"><i class="fas fa-home h2 text-white"></i></a>
    </div>

    

    @yield('content')


    @yield('js')

</body>

</html>
