@extends('admin.layout.master')
@section('content')
<div class="box">
<div class="box-body">
    <h3 class="text-muted">Cập nhật danh mục "{{$category->name}}" - id: {{$category->id}}</h3>
    @if(Session::get('success'))
    <p class="text-success">{{Session::get('success')}}</p>
    @endif
    @if(Session::get('error'))
    <p class="text-danger">{{Session::get('error')}}</p>
    @endif
    <form action="{{route('categories.update',$category->id)}}" class="form" method="post">
        @csrf 
        @method("put")
        <div class="form-group">
            <label for="" class="form-label">Tên danh mục</label>
            <input type="text" class="form-control" name="name" value="{{$category->name}}">
            @error("name")
            <p class="text-danger">
                {{$message}}
            </p>
            @enderror
        </div>
        <div class="form-group">
            <label for="" class="form-label">Danh mục cha</label>
            <select class="form-control" name="parent" id="parentSelect">
                <option value="0" selected>--</option>
                <?php showCategoriesMenu(0,$categoriesList,$category->parent_id,$category->id) ?>
            </select>
        </div>

        <div class="form-group">
            <button class="form-button btn btn-primary">Lưu</button>
        </div>
        
    </form>
</div>
</div>
<script>
    $(document).ready(()=>{
        $('#parentSelect').select2();
    })
</script>
@endsection