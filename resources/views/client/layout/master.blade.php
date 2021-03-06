<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>@yield('title')</title>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <link rel="icon" href="/img/favicon.png">
        <link href="/vendor/client/bootstrap/css/bootstrap.min.css" media="all" rel="stylesheet" type="text/css" />
        <link href="/vendor/client/fontawesome/css/all.css" media="all" rel="stylesheet" type="text/css" />
        <link href="/vendor/client/sb-admin/sb-admin.css" media="all" rel="stylesheet" type="text/css" />
        <link href="/css/client/common.css" media="all" rel="stylesheet" type="text/css" />
        <link href="/css/client/dataTables.bootstrap4.css" media="all" rel="stylesheet" type="text/css" />
        @stack('css')
    </head>
    <body class="fixed-nav sticky-footer bg-dark" id="page-top" data-class="sidenav-toggled">
        @include('client.component.layout.sidebar')
        <div class="content-wrapper">
            <div class="container-fluid">
                @yield('content')
            </div>
            <footer class="sticky-footer">
                <div class="container">
                    <div class="text-center">Copyright © <?php echo date('Y'); ?></div>
                </div>
            </footer>
            <!-- Scroll to Top Button-->
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fa fa-angle-up"></i>
            </a>
        </div>
        <script type="text/javascript" src="/vendor/client/jquery/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="/vendor/client/jquery/jquery.easing.min.js"></script>
        <script type="text/javascript" src="/vendor/client/bootstrap/js/popper.min.js"></script>
        <script type="text/javascript" src="/vendor/client/bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="/vendor/client/sb-admin/sb-admin.min.js"></script>
        <script type="text/javascript" src="/js/client/app.js"></script>
        @stack('js')
    </body>
</html>
