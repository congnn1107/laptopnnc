@extends('admin.layout.master')
@section('content')
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
    {!!Session::get('error')!!}
</div>
@endif
<div class="box box-primary">
    <div class="box-header with-border">
        <h3>Cập nhật thông tin admin</h3>
    </div>
    <div class="box-body">
        <div style="display:block;margin: 0 auto;width:250px;height:250px">
            <img class="mx-auto" style="display:block; width:100%; height:100%" src="{{asset($admin->avatar)}}" alt="">
        </div>
        <form action="{{route('admins.update',$admin->id)}}" method="post">
            @csrf
            @method('put')
            <input type="hidden" name="id" id="" value="{{$admin->id}}">

            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="">Thay đổi họ tên:</label>
                    <input type="text" name="name" class="form-control" value="{{$admin->name}}">
                    @error('name')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-md-6 form-group">
                    <label for="">Thay đổi username:</label>
                    <input type="text" name="username" class="form-control" value="{{$admin->username}}">
                    @error('username')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 form-group">
                    <label for="">Thay đổi email:</label>
                    <input type="mail" name="email" class="form-control" value="{{$admin->email}}">
                    @error('email')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="">Thay đổi avatar:</label>
                    <input type="file" name="avatar" class="form-control">
                    @error('avatar')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-md-6 form-group">
                    <label for="">Thay đổi Quyền:</label>
                    <select class="form-control" @if($admin->id == Auth::guard('admin')->user()->id) disabled @endif name="role" id="">
                        <option value="2" {{$admin->role==2?"selected":""}}>Admin</option>
                        <option value="1" {{$admin->role==1?"selected":""}}>SysAdmin</option>
                    </select>
                    @error('avatar')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group text-center">
                <button class="form-button btn btn-primary" type="submit">Lưu lại</button>

            </div>

        </form>
        @if($admin->id!=Auth::guard('admin')->user()->id)
        <form action="{{route('admins.destroy',$admin->id)}}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger pull-right">Xóa</button>
        </form>
        @endif

    </div>
</div>
@endsection