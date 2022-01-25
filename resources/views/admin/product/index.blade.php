@extends('admin.layout.master')
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h1 class="text-purple">Danh sách sản phẩm</h1>
        </div>
        <div class="box-body">
            <br>
            <a href="{{route('product.create')}}" class="btn btn-primary">Thêm sản phẩm</a>
            <br>
            <br>
            <table class="table" id="productTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Ảnh</th>
                        <th>Tên</th>
                        <th>SKU</th>
                        <th>Trạng thái</th>
                        <th>Số lượng</th>
                        {{-- <th>Ngày thêm</th> --}}
                        <th>Tùy chọn</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productList as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td><img style="width: 50px; height: 50px" src="{{ asset('storage/' . $product->card_image) }}"
                                    alt="Ảnh"></td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->sku }}</td>
                            @php
                                $statusArray = ['Sắp về hàng','Đang kinh doanh','Không kinh doanh'];
                                $colors = ['orange','green','gray']
                            @endphp
                            <td>
                                <i class="label bg-{{$colors[$product->status]}}">{{$statusArray[$product->status]}}</i>
                            </td>
                            <td>{{ $product->stock }} <span class="btn text-muted" data-toggle="modal"
                                    data-target="#modal-add-{{ $product->id }}"><i class="fa fa-plus"></i></span></td>
                            <div class="modal fade" id="modal-add-{{ $product->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Thêm số lượng sản phẩm</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('product.stock',$product->id)}}" method="post">
                                                <p>{{ $product->name }}&hellip;</p>
                                                @csrf
                                                <div class="form-group">
                                                    <label for="">Số lượng: </label>
                                                    <input type="number" name="stock" class="form-control" id="" min="0" step="1">
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default pull-left"
                                                data-dismiss="modal">Đóng</button>
                                            <button type="submit" class="btn btn-primary">Lưu</button>
                                        </div>
                                            </form>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>

                            {{-- <td>{{ $product->created_at }}</td> --}}

                            <td class="text-center">
                                <a href="{{ route('products.show_image', $product->id) }}" class="btn btn-block btn-link text-yellow"
                                    title="Quản lý hình ảnh"><i class="fa fa-picture-o"></i></a>
                                <a class="btn btn-link btn-block text-green" title="Sửa thông tin"
                                    href="{{ route('product.edit', $product->id) }}"><i class="fa fa-pencil"></i></a>

                                <form style="display:inline" onsubmit="return confirm('Bạn có chắc muốn xóa sản phẩm?')" action="{{ route('product.destroy', $product->id) }}"
                                    method="post">
                                    @method('delete')
                                    @csrf
                                    <button title="Xóa" class="btn btn-block btn-link text-red"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(() => {
            $('#productTable').DataTable({
                "aaSorting": []
            });

        })
    </script>
@endsection
