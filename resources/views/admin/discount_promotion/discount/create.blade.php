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
            <form action="{{ route('promotion.d.store') }}" method="post" class="form">
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
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Giảm giá theo</label>
                            <div>
                                <div class="radio-inline">
                                    <label>
                                        <input type="radio" name="type" value="1" checked>
                                        Phần trăm
                                    </label>
                                </div>
                                <div class="radio-inline">
                                    <label>
                                        <input type="radio" name="type" value="2" {{ old('type') == 2 ? 'checked' : '' }}>
                                        Số tiền
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Số % giảm: </label>
                            <input class="form-control" type="number" name="discounted_rate" id="" min="0" max="100"
                                step="0.1" value="{{ old('discounted_rate') }}">
                            @error('discounted_rate')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Số tiền giảm: </label>
                            <input class="form-control" type="number" name="discounted_amount" id="" min="0"
                                value="{{ old('discounted_amount') }}">
                            @error('discounted_amount')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
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
