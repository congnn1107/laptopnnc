@extends('admin.layout.master')
@section('content')
    @include('admin.layout.message')
    <div class="box box-primary">
        <div class="box-header with-border">
            <span class="h4 text-info">
                Tạo hồ sơ khách hàng
            </span>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" title="Phóng rộng - Thu gọn"><i
                        class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            <form action="{{ route('customer.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Họ tên: </label>
                            <input type="text" name="name" id="" class="form-control" placeholder="Nhập họ tên..."
                                value="{{ old('name') }}">
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Địa chỉ: </label>
                            <input type="text" name="address" id="" class="form-control" placeholder="Nhập địa chỉ..."
                                value="{{ old('address') }}">
                            @error('address')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">SDT: </label>
                            <input type="text" name="phone" id="" class="form-control" placeholder="Nhập số điện thoại..."
                                value="{{ old('phone') }}">
                            @error('phone')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Email: </label>
                            <input type="mail" name="email" id="" class="form-control" placeholder="Nhập địa chỉ email..."
                                value="{{ old('email') }}">
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </form>
        </div>
    </div>
    <div class="box box-danger">
        <div class="box-header with-border">
            <span class="h4 text-danger">
                Danh sách thông tin khách hàng
            </span>
        </div>
        <div class="box-body">
            <table class="table" id="customerTable">
                <thead>
                    <tr>
                        <th>Họ tên</th>
                        <th>SDT</th>
                        <th>Email</th>
                        <th>Địa chỉ</th>
                        <th>Tùy chọn</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customerList as $customer)
                        <tr>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->phone }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->address }}</td>
                            <td>
                                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                                    <i class="fa fa-pencil-square-o"></i>
                                  </button>
                            </td>
                        </tr>
                        <div id="myModal" class="modal fade" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                  <h4 class="modal-title">Sửa thông tin khách hàng</h4>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('customer.update',$customer->id) }}" method="post">
                                        @csrf
                                        @method('put')
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Họ tên: </label>
                                                    <input type="text" name="name" id="" class="form-control" placeholder="Nhập họ tên..."
                                                        value="{{ $customer->name }}">
                                                    @error('name')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Địa chỉ: </label>
                                                    <input type="text" name="address" id="" class="form-control" placeholder="Nhập địa chỉ..."
                                                        value="{{ $customer->address }}">
                                                    @error('address')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">SDT: </label>
                                                    <input type="text" name="phone" id="" class="form-control" placeholder="Nhập số điện thoại..."
                                                        value="{{ $customer->phone }}">
                                                    @error('phone')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Email: </label>
                                                    <input type="mail" name="email" id="" class="form-control" placeholder="Nhập địa chỉ email..."
                                                        value="{{ $customer->email }}">
                                                    @error('email')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                        
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                                        </div>
                                    </form>

                                </div>
                              </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                          </div><!-- /.modal -->
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        $(document).ready(() => {
            $('#customerTable').DataTable()
        })
    </script>
@endsection
