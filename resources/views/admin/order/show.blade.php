@extends('admin.layout.master')
@section('content')
    @include('admin.layout.message')
    <div class="box box-primary">
        <div class="box-header with-border">
            <span class="h4 text-muted">Thông tin đơn hàng</span>
        </div>
        <div class="box-body">
            <button class="btn btn-link" onclick="history.back()"><i class="fa fa-caret-left"></i> Trở về</button>

            <h2 class="text-purple">Thông tin khách hàng:</h2>
            @php
                $customer = $order->customer()->first();
            @endphp
            
            <p>Họ và tên: <span class="text-primary"><strong>{{ $customer->name }}</strong></span></p>
            <p>SDT: <span class="text-primary"><strong>{{ $customer->phone }}</strong></span></p>
            <p>Email: <span class="text-primary"><strong>{{ $customer->email }}</strong></span></p>
            <p>ĐC giao hàng: <span class="text-primary"><strong>{{ $order->address }}</strong></span></p>
            <h2 class="text-purple">Danh sách sản phẩm</h2>
            <p>Đơn hàng: <span class="text-primary"><strong>{{$order->order_code}}</strong></span></p>
            <p>Ngày tạo: <span class="text-primary"><strong>{{ $order->created_at }}</strong></span></p>
            <p>Cập nhật: <span class="text-primary"><strong>{{ $order->updated_at }}</strong></span></p>
            <span>Sản phẩm:</span>
            <table class="table">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Sản phẩm</th>
                        <th>Mã sản phẩm</th>
                        <th>Đơn giá</th>
                        <th>KM-Giảm giá</th>
                        <th>Số lượng</th>
                        <th>Giá sau KM</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $sum = 0;
                    @endphp
                    @foreach ($order->detail as $key => $item)
                        @php
                            $product = $item->product()->first();
                            $sum += $item->final_price;
                        @endphp
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->sku }}</td>
                            <td>{{ number_format($item->price) }}</td>
                            <td>{{ number_format($item->discounted) }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ number_format($item->final_price) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <p>
                <span class="h3 pull-right">Tổng tiền: <span
                        class="text-red"><strong>{{ number_format($sum) }}</strong>đ</span></span>
            </p>
            <form action="{{route('order.changeStatus')}}" method="post">
                @csrf
                <input type="hidden" name="order" value="{{ $order->id }}">
                {{-- <input type="hidden" name="admin" value="1"> Thay 1 bằng id của admin --}}
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Trạng thái đơn hàng: </label>
                            <select name="status" class="form-control" @if($order->finished_at) disabled @endif id="">
                                @foreach ($statusArray as $key => $status)
                                    <option value="{{ $key }}" {{ $order->status==$key?'selected':'' }}>{{ $status }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="text-right"><button type="submit" class="btn btn-success">OK</button></div>
                    </div>

                </div>
                
            </form>
            <div class="">
               @if ($order->status==3)
                    <form action="{{route('order.finish',$order->id)}}" method="post" onsubmit="return confirm('Sau khi bấm xác nhận, đơn hàng sẽ không thể thay đổi trạng thái, bạn muốn tiếp tục?')">
                        @csrf
                        <button type="submit" class="btn bg-green pull-right">Hoàn thành đơn hàng</button>
                    </form>
                 
               @endif
                
            </div>
        </div>
    </div>
@endsection
