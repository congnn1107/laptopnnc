@extends('admin.layout.master')
@section('content')
    <div class="box box-danger">
        <div class="box-header with-border">
            <span class="h3">Xem bài viết</span>
        </div>
        <div class="box-body">
            <p><i>Tiêu đề: </i> <span class="h3">{{ $post->title }}</span></p>
            <p><i>Từ khóa: </i> <strong class="">{{ $post->meta_keyword }}</strong></p>
            <p><i>Mô tả: </i> <strong class="">{{ $post->meta_description }}</strong></p>
            <p><i>Trạng thái: </i>
                @if ($post->status == 0)
                    <span class="label bg-gray">Chưa xuất bản</span>
                @else
                    <span class="label bg-green">Đã xuất bản</span>
                @endif
            </p>
            <p><i>Lượt xem: </i> <strong>{{$post->views}}</strong></p>
            <hr>
            <br>
            <h3><i>Nội dung:</i></h3>
            <div>
                {!! $post->content !!}
            </div>

        </div>
    </div>
@endsection
