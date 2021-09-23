@extends('admin.layout.master')
@section('content')
@include('admin.layout.message')
<div class="box box-danger">
    <div class="box-header with-border">
        <span class="text-primary">Tạo Admin User mới</span>
    </div>
    <div class="box-body">
        <form action="{{route('admins.store')}}" class="form" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="">Họ tên</label>
                <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}">
                @error('name')
                <p class="text-danger"><i class="fa fa-times-circle"></i> {{$message}}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Username</label>
                <input type="text" name="username" id="username" class="form-control" value="{{old('username')}}">
                @error('username')
                <p class="text-danger"><i class="fa fa-times-circle"></i> {{$message}}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Password</label>
                <input type="password" name="password" id="password" class="form-control" value="{{old('password')}}">
                @error('password')
                <p class="text-danger"><i class="fa fa-times-circle"></i> {{$message}}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="mail" name="email" id="email" class="form-control" value="{{old('email')}}">
                @error('email')
                <p class="text-danger"><i class="fa fa-times-circle"></i> {{$message}}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Ảnh đại diện</label>
                <input type="file" name="avatar" id="avatar" class="form-control">
                @error('avatar')
                <p class="text-danger"><i class="fa fa-times-circle"></i> {{$message}}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Quyền</label>
                <select name="role" id="role" class="form-control">
                    <option value="2" selected>Admin</option>
                    <option value="1">SysAdmin</option>
                </select>
            </div>
            <div class="form-button text-center">
                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
        </form>
    </div>
</div>
@endsection