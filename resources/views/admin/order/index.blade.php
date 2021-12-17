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
                    <div class="info-box-number">1</div>
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
                    <div class="info-box-number">1</div>
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
                    <div class="info-box-number">2</div>
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
                    <div class="info-box-number">1</div>
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
                    <div class="info-box-number">1</div>
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
                    <tr>
                        <td>1</td>
                        <td>HDJHJBHG01</td>
                        <td>Nguyễn Văn A</td>
                        <td>Khu 1, Xã Thượng Nông, Huyện Tam Nông, Phú Thọ</td>
                        <td>0315452452</td>
                        <td><span class="bg-yellow label">Chờ xác nhận</span></td>
                        <td>
                            <a href="" title="Cập nhật" class="btn"><i class="fa fa-edit text-green"></i></a>
                            <a href="" title="Xóa" class="btn"><i class="fa fa-trash text-red"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>HDJHJBHG02</td>
                        <td>Trần Thị B</td>
                        <td>Khu 2, Xã Thượng Nông, Huyện Tam Nông, Phú Thọ</td>
                        <td>0316553378</td>
                        <td><span class="bg-green label">Đã giao hàng</span></td>
                        <td>
                            <a href="" title="Cập nhật" class="btn"><i class="fa fa-edit text-green"></i></a>
                            <a href="" title="Xóa" class="btn"><i class="fa fa-trash text-red"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>HDJHJBHG03</td>
                        <td>Bùi Như Lạc</td>
                        <td>Số 10 An Đào A, TT. Trâu Quỳ, Gia Lâm, Hà Nội</td>
                        <td>0325526536</td>
                        <td><span class="bg-blue label">Đang giao hàng</span></td>
                        <td>
                            <a href="" title="Cập nhật" class="btn"><i class="fa fa-edit text-green"></i></a>
                            <a href="" title="Xóa" class="btn"><i class="fa fa-trash text-red"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>HDJHJBHG04</td>
                        <td>Mai Anh Bảo</td>
                        <td>Xóm Lá, Xã Dậu Dương, Huyện Tam Nông, Phú Thọ</td>
                        <td>0315452452</td>
                        <td><span class="bg-blue label">Đang giao hàng</span></td>
                        <td>
                            <a href="" title="Cập nhật" class="btn"><i class="fa fa-edit text-green"></i></a>
                            <a href="" title="Xóa" class="btn"><i class="fa fa-trash text-red"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>HDJHJBHG05</td>
                        <td>Ngô Toàn Cà</td>
                        <td>Khu 3, TT. Thanh Thủy, Huyện Thanh Thủy, Phú Thọ</td>
                        <td>0315452452</td>
                        <td><span class="bg-orange label">Đã xác nhận</span></td>
                        <td>
                            <a href="" title="Cập nhật" class="btn"><i class="fa fa-edit text-green"></i></a>
                            <a href="" title="Xóa" class="btn"><i class="fa fa-trash text-red"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>HDJHJBHG06</td>
                        <td>Mai Thanh Toán</td>
                        <td>Xóm 11, Xã Giáp Sơn, Huyện Lục Ngạn, Bắc Giang</td>
                        <td>0315452452</td>
                        <td><span class="bg-red label">Đã hủy</span></td>
                        <td>
                            <a href="" title="Cập nhật" class="btn"><i class="fa fa-edit text-green"></i></a>
                            <a href="" title="Xóa" class="btn"><i class="fa fa-trash text-red"></i></a>
                        </td>
                    </tr>
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