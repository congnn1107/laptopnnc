@extends('admin.layout.master')
@section('content')
    @include('admin.layout.message')
    <div class="box box-info">
        <div class="box-header with-border">
            <span class="h4 text-purple">
                Chỉnh sửa thông tin Chương trình khuyến mại
            </span>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            <form action="{{ route('promotion.p.update',$promotion->id) }}" method="post" class="form">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Tiêu đề</label>
                            <input type="text" name="title" id="" class="form-control" value="{{ $promotion->title }}">
                            @error('title')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Ngày hết hạn: </label>
                            <input class="form-control" type="date" name="expired_at" id=""
                                value="{{ substr($promotion->expired_at,0,10) }}">
                            @error('expired_at')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Nội dung chương trình khuyến mại</label>
                    <textarea class="form-control" name="content" id="txtContent" cols="30"
                        rows="10">{{ $promotion->content }}</textarea>
                </div>
                <div class="form-btn text-center">
                    <button type="submit" class="btn btn-primary">Lưu dữ liệu</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Danh sách sản phẩm áp dụng --}}
    <div class="box box-danger">
        <div class="box-header with-border">
            <span class="h4 text-purple">
                Danh sách sản phẩm áp dụng Chương trình
            </span>
        </div>
        <div class="box-body">
            <form action="{{ route('promotion.p.products',$promotion->id) }}" method="post" class="form">
                @csrf
                <table class="table" id="productTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên sản phẩm</th>
                            <th>SKU</th>
                            <th>Triển khai</th>
                            <th>Số lượng giới hạn</th>
                            <th>Trạng thái triển khai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productList as $product)
                            <tr>
                                
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->sku }}</td>
                                <td>
                                    <input type="checkbox" name="products[{{ $product->id }}][checked]" id="" class="no-border" {{ $promotion->detail()->where('product',$product->id)->count()>0?'checked':''}}>
                                </td>
                                <td>
                                    <input type="number" class="form-control no-border" min="0" name="products[{{ $product->id }}][quantity]" id="" value="{{ $promotion->detail()->where('product',$product->id)->first()->quantity??0}}">
                                </td>
                                <td>{{ $promotion->detail()->where('product',$product->id)->count()>0?'Đã triển khai':'Chưa triển khai' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="form-button text-center">
                    
                    <button type="submit" class="btn btn-primary">Lưu lại</button>
                </div>
            </form>
        </div>
    </div>
    <script>
         $(document).ready(() => {
            CKEDITOR.replace('txtContent')
            $('#productTable').DataTable()
        })
    </script>
@endsection

