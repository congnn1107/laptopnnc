@extends('admin.layout.master')
@section('content')
    @include('admin.layout.message')
    <div class="box box-danger">
        <div class="box-header with-border">
            <span class="h4 text-info">
                Thêm thông tin bảo hành sản phẩm
            </span>
        </div>
        <div class="box-body">
            <form action="{{ route('warranty.store') }}" method="post">
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
                                    <option value="{{ $product->id }}">{{ $product->name.' - '.$product->sku }}</option>
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
                            <input type="text" name="emei" id="" placeholder="Nhập mã EMEI..." class="form-control" value="{{ old('emei') }}">
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Ngày bán:</label>
                            <input type="date" name="sold_at" class="form-control" id="" value="{{ old('sold_at') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Ngày kích hoạt bảo hành:</label>
                            <input type="date" name="actived_at" class="form-control" id="">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Hạn bảo hành:</label>
                            <input type="date" name="expired" class="form-control" id="" value="{{ old('expired') }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Trạng thái:</label>
                            <select name="status" class="form-control" id="">
                                
                            @foreach ($statusList as $key => $value)
                            <option value="{{ $key }}" {{ $key==old('status')?'checked':'' }} >{{ $value }}</option>
                            @endforeach
                                
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">SDT khách hàng:</label>
                            <input type="text" name="customer_phone" class="form-control" id="" placeholder="Nhập SDT khách hàng..." value="{{ old('customer_phone') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Email khách hàng:</label>
                            <input type="mail" name="customer_email" class="form-control" id="" placeholder="Nhập email khách hàng..." value="{{ old('customer_email') }}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Ghi chú: </label>
                    <textarea name="info" id="" cols="30" rows="10" class="form-control"></textarea>
                </div>
                <div class="form-button text-center">
                    <button type="submit" class="btn btn-primary btn-lg">Lưu</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(()=>{
            $('select').select2();
        })
    </script>
@endsection
