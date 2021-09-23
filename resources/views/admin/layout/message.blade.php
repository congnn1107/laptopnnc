@if(Session::get('success'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-check"></i> Thành Công!</h4>
    {{Session::get('success')}}
</div>
@endif
@if(Session::get('error'))
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-ban"></i> Lỗi!</h4>
    {{Session::get('error')}}
</div>
@endif