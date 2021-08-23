<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>Dashboard|{{ Auth::guard('admin')->user()->name }}</title>
</head>
<body>
    <div class="container">
        <div class="nav navbar">
            <h4>Hello <span class="text-success">{{ Auth::guard('admin')->user()->name}}</span></h4>
            <a href="{{ route('admin.logout') }}" class="btn btn-success">Đăng xuất</a>
        </div>
    </div>
</body>
</html>