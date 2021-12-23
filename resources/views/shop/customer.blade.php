@extends('shop.layout.master')
@section('content')
    <hr class="offset-top">
    <div class="container">
        
        <form action="{{ route('shop.user.update') }}" class="white" method="post">
            <hr class="offset">
            <h1 class="h3 text-center">Cập nhật thông tin của bạn:</h1>
            @csrf
            @method('put')
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group @error('name') has-error @enderror">
                            <label for="">Họ Tên: </label>
                            <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control">
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group @error('birthday') has-error @enderror">
                            <label for="">Ngày sinh: </label>
                            <input type="date" name="birthday" value="{{ substr(Auth::user()->birthday, 0, 10) }}"
                                class="form-control">
                            @error('birthday')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group @error('address') has-error @enderror">
                            <label for="">Địa chỉ: </label>
                            <input type="text" name="address" value="{{ Auth::user()->address }}" class="form-control">
                            @error('address')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group @error('gender') has-error @enderror">
                            <label for="">Giới tính: </label>
                            <select name="gender" class="form-control" id="">
                                @foreach (['Nam', 'Nữ'] as $key => $item)
                                    <option value="{{ $key }}" @if (Auth::user()->gender == $key) selected @endif>{{ $item }}
                                    </option>
                                @endforeach
                            </select>

                            @error('gender')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-8">
                        <label for="">Email:</label>
                        <p>{{ Auth::user()->email }}</p>
                    </div>
                    <div class="col-md-3">
                        <label for="">Số điện thoại:</label>
                        <p>{{ Auth::user()->phone }}</p>
                    </div>
                </div>

                <hr>
                <label for="">Đổi mật khẩu:</label>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group @error('old_password') has-error @enderror">
                            <label for="">Mật khẩu cũ: </label>
                            <input type="password" class="form-control" name="old_password" id=""
                                value="{{ old('old_password') }}">
                            @error('old_password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group @error('password') has-error @enderror">
                            <label for="">Mật khẩu mới: </label>
                            <input type="password" class="form-control" name="password" id=""
                                value="{{ old('password') }}">
                            @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group @error('confirm') has-error @enderror">
                            <label for="">Xác nhận mật khẩu: </label>
                            <input type="password" class="form-control" name="confirm" id=""
                                value="{{ old('confirm') }}">
                            @error('confirm')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
            <hr class="offset">
        </form>

    </div>
@endsection
