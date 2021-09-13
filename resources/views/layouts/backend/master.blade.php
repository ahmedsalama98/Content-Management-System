<!DOCTYPE html>

<html lang="{{ app()->currentLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>@yield('title' , 'Admin')</title>
        <meta name="description" content="@yield('description', 'Admin dashboard')">
        <meta name="csrf_token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Favicons -->
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <link rel="icon" href="/favicon.ico" type="image/x-icon">
        <!-- Custom fonts for this template-->


        <link href="{{ asset('layouts/admin/css/all.min.css') }}" rel="stylesheet" type="text/css">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="{{ asset('layouts/admin/css/sb-admin-2.min.css') }}" rel="stylesheet">





        @yield('style')
    </head>
    <body id="page-top">


        <!-- Page Wrapper -->
        <div id="wrapper">



        @include('layouts.backend._sidebar')



        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">
                @include('layouts.backend._nav')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    @yield('content')


                </div>


            </div>
            @include('layouts.backend._footer')


        </div>

</div>

<!-- End of Page Wrapper -->


        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>





{{--  scripts  --}}


<!-- Bootstrap core JavaScript-->
    <script src="{{ asset('layouts/admin/js/jquery.min.js') }}" ></script>
    <script src="{{ asset('layouts/admin/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('layouts/admin/js/jquery.easing.min.js') }}" ></script>


    <!-- Custom scripts for all pages-->
    <script src="{{ asset('layouts/admin/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('layouts/admin/js/Chart.min.js') }}"></script>

    {{-- <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script> --}}


        @yield('script')
    </body>
</html>
