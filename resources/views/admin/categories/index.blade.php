   @extends('admin.layout.master')
   @section('content')
    @include("admin.categories.create")
    @yield('create')
   
    <div class="box box-info">
        <div class="box-body">
            <h3 class="text-muted">Danh sách Categories</h3>
        @if(Session::get('deleted_success'))
        <p class="alert-success">{{Session::get('deleted_success')}}</p>
    @endif

    @if(Session::get('deleted_error'))
        <p class="alert-success">{{Session::get('deleted_error')}}</p>

    @endif
       <table class="table" id="table">
        <thead class="thead">
                <tr class="info">
                <th>ID</th>
                <th>Tên</th>
                <th>ID Cha</th>
                <th>Tên Cha</th>
                <th>Ngày tạo</th>
                <th>Ngày sửa</th>
                <th class="text-center">Tùy chọn</th>
                </tr>
        </thead>
        <tbody>
            @foreach($categoriesList as $category)
                <tr class="text-secondary">
                    <td>{{$category->id}}</td>
                    <td>{{$category->name}}</td>
                    <td>{{$category->parent_id}}</td>
                    <?php
                        $parent = $category->parent()->first();
                        $parent = $parent?$parent->name:"--";
                    
                    ?>
                    <td>{{$parent}}</td>
                    <td>{{$category->created_at}}</td>
                    <td>{{$category->updated_at}}</td>
                    <td class="text-center"><a class="btn btn-success" title="Sửa thông tin" href="{{route('categories.edit',$category->id)}}"><i class="fa fa-pencil"></i></a>
                    
                        <form style="display:inline" action="{{route('categories.destroy',$category->id)}}" method="post">
                            @method('delete')
                            @csrf
                            <button title="Xóa" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
       </table>
        </div>
    </div>
    <script >
        $(document).ready(()=>{
            $("#table").DataTable();
        })
    </script>
    @endsection
