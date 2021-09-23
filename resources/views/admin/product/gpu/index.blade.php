@extends('admin.layout.master')
@section('content')
@include('admin.layout.message')
<div class="box box-primary">
    <div class="box-header">
        <span class="h4">Thêm mới thông tin GPU</span>
        <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" data-original-title="Collapse">
                <i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <form action="{{route('gpu.store')}}" method="POST">
            @csrf
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="">Thương hiệu: </label>
                    <select name="brand" id="brand" class="form-control">
                        @foreach($brandList as $brand)
                        <option value="{{$brand}}" {{old('brand')==$brand?"selected":""}}>{{$brand}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="">Series</label>
                    <select name="series" id="series" class="form-control">
                        @foreach($seriesList as $series)
                        <option value="{{$series}}" {{old('series')==$series?"selected":""}}>{{$series}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="">Tên mẫu GPU: </label>
                    <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}" placeholder="Ví dụ: GTX 1650TI...">
                    @error('name')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="">Ngày ra mắt: </label>
                    <input type="date" name="release_date" id="release_date" class="form-control" value="{{old('release_date')}}">
                    @error('release_date')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="">Dung lượng V-Ram: </label>
                    <input type="text" name="graph_memory_cap" id="graph_memory_cap" class="form-control" value="{{old('graph_memory_cap')}}" placeholder="Ví dụ: 4GB...">
                    @error('graph_memory_cap')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="">Xung nhịp GPU: </label>
                    <input type="text" name="clock" id="clock" class="form-control" value="{{old('clock')}}" placeholder="Ví dụ: 4000Mhz...">
                    @error('clock')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="">Thông tin thêm: </label>
                    <textarea name="addition" id="addition" class="form-control" placeholder="Mô tả thêm..."></textarea>
                </div>
                @error('addition')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="form-button text-center">
                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
        </form>
    </div>
</div>

<!-- List -->
<div class="box box-info">
    <div class="box-header with-border">
        <span class="h4">Danh sách thông tin GPU</span>
    </div>
    <div class="box-body">
        <table class="table" id="GPUList">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Hãng</th>
                    <th>Series</th>
                    <th>Tên mẫu</th>
                    <th>Dung lượng V-ram</th>
                    <th>Xung nhịp</th>
                    <th>Ngày ra mắt</th>
                    <th>Thông tin thêm</th>
                    <th>Thời gian sửa</th>
                    <th>Tùy chọn</th>
                </tr>
            </thead>
            <tbody>
                @foreach($GPUList as $gpu)
                <tr>
                    <td>{{$gpu->id}}</td>
                    <td>{{$gpu->brand}}</td>
                    <td>{{$gpu->series}}</td>
                    <td>{{$gpu->name}}</td>
                    
                    <td>{{$gpu->graph_memory_cap}}</td>
                    <td>{{$gpu->clock}}</td>
                    <td>{{$gpu->release_date}}</td>
                    <td>{{$gpu->addition}}</td>
                    <td>{{$gpu->updated_at}}</td>
                    <td>
                        <a href="{{route('gpu.edit',$gpu->id)}}" class="btn btn-success"><i class="fa fa-pencil"></i></a>
                        <form style="display:inline" action="{{route('gpu.destroy',$gpu->id)}}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(() => {
        $('#GPUList').DataTable();
    })
</script>
@endsection