@extends('admin.layout.master')
@section('content')
    @include('admin.layout.message')
    <div class="box box-primary">
        <div class="box-header with-border">
            <span class="h2">Thông tin cá nhân:</span>

        </div>
        @php
            $user = Auth::guard('admin')->user();
        @endphp
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <h3>Thông tin cá nhân: </h3>
                    <p><i>Họ tên: </i> <b>{{ $user->name }}</b></p>

                    {{-- <p><i>SDT: </i> <b>{{$user->phone}}</b></p> --}}
                    <p><i>Email: </i> <b>{{ $user->email }}</b></p>
                    <p><i>Tên đăng nhập: </i> <b>{{ $user->username }}</b></p>
                    <p><i>Ngày thêm: </i> <b>{{ $user->created_at }}</b></p>
                </div>
                <div class="col-md-6">
                    <h3>Đổi mật khẩu</h3>
                    <form action="{{ route('dashboard.profile.update') }}" method="post">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group @error('old_password') has-error @enderror">
                                    <label for="">Mật khẩu cũ: </label>
                                    <input type="password" name="old_password" id="" class="form-control"
                                        value="{{ old('old_password') }}">
                                    @error('old_password')
                                        <div class="alert alert-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group @error('password') has-error @enderror">
                                    <label for="">Mật khẩu mới: </label>
                                    <input type="password" name="password" id="" class="form-control"
                                        value="{{ old('password') }}">
                                    @error('password')
                                        <div class="alert alert-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group @error('confirm') has-error @enderror">
                                    <label for=""> Xác nhận mật khẩu: </label>
                                    <input type="password" name="confirm" id="" class="form-control"
                                        value="{{ old('confirm') }}">
                                    @error('confirm')
                                        <div class="alert alert-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Lưu</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
