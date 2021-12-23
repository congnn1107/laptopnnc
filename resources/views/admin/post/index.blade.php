@extends('admin.layout.master')
@section('content')
    @include('admin.layout.message')
    <div class="box box-primary">
        <div class="box-header with-border">
            <span class="h4 text-violet">
                Danh sách bài viết
            </span>
        </div>
        <div class="box-body">
            <a href="{{route('post.create')}}" class="btn">Thêm bài viết</a>
            <br>
            <br>
            <p class="h3 text-primary">Bài viết của bạn: </p>
            <br>
            <br>
            <table class="table">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tiêu đề</th>
                        <th>Trạng thái</th>
                        <th>Lượt xem</th>
                        <th>Tùy chọn</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts->where('author',Auth::guard('admin')->user()->id)->all() as$key=> $item)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$item->title}}</td>
                            <td>
                                @if ($item->status==1)
                                <span class="label bg-green">Đã xuất bản</span>
                                @else
                                <span class="label bg-gray">Chưa xuất bản</span>
                                @endif
                            </td>
                            <td>{{$item->views}}</td>
                            <td class="text-center">
                                <a href="{{route('post.show',$item->id)}}" class="btn text-orange"><i class="fa fa-eye"></i></a>
                                <a href="{{route('post.edit',$item->id)}}" class="btn text-primary"><i class="fa fa-pencil-square-o"></i></a>
                                
                                <form style="display: inline" action="{{route('post.destroy',$item->id)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn
                                    text-red" style="background-color: transparent"><i class="fa fa-trash-o"></i></button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
            <br>
            <hr>
            <br>
            <p class="h3 text-info">Bài viết của mọi người: </p>
            <br>
            <br>
            <table class="table">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tiêu đề</th>
                        <th>Trạng thái</th>
                        <th>Lượt xem</th>
                        <th>Tùy chọn</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts->where('author','!=',Auth::guard('admin')->user()->id)->all() as$key=> $item)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$item->title}}</td>
                            <td>
                                @if ($item->status==1)
                                <span class="label bg-green">Đã xuất bản</span>
                                @else
                                <span class="label bg-gray">Chưa xuất bản</span>
                                @endif
                            </td>
                            <td>{{$item->views}}</td>
                            <td class="text-center">
                                <a href="{{route('post.show',$item->id)}}" class="btn text-primary"><i class="fa fa-eye"></i></a>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>
    </div>
    <script>
        $(document).ready(()=>{
            $('table').DataTable();
        })
    </script>
@endsection