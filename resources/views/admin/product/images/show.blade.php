@extends('admin.layout.master')
@section('content')
    @include('admin.layout.message')
    <div class="box box-danger">
        <div class="box-header with-border">
            <p class="h4 text-purple">Quản lý hình ảnh sản phẩm <span class="text-danger">{{ $product->name }}</span></p>
        </div>
        <div class="box-body">
            <div class="images-box row">

                @foreach ($product->images as $image)
                    <div class="col-md-3">
                        <div class="thumbnail">
                            <div class="caption">
                                <form class="form pull-right" action="{{ route('products.delete_image', $product->id) }}"
                                    method="post">
                                    @csrf
                                    @method('delete')
                                    <input type="hidden" name="id" value="{{ $image->id }}">
                                    <button type="submit" class="close"><span>&times;</span></button>
                                </form>
                            </div>
                            <br>
                            <img class="img-thumbnail" src="{{ asset('storage/' . $image->image_path) }}" alt="Ảnh">

                        </div>
                    </div>
                @endforeach
            </div>

            <div class="upload-box">
                <form class="form" action="{{ route('products.store_image', $product->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">


                        <input class="form-control" type="file" name="images[]" accept="image/*" id="" multiple>
                        @error('images.*')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-button text-center">
                        <button class="btn btn-primary" type="submit">Thêm ảnh</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
