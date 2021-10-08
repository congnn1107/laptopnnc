@extends('admin.layout.master')
@section('content')
    @include('admin.layout.message')
    <div class="box box-primary">
        <div class="box-header with-border">
            <span class="h4 text-purple">Nhập kho cho sản phẩm <span
                    class="text-danger">{{ $product->name }}</span></span>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            <form action="{{ route('products.store_stock', $product->id) }}" method="post" class="form">
                @csrf
                <div class="form-group">
                    <label for="" class="form-label">Số lượng: </label>
                    <input type="number" name="quantity" id="" class="form-control" value="{{ old('quantity') }}">
                    @error('quantity')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
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
                    <button type="submit" class="btn btn-primary">Nhập kho</button>
                </div>
            </form>
        </div>

    </div>
    <div class="box box-info">
        <div class="box-header">

        </div>
        <div class="box-body">
            <table class="table" id="stockTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Số lượng</th>
                        <th>Giá Nhập</th>
                        <th>Giá Bán</th>
                        <th>Ngày thêm</th>
                        <th>Ngày sửa</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($product->stock()->orderBy('id', 'desc')->get()
        as $key => $stock)
                        <tr>
                            <td>{{ $stock->id }}</td>
                            <td>{{ $stock->quantity }}</td>
                            <td>{{ $stock->import_price }} đ</td>
                            <td>{{ $stock->sell_price }} đ</td>
                            <td>{{ $stock->created_at }}</td>
                            <td>{{ $stock->updated_at }}</td>
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
                                        <h4 class="modal-title" id="myModalLabel">Cập nhật kho</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('products.update_stock', $product->id) }}" method="post"
                                            class="form">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $stock->id }}">
                                            @method('put')
                                            <div class="form-group">
                                                <label for="" class="form-label">Số lượng: </label>
                                                <input type="number" name="quantity" id="" class="form-control"
                                                    value="{{ $stock->quantity }}">
                                                @error('quantity')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="form-label">Giá nhập: </label>
                                                <input type="number" name="import_price" id="" class="form-control"
                                                    value="{{ $stock->import_price }}">
                                                @error('import_price')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="form-label">Giá bán: </label>
                                                <input type="number" name="sell_price" class="form-control"
                                                    value="{{ $stock->sell_price }}">
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
@endsection
