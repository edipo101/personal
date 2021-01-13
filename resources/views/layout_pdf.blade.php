<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Reporte PDF')</title>
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="{{asset('css/pdf.css')}}">
</head>
<body>
    <div class="container" style="width: 1310px;">
        <section class="content">
            @yield('content')
        </section>
    </div>
</body>
</html>