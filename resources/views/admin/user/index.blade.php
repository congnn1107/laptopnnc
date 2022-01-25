@extends('admin.layout.master')
@section('content')
    <div class="box primary-box">
        <div class="box-header width-border">
            <span class="h2 text-muted">
                Danh sách người dùng
            </span>
        </div>
        <div class="box-body">
            <br>
            <br>
            <br>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên</th>
                        <th>Email</th>
                        <th>SDT</th>
                        <th>Địa chỉ</th>
                        <th>Ngày đăng ký</th>
                        <th>Tùy chọn</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $key => $user)
                        <tr>
                            <td>{{$key}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->phone}}</td>
                            <td>{{$user->address}}</td>
                            <td>{{$user->created_at}}</td>
                            <td>
                                
                                <span class="btn text-success" data-toggle="modal" data-target="#modal"> <i class="fa fa-eye"></i></span>

                                <div class="modal fade" id="modal">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title">Thông tin User</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>Họ và tên: <strong>{{$user->name}}</strong></p>
                                                <p>Email: <strong><a href="mailto:{{$user->email}}">{{$user->email}}</strong></a></p>
                                                <p>Số điện thoại: <strong><a href="tel:{{$user->phone}}">{{$user->phone}}</strong></a></p>
                                                <p>Địa chỉ: <strong>{{$user->address}}</strong></p>
                                                <p>Giới tính: <strong>{{$user->gender==0?'Nam':'Nữ'}}</strong></p>
                                                <p>Ngày sinh: <strong>{{$user->birthday}}</strong></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default pull-right"
                                                data-dismiss="modal">Đóng</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        $(document).ready(()=>{
            $('table').DataTable();
        })
    </script>
@endsection