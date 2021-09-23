@extends('admin.layout.master')
@section('content')
@include('admin.layout.message')
<div class="box box-primary">
    <div class="box-header">
        <span class="h4">Cập nhật thông tin GPU</span>
    </div>
    <div class="box-body">
        <form action="{{route('gpu.update',$gpu->id)}}" method="POST">
            @csrf
            @method('patch')
            <input type="hidden" name="id" value="{{$gpu->id}}">
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="">Thương hiệu: </label>
                    <select name="brand" id="brand" class="form-control">
                        @foreach($brandList as $brand)
                        <option value="{{$brand}}" {{$gpu->brand==$brand?"selected":""}}>{{$brand}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="">Series</label>
                    <select name="series" id="series" class="form-control">
                        @foreach($seriesList as $series)
                        <option value="{{$series}}" {{$gpu->series==$series?"selected":""}}>{{$series}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="">Tên mẫu GPU: </label>
                    <input type="text" name="name" id="name" class="form-control" value="{{$gpu->name}}" placeholder="Ví dụ: GTX 1650TI...">
                    @error('name')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="">Ngày ra mắt: </label>
                    <input type="date" name="release_date" id="release_date" class="form-control" value="{{substr($gpu->release_date,0,10)}}">
                    @error('release_date')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="">Dung lượng V-Ram: </label>
                    <input type="text" name="graph_memory_cap" id="graph_memory_cap" class="form-control" value="{{$gpu->graph_memory_cap}}" placeholder="Ví dụ: 4GB...">
                    @error('graph_memory_cap')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="">Xung nhịp GPU: </label>
                    <input type="text" name="clock" id="clock" class="form-control" value="{{$gpu->clock}}" placeholder="Ví dụ: 4000Mhz...">
                    @error('clock')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="">Thông tin thêm: </label>
                    <textarea name="addition" id="addition" class="form-control" placeholder="Mô tả thêm..." value="">{{$gpu->addition}}</textarea>
                </div>
                @error('addition')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="form-button text-center">
                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
        </form>
        <form class="pull-right" action="{{route('gpu.destroy',$gpu->id)}}" method="post">
            @csrf 
            @method('delete')
            <button type="submit" class="btn btn-danger">Xóa</button>
        </form>
    </div>
</div>

@endsection