
<!-- Content Header (Page header) -->
<section class="content-header">
      <h1>
        @hasSection ('page-title')
        @yield('page-title')
        @else
        Dashboard
        <small>Version 2.0</small>
        @endif
        

        
      </h1>
      
      <ol class="breadcrumb">
        @section('breadcrumb')
        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>Home</a></li>
        @show
        
      </ol>
</section>

