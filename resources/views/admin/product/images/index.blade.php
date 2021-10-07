@extends('admin.layout.master')
@section('content')
    @include('admin.layout.message')
    <div class="box box-danger">
        <div class="box-header with-border">
            <h4 class="text-purple">Quản lý hình ảnh sản phẩm</h4>
        </div>
        <div class="box-body">
            <table class="table" id="products">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên sản phẩm</th>
                        <th>Ảnh</th>
                        <th>Tùy chọn</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productsList as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            @php
                                $imagesList = $product->images;
                            @endphp
                            <td>
                                @foreach ($imagesList as $image)
                                <img style="display:inline-block;margin-right: 2px;width: 40px;height: 40px" src="{{ asset('storage/'.$image->image_path) }}" alt="Ảnh">
                                @endforeach
                            </td>
                            <td class="text-center">
                                <a href="{{ route('products.show_image',$product->id) }}" class="btn btn-primary" title="Sửa"><i class="fa fa-pencil"></i></a>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        $(document).ready(()=>{
            $('#products').DataTable();
        })
    </script>
@endsection
