@extends('admin.layout.master');
@section('content')
    @include('admin.layout.message')

    <div class="box box-primary">
        <div class="box-header with-border">
            <span class="h4 text-primary">
                Thêm Banner mới
            </span>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse">
                    <i class="fa fa-minus">
                    </i>
                </button>
            </div>
        </div>
        <div class="box-body">
            <form action="{{ route('banner.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="">Chọn hình ảnh:</label>
                            <input type="file" name="image" accept="image/*" class="form-control" id="">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Trạng thái:</label>
                            <div class="checkbox">
                                <label><input type="checkbox" name="status" id=""> Hiển thị </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="">Đường dẫn URL:</label>
                            <input type="text" name="url" class="form-control" id="">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Vị trí: </label>
                            <select name="position" class="form-control" id="">
                                @foreach ($positions as $item)
                                    <option value="{{ $item }}" {{ $item == old('position') ? 'selected' : '' }}>
                                        {{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </form>
        </div>
    </div>
    <div class="box box-info">
        <div class="box-header with-border">
            <span class="h4 text-info">
                Danh sách các Banners
            </span>
        </div>
        <div class="box-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Ảnh</th>
                        <th>URL</th>
                        <th>Vị trí</th>
                        <th>Trạng thái</th>
                        <th>Tùy chọn</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bannerList as $key => $banner)
                        <tr>
                            <td>{{ $banner->id }}</td>
                            <td><img style="display: block;width:100px;max-height: 100px"
                                    src="{{ asset('storage/' . $banner->image) }}" alt="Ảnh" srcset=""></td>
                            <td>{{ $banner->url }}</td>
                            <td>{{ $banner->position }}</td>
                            <td>
                                @if ($banner->status == 1)

                                    <button class="btn btn-success" dataTarget="{{ $banner->id }}"
                                        onclick="changeStatus(this)" dataValue="0">Hiện</button>

                                @else
                                    <button class="btn" dataTarget="{{ $banner->id }}" dataValue="1"
                                        onclick="changeStatus(this)">Ẩn</button>
                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn" data-toggle="modal"
                                    data-target="#modal-{{ $key }}">
                                    <i class="fa fa-pencil-square-o"></i>
                                </button>

                                <form style="display:inline" action="{{ route('banner.destroy', $banner->id) }}"
                                    method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>

                            </td>
                        </tr>
                        <div class="modal fade" id="modal-{{ $key }}" tabindex="-1" role="dialog"
                            aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Chỉnh sửa banner</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('banner.update', $banner->id) }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('put')
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label for="">Chọn hình ảnh:</label>
                                                        <input type="file" name="image" accept="image/*"
                                                            class="form-control" id="">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">Trạng thái:</label>
                                                        <div class="checkbox">
                                                            <label><input type="checkbox" name="status" id=""
                                                                    {{ $banner->status == 1 ? 'checked' : '' }}> Hiển thị
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">Đường dẫn URL:</label>
                                                        <input type="text" name="url" class="form-control" id=""
                                                            value="{{ $banner->url }}">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="">Vị trí: </label>
                                                        <select name="position" class="form-control" id="">
                                                            @foreach ($positions as $item)
                                                                <option value="{{ $item }}"
                                                                    {{ $item == $banner->position ? 'selected' : '' }}>
                                                                    {{ $item }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                </div>
                                                <div class="col-md-8">
                                                    <div class="image">
                                                        <img style="display:block;width: 99%"
                                                            src="{{ asset('storage/' . $banner->image) }}" alt=""
                                                            srcset="">
                                                    </div>
                                                </div>
                                            </div>

                                            <div style="padding-top: 20px " class="text-center">
                                                <button type="submit" class="btn btn-primary">Lưu</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        function changeStatus(button) {
            $.ajax({
                url: "{{ route('banner.stt') }}",
                method: 'post',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: button.attributes.dataTarget.value,
                    status: button.attributes.dataValue.value
                },
                success: function(result) {
                    console.log(button)
                    if (result.status == 0) {
                        button.attributes.dataValue.value = 1;
                        button.innerText = "Ẩn";
                        button.classList.toggle('btn-success');
                    } else {
                        button.attributes.dataValue.value = 0;
                        button.innerText = "Hiện";
                        button.classList.toggle('btn-success');
                    }
                },
                error: function(error) {
                    alert('Lỗi: ' + error);
                }
            })
        }
    </script>
@endsection
