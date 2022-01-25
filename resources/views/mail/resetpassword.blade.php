<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đặt lại mật khẩu - NNCShop</title>
    <style>
        .container {
            width: 60%;
            margin: 0 auto;
        }

        .btn {
            text-decoration: none;
            background-color: rgb(74, 115, 247);
            display: inline-block;
            margin: 0 auto;
            padding: 5px 10px;
            border-radius: 3px;
            cursor: pointer;


        }


        h3 {
            color: rgba(59, 59, 165, 0.836)
        }

        p {
            color: gray;
        }

    </style>
</head>

<body>
    <div class="container">
        <h3>Đặt lại mật khẩu của bạn</h3>
        <p>Nhấn vào link sau để đặt lại mật khẩu:
            <a href="{{ route('reset.password.get', $data) }}" style="color: white; width: 150px" class="btn btn-primary"
                target="_blank" rel="noopener noreferrer">Đặt lại mật khẩu</a>
        </p>


    </div>
</body>

</html>
