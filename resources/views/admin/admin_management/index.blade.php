@extends('admin.layout.master')
@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <span class="h4 text-muted">Danh sách Admin</span>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                <i class="fa fa-minus"></i></button>
            <!-- <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
                <i class="fa fa-times"></i></button> -->
        </div>
    </div>
    <div class="box-body">
        <div class="button">
            <a href="{{route('admins.create')}}"><button class="btn bg-purple"><i class="fa fa-plus"></i> Thêm mới</button></a>
        </div><br>
        <table class="table dataTable table-hover" id="table">
            <thead>
                <th>ID</th>
                <th>Avatar</th>
                <th>Họ Tên</th>
                <th>Email</th>
                <th>Username</th>
                <th>Ngày Thêm</th>
                <th>Ngày Sửa</th>
                <th>Tùy Chọn</th>
            </thead>
            <tbody>
                @foreach($adminsList as $admin)
                <tr>
                    <td>
                        {{$admin->id}}
                    </td>
                    <td>
                        <img style="width:75px;height:75px" src="{{asset($admin->avatar)}}" alt="{{$admin->name}}">
                    </td>
                    <td>{{$admin->name}}</td>
                    <td>{{$admin->email}}</td>
                    <td>{{$admin->username}}</td>
                    <td>{{$admin->created_at}}</td>
                    <td>{{$admin->updated_at}}</td>
                    <td><a href="{{route('admins.edit',$admin->id)}}"><button title="Sửa thông tin" class="btn btn-primary"><i class="fa fa-pencil"></i></button></a>
                        @if($admin->id!=Auth::guard('admin')->user()->id)
                        <form style="display:inline" action="{{route('admins.destroy',$admin->id)}}" method="post">
                            @csrf
                            @method('delete')
                            <button title="Xóa" type="submit" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
        $(document).ready(() => {

            $("#table").DataTable()
        })
    </script>

</div>
@endsection