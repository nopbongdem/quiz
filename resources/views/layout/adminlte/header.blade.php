<header class="main-header">
    <a href="{!! url('/admin/dashboard') !!}" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>G</b>MB</span>
    <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Admin</b>GMB</span>
    </a>

        <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
      <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
                <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-envelope-o"></i>
                        <span class="label label-success">4</span>
                    </a>
                </li>
              <!-- Notifications: style can be found in dropdown.less -->
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning">10</span>
                    </a>
                </li>
              <!-- Tasks: style can be found in dropdown.less -->
                <li class="dropdown tasks-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-flag-o"></i>
                        <span class="label label-danger">9</span>
                    </a>
                </li>
              <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{!! url('/assets/avatar.png') !!}" class="user-image">
                        <span class="hidden-xs">Recycle Bin</span>
                    </a>
                    <ul class="dropdown-menu">
                      <!-- User image -->
                        <li class="user-header">
                            <img src="{!! url('/assets/avatar.png') !!}" class="img-circle">
                            <p>
                                Recycle Bin - Web Developer
                                <small>Member since Nov. 2012</small>
                            </p>
                        </li>
                      <!-- Menu Body -->
                        <li class="user-body">
                            <div class="col-xs-4 text-center">
                                <a href="#">Followers</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Sales</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Friends</a>
                            </div>
                        </li>
                      <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">{!! trans('labels.profile') !!}</a>
                            </div>
                            <div class="pull-right">
                                <a href="{!! url('admin/logout') !!}" class="btn btn-default btn-flat">{!! trans('labels.sign_out') !!}</a>
                            </div>
                        </li>
                    </ul>
                </li>
              <!-- Control Sidebar Toggle Button -->
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>

    </nav>
</header>