<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test gửi mail</title>
    <style>
        h1{
            color: violet;
        }
        table{
            border-collapse: collapse;
        }
        table a{
            display: block;
        }
        table img{
            display: block;
            width: 50px;
        }
        .total{
            color: red;
        }
    </style>
</head>
<body>

    <div class="wrapper">
        <span>Laptop NNC</span>
        <h1>{{$detail['title']}}</h1>
        @php
            $order=$detail['order'];
            $customer=$order->customer()->first();
            $total = 0;
        @endphp
        <p>Mã đơn hàng: <b>{{$order->order_code}}</b> </p>
        <p>Khách hàng: <b>{{$customer->name}}</b> </p>
        <p>SDT: <b>{{$customer->phone}}</b> </p>
        <p>Email: <b>{{$customer->email}}</b> </p>
        <p>Giao hàng đến: <b>{{$order->address}}</b></p>
        <p>Chi tiết đơn hàng: </p>
        <table border="1">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Hình minh họa</th>
                    <th>Sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Khuyến mại</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->detail()->with('product')->get() as $number => $item)
                    @php
                        $product = $item->product()->first();
                    @endphp
                    <tr>
                        <td>{{$number+1}}</td>
                        <td>
                            <a href="{{route('shop.product.show',$product->slug)}}" target="_blank">
                                <img src="{{asset('storage/'.$product->card_image)}}" alt="{{$product->name}}" srcset="">
                            </a>
                        </td>
                        <td>{{$product->name}}</td>
                        <td>{{$item->quantity}}</td>
                        <td>{{number_format($item->price)}} vnđ</td>
                        <td>{{number_format($item->discounted)}} vnđ</td>
                        <td>{{number_format($item->final_price)}} vnđ</td>
                        @php
                            
                            $total+=$item->final_price;
                        @endphp
                    </tr>
                @endforeach
            </tbody>
        </table>
        <p>Tổng: <b class="total">{{number_format($total)}} vnđ</b></p>
    </div>
    
</body>
</html>