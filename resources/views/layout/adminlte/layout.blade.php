<!DOCTYPE html>
<html lang="vi">
    <head>
        <meta charset="UTF-8">
        <title>Admin | Quiz</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.4 -->
        {!! Html::style('/assets/bootstrap-3.3.4-dist/css/bootstrap.min.css') !!}
        <!-- Font Awesome Icons -->

        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />

        {!! Html::style('http://cdn.materialdesignicons.com/1.1.34/css/materialdesignicons.min.css') !!}
        {!! Html::style('/AdminLTE/plugins/datatables/dataTables.bootstrap.css') !!}
        <!-- jvectormap -->
        {!! Html::style('/AdminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.css') !!}
        <!-- Theme style -->
        {!! Html::style('/AdminLTE/dist/css/AdminLTE.min.css') !!}
        {!! Html::style('/AdminLTE/dist/css/skins/_all-skins.min.css') !!}
        {!! Html::style('/assets/css/style.css') !!}

        @yield('style')


        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue sidebar-mini">
        <div class="wrapper">

            @include('layout.adminlte.header')
          <!-- Left side column. contains the logo and sidebar -->
            @include('layout.adminlte.sidebar')


          <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
            <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>Dashboard<small>Version 2.0</small></h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="contents"> @yield('content') </div>
                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->

          @include('layout.adminlte.footer')
          <!-- Add the sidebar's background. This div must be placed
               immediately after the control sidebar -->
          <div class='control-sidebar-bg'></div>

        </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
        {!! HTML::script('/AdminLTE/plugins/jQuery/jQuery-2.1.4.min.js') !!}
        <!-- Bootstrap 3.3.2 JS -->
        {!! HTML::script('/assets/bootstrap-3.3.4-dist/js/bootstrap.min.js') !!}
        <!-- FastClick -->
        {!! HTML::script('/AdminLTE/plugins/fastclick/fastclick.min.js') !!}

        <!-- AdminLTE App -->
        {!! HTML::script('/AdminLTE/dist/js/app.min.js') !!}

        <!-- Sparkline -->
        {!! HTML::script('/AdminLTE/plugins/sparkline/jquery.sparkline.min.js') !!}

        <!-- jvectormap -->
        {!! HTML::script('/AdminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') !!}
        {!! HTML::script('/AdminLTE/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') !!}

        <!-- SlimScroll 1.3.0 -->
        {!! HTML::script('/AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js') !!}

        <!-- ChartJS 1.0.1 -->
        {!! HTML::script('/AdminLTE/plugins/chartjs/Chart.min.js') !!}


        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        {!! HTML::script('/AdminLTE/dist/js/pages/dashboard2.js') !!}


        <!-- AdminLTE for demo purposes -->
        {!! HTML::script('/AdminLTE/dist/js/demo.js') !!}


        @yield('script')
  </body>
</html>