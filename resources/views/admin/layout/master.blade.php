<!DOCTYPE html>
<html lang="en">
@include('admin.layout.head')
<body class="hold-transition skin-purple-light sidebar-mini">
    
    <div class="wrapper">
        @include('admin.layout.main_header')

        <!-- Left-side menu -->
        @include('admin.layout.left_side')
        
        <!-- Content -->
        <div class="content-wrapper">
            @include('admin.layout.breadcrum')
            <section class="content">
                @yield('content')
            </section>
        </div>
           <!-- Footer -->
        @include('admin.layout.main_footer') 
    </div>
 
    <!-- Control setting for side bar -->
</body>
</html>