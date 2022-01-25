@extends('shop.layout.master')
@section('headdoc')
    @parent
    {{-- <link rel="stylesheet" href="{{asset('bower_components\bootstrap\dist\css\bootstrap.min.css')}}"> --}}

    <link rel="stylesheet" href="{{ asset('bower_components\datatables.net-bs\css\dataTables.bootstrap.css') }}">
@endsection
@section('title')
    Lịch sử mua hàng
@endsection
@section('content')
    <hr class="offset-top">
    <div class="container">
        <h1 class="h3">Lịch sử mua hàng</h1>
        <hr class="offset">
        <div class="white">
            <hr class="offset">
            
            <h2 class="text-center">Lịch sử mua hàng của bạn</h2>
            <div class="container">
                @include('admin.layout.message')
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mã Đơn hàng</th>
                            <th>Ngày đặt</th>
                            <th>Thông tin giao hàng</th>
                            <th>Sản phẩm</th>
                            <th>Giá trị</th>
                            <th>Trạng thái</th>
                            <th>Tùy chọn</th>
                        </tr>
                    </thead>
                    <tbody class="">
                        @foreach (Auth::user()->customer()->with('order')->get()
        as $customer)
                            @foreach ($customer->order()->with('detail')->orderBy('created_at', 'desc')->get()
        as $key => $order)
                                @php
                                    $total = 0;
                                @endphp
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $order->order_code }}</td>

                                    <td>{{ $order->created_at }}</td>
                                    <td>
                                        {{ "$customer->name, $customer->phone, $customer->address" }}
                                    </td>
                                    <td>
                                        <ul>
                                            @foreach ($order->detail()->with('product')->get()
        as $detail)
                                                <li>
                                                    @php
                                                        $product = $detail->product()->first();
                                                        $total += $detail->final_price;
                                                    @endphp
                                                    <a href="{{ route('shop.product.show', $product->slug) }}"><span
                                                            style="word-break: break-all">{{ $product->name }}</span>
                                                        <span
                                                            style="margin-left: auto; background-color: red; color: white; padding: 2px 3px; border-radius: 3px;">{{ number_format($detail->final_price) }}đ</span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        {{ number_format($total) }} đ
                                    </td>
                                    <td>
                                        {{ $statusArray[$order->status] }}
                                    </td>
                                    <td>
                                        @if ($order->status < 2)
                                            <a href="{{route('shop.history.cancel',$order->order_code)}}" class="btn btn-link" onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng?')" title="Hủy đơn hàng"><i class="fa fa-times text-danger"></i></a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
            <hr class="offset">
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    {{-- <script src="{{asset('bower_components\bootstrap\dist\js\bootstrap.min.js')}}"></script> --}}
    <script src="{{ asset('bower_components\datatables.net\js\jquery.dataTables.min.js') }}"></script>
    <script>
        $(document).ready(() => {
            // $('table').DataTable();
        })
    </script>
@endsection
