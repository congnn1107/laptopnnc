<link rel="stylesheet" href="{{ asset('css/app.css')}}">

<!-- Begin section -->
<div class="container">
    <h1 class="text-primary">Tao moi danh muc</h1>
    @if(Session::get('fail'))
        <p class="alert alert-danger">{{Session::get('fail')}}</p>
    @endif
    
    @if(Session::get('success'))
        <p class="alert alert-success">{{Session::get('success')}}</p>

    @endif
    <form action="{{route('categories.store')}}" method="post" class="form">
        @csrf
        <div class="row">
            <div class="form-group col">
                <label for="" class="form-label">Ten</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                @error('name')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group col">
                <label for="" class="form-label">Cha</label>
                <select class="form-control" name="parent" id="parent">
                    <option value="0">--</option>
                    <?php showCategoriesMenu($categoriesList);?>
                </select>
            </div>
            
        </div>
        <button type="submit" class="form-button btn btn-primary">Save</button>
    </form>
</div>
<!-- End section -->
