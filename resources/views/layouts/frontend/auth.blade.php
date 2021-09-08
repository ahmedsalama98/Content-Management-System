<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicons -->
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    {{--  <!-- Google font (font-family: 'Roboto', sans-serif; Poppins ; Satisfy) -->  --}}
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,500,600,600i,700,700i,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <title>@yield('title', 'Login')</title>
    <link  rel="stylesheet" href="{{ asset('layouts/css/login.css') }}">
    <link  rel="stylesheet" href="{{ asset('layouts/css/plugins/material-design-iconic-font.min.css') }}">

    <style>
        .main{
            padding: 50px 0;
        }
        .error{
            display: block;
            margin: 10px 0;
            color: red;
        }

        .material-icons-name {
            font-size: 18px !important;
        }
        input{
            padding: 12px 10px;
        }
        .success{
            background: #37904c;
            display: block;
            width: 400px;

            top: 200px;
            left: 0;
            padding: 15px;
            color: #fff;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <main class="main" >

        @if (session('success'))
            <div class="success">
                {{  session('success')}}
            </div>
        @endif
        @yield('content')

    </main>
</body>
</html>
