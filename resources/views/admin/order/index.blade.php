@extends('admin.layout.master')
@section('page-title')
    Quản lý đơn hàng
@endsection
@section('breadcrumb')
    @parent
    <li>Quản lý đơn hàng</li>
@endsection
@section('content')
    @include('admin.layout.message')
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <div class="info-box-icon bg-yellow">
                    <i class="fa fa-hourglass-half"></i>
                </div>
                <div class="info-box-content">
                    <div class="info-box-text">Chờ xác nhận</div>

                    <div class="info-box-number">{{$orders->where('status',0)->count()}}</div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <div class="info-box-icon bg-orange">
                    <i class="fa fa-calendar-check-o"></i>
                </div>
                <div class="info-box-content">
                    <div class="info-box-text">Đã xác nhận</div>
                    <div class="info-box-number">{{$orders->where('status',1)->count()}}</div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <div class="info-box-icon bg-blue">
                    <i class="fa fa-send-o"></i>
                </div>
                <div class="info-box-content">
                    <div class="info-box-text">Đang giao hàng</div>
                    <div class="info-box-number">{{$orders->where('status',2)->count()}}</div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <div class="info-box-icon bg-green">
                    <i class="fa fa-check-circle-o"></i>
                </div>
                <div class="info-box-content">
                    <div class="info-box-text">Đã giao</div>
                    <div class="info-box-number">{{$orders->where('status',3)->count()}}</div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <div class="info-box-icon bg-red">
                    <i class="fa fa-times-circle-o"></i>
                </div>
                <div class="info-box-content">
                    <div class="info-box-text">Đã hủy</div>
                    <div class="info-box-number">{{$orders->where('status',4)->count()}}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="box box-primary">
        <div class="box-header with-border">
            <span class="h4 text-muted text-uppercase">
                 Danh sách đơn hàng
            </span>
        </div>
        <div class="box-body">
            <a href="{{ route('order.create') }}" class="btn btn-primary">Tạo hóa đơn mới</a>
            <br>
            <br>
            <br>
            <div class="table">
                <table class="table" id="orderTable">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Mã đơn hàng</th>
                        <th>Tên khách hàng</th>
                        <th>Địa chỉ nhận</th>
                        <th>SDT nhận</th>
                        <th>Trạng thái</th>
                        <th>Tùy chọn</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($orders as $key=> $item)
                        
                   
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$item->order_code}}</td>
                        <td>{{$item->customer()->first()->name}}</td>
                        <td>{{$item->address}}</td>
                        <td>{{$item->phone}}</td>
                        <td><span class="bg-{{$colorLabel[$item->status]}} label">{{$statusArray[$item->status]}}</span></td>
                        <td>
                            <a href="{{route('order.show',$item->id)}}" title="Cập nhật" class="btn"><i class="fa fa-edit text-green"></i></a>
                            <a href="" title="Hủy đơn hàng" class="btn"><i class="fa fa-trash text-red"></i></a>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(()=>{
            $('#orderTable').dataTable();
        })
    </script>
@endsection