<!-- Begin section -->
@section("create")
<div class="box box-primary">
    <div class="box-header with-border">
        <span class="text-muted">Tạo danh mục mới</span>
        <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" data-original-title="Collapse">
                <i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        @if(Session::get('fail'))
        <p class="alert alert-danger">{{Session::get('fail')}}</p>
        @endif

        @if(Session::get('success'))
        <p class="alert alert-success">{{Session::get('success')}}</p>

        @endif
        <form action="{{route('categories.store')}}" role="form" method="post" class="form">

            @csrf
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="" class="form-label text-muted">Tên danh mục:</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                    @error('name')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-md-6 form-group">
                    <label for="" class="form-label text-muted">Danh mục cha: </label>
                    <select class="form-control" name="parent" placeholder="Chọn danh mục cha" id="parentSelect">
                        <option value="0">--</option>
                        <?php showCategoriesMenu(0, $categoriesList); ?>
                    </select>
                </div>
            </div>
            <button type="submit" class="form-button btn btn-primary">Save</button>

        </form>
    </div>
</div>
<script>
    $(document).ready(()=>{
        $('#parentSelect').select2();
    })
</script>
<!-- End section -->
@endsection