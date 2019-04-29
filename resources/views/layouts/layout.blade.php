<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SIGEDUC') }}</title>

        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="{{ asset('lib/admin/bootstrap/css/bootstrap.min.css') }}">
        
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('lib/admin/plugins/datatables/dataTables.bootstrap.css') }}">
        
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        
        <!-- Theme style -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com" />

        <!-- Select2 -->
        <link rel="stylesheet" href="{{ asset('lib/admin/plugins/select2/select2.min.css') }}" />

        <link rel="stylesheet" href="{{ asset('lib/admin/dist/css/AdminLTE.min.css') }}" />
        <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
            page. However, you can choose any other skin. Make sure you
            apply the skin class to the body tag so the changes take effect.
        -->
        <link rel="stylesheet" href="{{ asset('lib/admin/dist/css/skins/skin-blue.min.css') }}" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <!--
    BODY TAG OPTIONS:
    =================
    Apply one or more of the following classes to get the
    desired effect
    |---------------------------------------------------------|
    | SKINS         | skin-blue                               |
    |               | skin-black                              |
    |               | skin-purple                             |
    |               | skin-yellow                             |
    |               | skin-red                                |
    |               | skin-green                              |
    |---------------------------------------------------------|
    |LAYOUT OPTIONS | fixed                                   |
    |               | layout-boxed                            |
    |               | layout-top-nav                          |
    |               | sidebar-collapse                        |
    |               | sidebar-mini                            |
    |---------------------------------------------------------|
    -->

    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <!-- Header -->
            @include('includes.header')

            <!-- Left side column -->
            @include('includes.left-aside')

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    @yield('page-header')
                    @yield('breadcrumb')
                </section>

                <!-- Main content -->
                <section class="content">

                    <!-- Your Page Content Here -->
                    @yield('content')

                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->

            <!-- Footer -->
            @include('includes.footer')

            <!-- Control Sidebar -->
            @include('includes.right-aside')

            <div class="control-sidebar-bg"></div>
        </div><!-- ./wrapper -->

        <!-- REQUIRED JS SCRIPTS -->

        <!-- jQuery 2.1.4 -->
        <script src="{{ asset('lib/admin/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
        <!-- Bootstrap 3.3.5 -->
        <script src="{{ asset('lib/admin/bootstrap/js/bootstrap.min.js') }}"></script>

        <!-- Select2 -->
        <script src="{{ asset('lib/admin/plugins/select2/select2.full.min.js') }}"></script>

        <!-- InputMask -->
        <script src="{{ asset('lib/admin/plugins/input-mask/jquery.inputmask.js') }}"></script>
        <script src="{{ asset('lib/admin/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
        <script src="{{ asset('lib/admin/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>

        <!-- DataTables -->
        <script src="{{ asset('lib/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('lib/admin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
        
        <!-- AdminLTE App -->
        <script src="{{ asset('lib/admin/dist/js/app.min.js') }}"></script>
        
        <!-- Custom -->
        <script src="{{ asset('js/sigeduc.js') }}"></script>
        <script src="{{ asset('js/professor.js') }}"></script>
        <script src="{{ asset('js/aluno.js') }}"></script>
        <script src="{{ asset('js/turma.js') }}"></script>
        <script src="{{ asset('js/funcionario.js') }}"></script>
    </body>

</html>