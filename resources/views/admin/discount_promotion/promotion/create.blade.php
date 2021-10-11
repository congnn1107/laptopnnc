@extends('admin.layout.master')
@section('content')
    @include('admin.layout.message')
    <div class="box box-primary">
        <div class="box-header with-border">
            <span class="h4 text-purple">
                Tạo chương trình giảm giá
            </span>
        </div>
        <div class="box-body">
            <form action="{{ route('promotion.p.store') }}" method="post" class="form">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Tiêu đề</label>
                            <input type="text" name="title" id="" class="form-control" value="{{ old('title') }}">
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
                                value="{{ old('expired_at') }}">
                            @error('expired_at')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Nội dung chương trình khuyến mại</label>
                    <textarea class="form-control" name="content" id="txtContent" cols="30"
                        rows="10">{{ old('content') }}</textarea>
                </div>
                <div class="form-btn text-center">
                    <button type="submit" class="btn btn-primary">Lưu dữ liệu</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(() => {
            CKEDITOR.replace('txtContent')
        })
    </script>
@endsection

