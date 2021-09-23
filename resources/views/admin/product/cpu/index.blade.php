@extends('admin.layout.master')
@section('content')
@include('admin.layout.message')
@include('admin.product.cpu.create')
@yield('create')
<div class="box box-primary">
    <div class="box-header with-border">
        <h4 class="text-muted">Danh sách các loại CPU</h4>
    </div>

    <div class="box-body">
        

        <table id="data-table" class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Hãng</th>
                    <th>Series</th>
                    <th>Thế hệ</th>
                    <th>GPU tích hợp</th>
                    <th>Số nhân - Số luồng</th>
                    <th>Xung nhịp</th>
                    <th>Cache</th>
                    <th>Ngày ra mắt</th>
                    <th>Thời gian sửa</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cpuList as $cpu)
                <tr>
                    <td>{{$cpu->id}}</td>
                    <td>{{$cpu->name}}</td>
                    <td>{{$cpu->brand}}</td>
                    <td>{{$cpu->series}}</td>
                    <td>{{$cpu->gen}}</td>
                    <td>{{$cpu->intergrated_gpu}}</td>
                    <td>{{$cpu->cores}}C-{{$cpu->threads}}T</td>
                    <td>{{$cpu->base_clock}}-{{$cpu->turbo_clock}}</td>
                    <td>{{$cpu->cache}}</td>
                    <td>{{$cpu->release_date}}</td>
                    <td>{{$cpu->updated_at}}</td>
                    <td>
                        <a href="{{route('cpu.edit',$cpu->id)}}"><button class="btn btn-success"><i class="fa fa-pencil"></i></button></a>
                        <form style="display:inline" action="{{route('cpu.destroy',$cpu->id)}}" method="post">
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
        $("#data-table").dataTable({
            scrollX: true
        });
    })
</script>
@endsection