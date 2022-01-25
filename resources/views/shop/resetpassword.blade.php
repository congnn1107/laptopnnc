<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đặt lại mật khẩu - NNCShop</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <hr class="offset">
    <div class="container">
        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
            <script>
                setTimeout(() => {
                    document.location.href = '{{ route('shop.index') }}';
                }, 2000);
            </script>
        @else
            @if (Session::has('error'))
                <div class="alert alert-danger">
                    {{Session::get('error')}}
                </div>
            @endif
            <form action="{{ route('reset.password.post') }}" enctype="application/x-www-form-urlencoded"
                method="post">
                @csrf
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <div class="form-group @error('password') has-error @enderror">
                            <div class="label">Nhập mật khẩu</div>
                            <input type="password" name="password" id="" placeholder="Nhập mật khẩu mới..."
                                value="{{ old('password') }}" class="form-control">
                            @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4"></div>
                </div>
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <div class="form-group @error('password') has-error @enderror">
                            <div class="label">Xác nhận mật khẩu: </div>
                            <input type="password" name="confirm" id="" placeholder="Nhập lại mật khẩu..."
                                value="{{ old('confirm') }}" class="form-control">
                            @error('confirm')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4"></div>
                </div>
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Đặt lại</button>
                        </div>
                    </div>
                    <div class="col-md-4"></div>
                </div>
                <input type="hidden" name="email" value="{{ $email }}">
                <input type="hidden" name="token" value="{{ $token }}">



            </form>
        @endif
    </div>
</body>

</html>
