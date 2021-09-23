@section('create')
<div class="box box-primary {{$collapsed}}">
    <div class="box-header with-border">
        <span class="h4 text-muted">Tạo thông tin CPU mới</span>
        <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" data-original-title="Collapse">
                <i class="fa {{$collapsed?'fa-plus':'fa-minus'}}"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <form action="{{route('cpu.store')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6">


                    <div class="form-group">
                        <label for="">Hãng SX</label>
                        <select name="brand" id="brand" class="form-control">
                            @foreach($brands as $brand)
                            <option value="{{$brand}}" @if( old('brand')==$brand) selected @endif>{{$brand}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Series CPU: </label>
                        <select name="series" id="series" class="form-control">
                            @foreach($series as $serie)
                            <option value="{{$serie}}" @if( old('serie')==$serie) selected @endif>{{$serie}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Thế hệ: </label>
                        <input type="number" name="gen" id="gen" min="1" placeholder="Ví dụ: 5 - Tên thế hệ..." class="form-control" value="{{old('gen')}}">
                        @error('gen')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Tên mã CPU: </label>
                        <input type="text" name="name" id="name" placeholder="Ví dụ: Intel Core i5 5200U..." class="form-control" value="{{old('name')}}">
                        @error('name')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Số lõi: </label>
                        <input type="number" name="cores" min="1" placeholder="Ví dụ: 1" id="cores" class="form-control" value="{{old('cores')}}">
                        @error('cores')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Số Luồng: </label>
                        <input type="number" name="threads" min="1" placeholder="Ví dụ: 1" id="threads" class="form-control" value="{{old('threads')}}">
                        @error('threads')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Mức xung cơ bản: </label>
                        <input type="text" name="base_clock" placeholder="Ví dụ: 2.1Ghz..." id="base_clock" class="form-control" value="{{old('base_clock')}}">
                        @error('base_clock')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Mức xung turbo: </label>
                        <input type="text" name="turbo_clock" placeholder="Ví dụ: 4.0 Ghz..." id="turbo_clock" class="form-control" value="{{old('turbo_clock')}}">
                        @error('turbo_clock')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Bộ nhớ cache: </label>
                        <input type="text" name="cache" placeholder="Ví dụ: 8MB cache L3" id="cache" class="form-control" value="{{old('cache')}}">
                        @error('cache')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Đồ họa tích hợp: </label>
                        <input type="text" name="intergrated_gpu" placeholder="Ví dụ: UHD 620 Graphic..." id="intergrated_gpu" class="form-control" value="{{old('intergrated_gpu')}}">
                        @error('intergrated_gpu')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Ngày ra mắt: </label>
                        <input type="date" name="release_date" id="release_date" class="form-control" value="{{old('release_date')}}">
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
    </div>
</div>
@endsection