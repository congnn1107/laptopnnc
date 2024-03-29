<header class="main-header">

<!-- Logo -->
<a href="{{route('admin.dashboard')}}" class="logo">
  <!-- mini logo for sidebar mini 50x50 pixels -->
  <span class="logo-mini">NNC</span>
  <!-- logo for regular state and mobile devices -->
  <span class="logo-lg"> Admin | {{config('app.name')}} </span>
</a>

<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top">
  <!-- Sidebar toggle button-->
  <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
    <span class="sr-only">Toggle navigation</span>
  </a>
  <!-- Navbar Right Menu -->
  <div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
      <!-- Notifications: style can be found in dropdown.less -->
      {{-- <li class="dropdown notifications-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <i class="fa fa-bell-o"></i>
          <span class="label label-warning">10</span>
        </a>
        <ul class="dropdown-menu">
          <li class="header">You have 10 notifications</li>
          <li>
            <!-- inner menu: contains the actual data -->
            <ul class="menu">
              <li>
                <a href="#">
                  <i class="fa fa-users text-aqua"></i> 5 new members joined today
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                  page and may cause design problems
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="fa fa-users text-red"></i> 5 new members joined
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="fa fa-user text-red"></i> You changed your username
                </a>
              </li>
            </ul>
          </li>
          <li class="footer"><a href="#">View all</a></li>
        </ul>
      </li> --}}
      <!-- User Account: style can be found in dropdown.less -->
      <li class="dropdown user user-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <img src="@if(Auth::guard('admin')->check()) {{asset(Auth::guard('admin')->user()->avatar)}} @else {{asset('images/default-user.jpg')}} @endif" class="user-image" alt="User Image">
          <span class="hidden-xs">
              @if(Auth::guard('admin')->check())
                 {{Auth::guard('admin')->user()->name}}
              @else
                Test Admin Name
              @endif
            </span>
        </a>
        <ul class="dropdown-menu">
          <!-- User image -->
          <li class="user-header">
            <img src="@if(Auth::guard('admin')->check()) {{asset(Auth::guard('admin')->user()->avatar)}} @else {{asset('images/default-user.jpg')}} @endif" class="img-circle" alt="User Image">

            <p>
            @if(Auth::guard('admin')->check())
                 {{Auth::guard('admin')->user()->name}} -  {{Auth::guard('admin')->user()->role()->first()->name}}
                 <small>{{Auth::guard('admin')->user()->created_at}}</small>
            @else
                Test Admin Name - Test Role
                <small>Member since Nov. 2012</small>
            @endif
              
              
            </p>
          </li>
          <!-- Menu Body -->
          <!-- <li class="user-body">
            <div class="row">
              <div class="col-xs-4 text-center">
                <a href="#">Followers</a>
              </div>
              <div class="col-xs-4 text-center">
                <a href="#">Sales</a>
              </div>
              <div class="col-xs-4 text-center">
                <a href="#">Friends</a>
              </div>
            </div> -->
            <!-- /.row -->
          </li>
          <!-- Menu Footer-->
          <li class="user-footer">
            <div class="pull-left">
              <a href="{{route('dashboard.profile')}}" class="btn btn-default btn-flat">TT Cá nhân</a>
            </div>
            <div class="pull-right">
              <a href="{{route('admin.logout')}}" class="btn btn-default btn-flat">Đăng xuất</a>
            </div>
          </li>
        </ul>
      </li>
    </ul>
  </div>

</nav>
</header>