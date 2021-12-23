@extends('admin.layout.master')
@section('content')
@include('admin.layout.message')
    <div class="box box-primary">
        <div class="box-header with-border">
            <span class="h3 text-info">Cập nhật bài viết</span>
        </div>
        <div class="box-body">
            <form action="{{ route('post.update',$post->id) }}" enctype="multipart/form-data" method="post">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group @error('title') has-error @enderror">
                            <label for="">Tiêu đề</label>
                            <input type="text" name="title" id="" class="form-control" placeholder="Tiêu đề bài viết"
                                value="{{ $post->title }}">

                        </div>
                        @error('title')
                            <div class="alert alert-danger">{{$message}}</div>
                        @enderror

                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Trạng thái:</label><br>
                            <span>Publish:</span> <input type="checkbox" name="status" id="check" @if ($post->status==1)
                                checked
                            @endif>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Bìa bài viết: </label>
                            <input type="file" accept="image/*" name="cover_image" id="" placeholder="Danh sách từ khóa" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Từ khóa seo: </label>
                            <input type="text" name="meta_keyword" id="" placeholder="Danh sách từ khóa" class="form-control" value="{{$post->meta_keyword}}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Mô tả ngắn cho bài viết: </label>
                    <input type="text" name="meta_description" id="" placeholder="Mô tả ngắn về bài viết" class="form-control" value="{{$post->meta_description}}">
                </div>
                <div class="form-group">
                    <label for="">Nội dung bài viết: </label>
                <textarea name="content" class="form-control" id="txtContent" cols="30"
                    rows="10">{{ $post->content }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary pull-right">Lưu Bài Viết</button>
            </form>
        </div>

    </div>
    <script>
        $(document).ready(() => {
            ckeditor = CKEDITOR.replace('txtContent', {
                filebrowserBrowseUrl: "{{ asset('plugins/ckfinder/ckfinder.html') }}",
                filebrowserImageBrowseUrl: "{{ asset('plugins/ckfinder/ckfinder.html?type=Images') }}",
                filebrowserFlashBrowseUrl: "{{ asset('plugins/ckfinder/ckfinder.html?type=Flash') }}",
                filebrowserUploadUrl: "{{ asset('plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}",
                filebrowserImageUploadUrl: "{{ asset('plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}",
                filebrowserFlashUploadUrl: "{{ asset('plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}",
                // filebrowserUploadMethod:"form",
                // filebrowserUploadUrl: '/upload-image.php',
                extraPlugins: "textindent",
                removePlugins: "about,flash",
                height: 400
            })
            CKFinder.setupCKEditor(ckeditor)

        })
    </script>
@endsection
