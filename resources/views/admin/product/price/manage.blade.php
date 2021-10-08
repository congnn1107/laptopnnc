@extends('admin.layout.master')
@section('content')
    @include('admin.layout.message')
    <div class="box box-primary">
        <div class="box-header with-border">
            <span class="h4 text-purple">Thêm giá cho sản phẩm <span
                    class="text-danger">{{ $product->name }}</span></span>
        </div>
        <div class="box-body">
            <form action="{{ route('products.store_price', $product->id) }}" method="post" class="form">
                @csrf
                <div class="form-group">
                    <label for="" class="form-label">Giá nhập: </label>
                    <input type="number" name="import_price" id="" class="form-control"
                        value="{{ old('import_price') }}">
                    @error('import_price')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Giá bán: </label>
                    <input type="number" name="sell_price" class="form-control" value="{{ old('sell_price') }}">
                    @error('sell_price')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-button">
                    <button type="submit" class="btn btn-primary">Thêm Giá</button>
                </div>
            </form>
        </div>
        <div class="box box-info">
            <div class="box-header">

            </div>
            <div class="box-body">
                <table class="table" id="priceTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Giá Nhập</th>
                            <th>Giá Bán</th>
                            <th>Ngày thêm</th>
                            <th>Ngày sửa</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($product->price()->orderBy('id','desc')->get() as $key => $price)
                            <tr>
                                <td>{{ $price->id }}</td>
                                <td>{{ $price->import_price }} đ</td>
                                <td>{{ $price->sell_price }} đ</td>
                                <td>{{ $price->created_at }}</td>
                                <td>{{ $price->updated_at }}</td>
                                <td>
                                    <button type="button" class="btn" data-toggle="modal"
                                        data-target="#hopthoai-{{ $key }}">
                                        <i class="fa fa-pencil"></i>
                                    </button>
                                </td>
                            </tr>
                            <div class="modal fade" id="hopthoai-{{ $key }}" tabindex="-1" role="dialog"
                                aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Cập nhật giá</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('products.update_price', $product->id) }}"
                                                method="post" class="form">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $price->id }}">
                                                @method('put')
                                                <div class="form-group">
                                                    <label for="" class="form-label">Giá nhập: </label>
                                                    <input type="number" name="import_price" id="" class="form-control"
                                                        value="{{ $price->import_price }}">
                                                    @error('import_price')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="" class="form-label">Giá bán: </label>
                                                    <input type="number" name="sell_price" class="form-control"
                                                        value="{{ $price->sell_price }}">
                                                    @error('sell_price')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-button text-right">
                                                    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
