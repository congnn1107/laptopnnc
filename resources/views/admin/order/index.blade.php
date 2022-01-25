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

                    <div class="info-box-number">{{$counts[0]}}</div>
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
                    <div class="info-box-number">{{$counts[1]}}</div>
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
                    <div class="info-box-number">{{$counts[2]}}</div>
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
                    <div class="info-box-number">{{$counts[3]}}</div>
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
                    <div class="info-box-number">{{$counts[4]}}</div>
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
            <form action="{{route('order.index')}}" method="get">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Từ ngày:</label>
                                    <input type="date" class="form-control" value="{{request()->query('from')}}" name="from" id="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Đến ngày:</label>
                                    <input type="date" class="form-control" value="{{request()->query('to')}}" name="to" id="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Trạng thái: </label>
                            <select name="status" id="" class="form-control">
                                <option value="-1">Chọn</option>
                                @foreach ($statusArray as $key => $item)
                                    <option value="{{ $key }}" @if(request()->query('status')===$key) selected @endif>{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary">Lọc</button>
                            <a href="{{ route('order.index') }}" class="btn">Hủy bộ lọc</a>
                        </div>
                    </div>
                </div>
            </form>
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
                        <th>Thời gian</th>
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
                        <td>{{$item->created_at}}</td>
                        <td><span class="bg-{{$colorLabel[$item->status]}} label">{{$statusArray[$item->status]}}</span></td>
                        <td>
                            <a href="{{route('order.show',$item->id)}}" title="Cập nhật" class="btn"><i class="fa fa-edit text-green"></i></a>
                            
                            <form class="" onsubmit="return confirm('Bạn có chắc muốn xóa đơn hàng?')" style="display:inline" action="{{route('order.destroy',$item->id)}}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" title="Xóa đơn hàng" class="btn btn-link"><i class="fa fa-trash text-red"></i></button>
                            </form>
                            
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