@extends('admin.layout.master')
@section('content')
    @include('admin.layout.message')
    <div class="box box-primary">
        <div class="box-header with-border">
            <span class="h4 text-purple">Quản lý giá sản phẩm</span>
        </div>
        <div class="box-body">
            <table class="table" id="productTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên sản phẩm</th>
                        <th>Tùy chọn</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productsList as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td><a href="{{ route("products.show_price",$product->id)}}"><button class="btn"><i class="fa fa-pencil"></i></button></a></td>
                        </tr>
                    @endforeach

                    <script>
                        $(document).ready(()=>{
                            $('#productTable').DataTable();
                        })
                    </script>
                </tbody>
            </table>
        </div>
    </div>
@endsection
