@extends('admin.layout.master')
@section('content')
@include('admin.layout.message')
<div class="box box-primary">
    <div class="box-header with-border">
        <span class="h4 text-muted">Cập nhật thông tin CPU</span>
    </div>
    <div class="box-body">
        <form action="{{route('cpu.update',$cpu->id)}}" method="post">
            @csrf
            @method('put')
            <input type="hidden" name="id" value="{{$cpu->id}}">
            <div class="row">
                <div class="col-md-6">


                    <div class="form-group">
                        <label for="">Hãng SX</label>
                        <select name="brand" id="brand" class="form-control">
                            @foreach($brands as $brand)
                            <option value="{{$brand}}" @if( $cpu->brand==$brand) selected @endif>{{$brand}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Series CPU: </label>
                        <select name="series" id="series" class="form-control">
                            @foreach($series as $serie)
                            <option value="{{$serie}}" @if( $cpu->series==$serie) selected @endif>{{$serie}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Thế hệ: </label>
                        <input type="number" name="gen" id="gen" min="1" placeholder="Ví dụ: 5 - Tên thế hệ..." class="form-control" value="{{$cpu->gen}}">
                        @error('gen')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Tên mã CPU: </label>
                        <input type="text" name="name" id="name" placeholder="Ví dụ: Intel Core i5 5200U..." class="form-control" value="{{$cpu->name}}">
                        @error('name')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Số lõi: </label>
                        <input type="number" name="cores" min="1" placeholder="Ví dụ: 1" id="cores" class="form-control" value="{{$cpu->cores}}">
                        @error('cores')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Số Luồng: </label>
                        <input type="number" name="threads" min="1" placeholder="Ví dụ: 1" id="threads" class="form-control" value="{{$cpu->threads}}">
                        @error('threads')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Mức xung cơ bản: </label>
                        <input type="text" name="base_clock" placeholder="Ví dụ: 2.1Ghz..." id="base_clock" class="form-control" value="{{$cpu->base_clock}}">
                        @error('base_clock')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Mức xung turbo: </label>
                        <input type="text" name="turbo_clock" placeholder="Ví dụ: 4.0 Ghz..." id="turbo_clock" class="form-control" value="{{$cpu->turbo_clock}}">
                        @error('turbo_clock')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Bộ nhớ cache: </label>
                        <input type="text" name="cache" placeholder="Ví dụ: 8MB cache L3" id="cache" class="form-control" value="{{$cpu->cache}}">
                        @error('cache')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Đồ họa tích hợp: </label>
                        <input type="text" name="intergrated_gpu" placeholder="Ví dụ: UHD 620 Graphic..." id="intergrated_gpu" class="form-control" value="{{$cpu->intergrated_gpu}}">
                        @error('intergrated_gpu')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Ngày ra mắt: </label>
                        <input type="date" name="release_date" id="release_date" class="form-control" value="{{substr($cpu->release_date,0,10)}}">
                        @error('release_date')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-button text-center">
                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>

        </form>
        <form action="{{route('cpu.destroy',$cpu->id)}}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger pull-right">Xóa</button>
        </form>


    </div>
</div>
@endsection