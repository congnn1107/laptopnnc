@extends('shop.layout.master')
@section('title')
    Bài viết
@endsection
@section('content')
    <hr class="offset-top">
    
   <div class="tags">
       <div class="container">
           <h3>Bài viết</h3>
       </div>
   </div>
    <hr class="offset-md">
    <div class="blog">
        <div class="container">
            <div class="row">
                @foreach ($posts as $item)
                <div class="col-sm-6 col-md-6 item">

                    <div class="body">
                      <a href="{{route('shop.post.show',$item->slug)}}" class="view"><i class="ion-ios-book-outline"></i></a>
        
                      <a href="{{route('shop.post.show',$item->slug)}}">
                        <img src="{{asset('storage/'.$item->cover_image)}}" title="{{$item->title}}" alt="{{$item->title}}">
                      </a>
        
                      <div class="caption">
                        <h1 class="h3">{{$item->title}}</h1>
                        <label>{{$item->created_at}}</label>
                        <hr class="offset-sm">
        
                        <p>
                         {{$item->meta_description}}
                        </p>
                        <hr class="offset-sm">
        
                        <a href="{{route('shop.post.show',$item->slug)}}"> Xem bài viết <i class="ion-ios-arrow-right"></i> </a>
                      </div>
                    </div>
                  </div>
                @endforeach
            </div>
        </div>
    </div>
    {{$posts->links()}}
    <hr class="offset-lg">
    <hr class="offset-sm">

@endsection