@extends('admin.layout.master')
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h1 class="text-purple">Danh sách sản phẩm</h1>
        </div>
        <div class="box-body">
            <table class="table" id="productTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Ảnh</th>
                        <th>Tên</th>
                        <th>SKU</th>
                        <th>Ngày thêm</th>
                        <th>Tùy chọn</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productList as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td><img style="width: 50px; height: 50px" src="{{ asset('storage/'.$product->card_image) }}" alt="Ảnh"></td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->sku }}</td>
                            <td>{{ $product->created_at }}</td>

                            <td class="text-center"><a class="btn btn-success" title="Sửa thông tin"
                                    href="{{ route('product.edit', $product->id) }}"><i class="fa fa-pencil"></i></a>

                                <form style="display:inline" action="{{ route('product.destroy', $product->id) }}"
                                    method="post">
                                    @method('delete')
                                    @csrf
                                    <button title="Xóa" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
<script>
    $(document).ready(()=>{
        $('#productTable').DataTable({
            "aaSorting": []
        });

    })
</script>
@endsection
