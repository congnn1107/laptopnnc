<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Admin</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <script src="{{asset('js/app.js')}}"></script>
</head>
<body>
    <div class="container">
       
        <div class="row" style="margin-top: 90px;">
            <div class="col-md-4 col-md-offset-4" style="margin: auto">
                <form class="form" action="{{route('admin.check')}}" method="post">
                    @csrf
                    <h4>Đăng Nhập | LAPTOP NNC</h4><hr>
                    @if(Session::get('message'))
                        <p class="alert alert-danger">{{ Session::get('message') }}</p>
                    @endif
                    @csrf
                    <div class="form-group">
                        <label for="#username" class="form-label">Tên đăng nhập: </label>
                        <input type="text" name="username" id="username" class="form-control" placeholder="Nhập tên đăng nhập..." value="{{ old('username') }}">
                        @error('username')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Mật khẩu: </label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Nhập mật khẩu..." value="{{ old('password') }}">
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        Ghi nhớ đăng nhập
                        <input type="checkbox" name="remember" id="remember" >
                    </div>
                    <button type="submit" title="Đăng nhập" class="form-submit btn btn-block btn-primary">Login</button>
                </form>
                <a href="/">Quay lại trang shop?</a>
            </div>
        </div>
    </div>
</body>
</html>