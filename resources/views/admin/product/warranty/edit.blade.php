@extends('admin.layout.master')
@section('content')
@include('admin.layout.message')
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <span class="h4 text-primary">
                        Thông tin phiếu bảo hành
                    </span>
                </div>
                <div class="box-body">
                    <form action="{{ route('warranty.update', $warranty->id) }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">
                                        Sản phẩm:
                                    </label>
                                    <select name="product" class="form-control" id="">
                                        <option value="0">Chọn sản phẩm</option>
                                        @foreach ($productList as $product)
                                            <option value="{{ $product->id }}"
                                                {{ $product->id == $warranty->product ? 'selected' : '' }}>
                                                {{ $product->name . ' - ' . $product->sku }}</option>
                                        @endforeach
                                    </select>
                                    @error('product')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Mã EMEI</label>
                                    <input type="text" name="emei" id="" placeholder="Nhập mã EMEI..."
                                        class="form-control" value="{{ $warranty->emei }}">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Ngày bán:</label>
                                    <input type="date" name="sold_at" class="form-control" id=""
                                        value="{{ substr($warranty->sold_at, 0, 10) }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Ngày kích hoạt bảo hành:</label>
                                    <input type="date" name="actived_at" class="form-control" id=""
                                        value="{{ substr($warranty->actived_at, 0, 10) }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Hạn bảo hành:</label>
                                    <input type="date" name="expired" class="form-control" id=""
                                        value="{{ substr($warranty->expired, 0, 10) }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Trạng thái:</label>
                                    <select name="status" class="form-control" id="">

                                        @foreach ($statusList as $key => $value)
                                            <option value="{{ $key }}"
                                                {{ $key == $warranty->status ? 'checked' : '' }}>{{ $value }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">SDT khách hàng:</label>
                                    <input type="text" name="customer_phone" class="form-control" id=""
                                        placeholder="Nhập SDT khách hàng..." value="{{ $warranty->customer->phone }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Email khách hàng:</label>
                                    <input type="mail" name="customer_email" class="form-control" id=""
                                        placeholder="Nhập email khách hàng..." value="{{ $warranty->customer->email }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Ghi chú: </label>
                            <textarea name="info" id="" cols="30" rows="10"
                                class="form-control">{{ $warranty->info }}</textarea>
                        </div>
                        <div class="form-button text-center">
                            <button type="submit" class="btn btn-primary btn-lg">Lưu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="box box-info">
                <div class="box-header with-border">
                    <span class="h4 text-info">
                        Nhật ký bảo hành sản phẩm
                    </span>
                </div>
                <div class="box-body">
                    <table class="table" id="logTable">
                        <thead>
                            <tr>
                                <th>Ngày Nhận</th>
                                <th>Vấn Đề</th>
                                <th>Tình Trạng SP</th>
                                <th>Ngày Trả</th>
                                <th>Chi Phí</th>
                                <th>Tùy chọn</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($warranty->logs as $log)
                                <tr>
                                    <td>{{ $log->receive_at }}</td>
                                    <td>{{ $log->problem }}</td>
                                    <td>{{ $log->product_condition }}</td>
                                    <td>{{ $log->return_at }}</td>
                                    <td>{{ $log->cost }}</td>
                                    <td>
                                        <button type="button" class="btn" data-toggle="modal"
                                            data-target="#myModal">
                                            <i class="fa fa-pencil-square-o"></i>
                                        </button>
                                    </td>
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="myModal" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">Chỉnh sửa nhật ký</h4>
                                            </div>
                                            <div class="modal-body">
                                                ...
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>


            <div class="box box-danger">
                <div class="box-header with-border">
                    <span class="h4 text-danger">
                        Ghi nhật ký bảo hành
                    </span>
                </div>
                <div class="box-body">
                    <form action="{{ route('log.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="warranty_id" value="{{ $warranty->id }}">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Ngày nhận:</label>
                                    <input type="date" name="receive_at" id="" class="form-control" value="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Ngày trả:</label>
                                    <input type="date" name="return_at" id="" class="form-control" value="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Chi phí:</label>
                                    <input type="text" name="cost" id="" class="form-control" value="">
                                </div>
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <label for="">Vấn đề khách gặp phải:</label>
                            <textarea name="problem" id="" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Tình trạng sản phẩm:</label>
                            <textarea name="product_condition" id="" cols="30" rows="10" class="form-control"></textarea>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">
                                Lưu lại
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('select').select2()
        $('#logTable').DataTable()
    </script>
@endsection
