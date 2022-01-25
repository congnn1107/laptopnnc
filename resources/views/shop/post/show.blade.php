@extends('shop.layout.master')
@section('title')
    {{$post->title}}
@endsection
@section('headdoc')
    @parent
    <meta name="description" content="{{$post->meta_description}}">
    <meta name="keywords" content="{{$post->meta_keyword}}">
    <meta name="author" content="{{$post->author()->first()->name}}">
    <style>
        p img{
            display: inline-block;
            width: 100%;
        }
    </style>
@endsection
@section('content')
    <div class="blog-item">
        <hr class="offset-top visible-lg visible-md">
        <hr class="offset-lg visible-xs">
        <hr class="offset-lg visible-xs">
        {{-- <img src="{{asset('storage/'.$post->cover_image)}}" alt="{{$post->title}}" class="hidden-xs" /> --}}
        <div class="white">
            <hr class="offset-md">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2 text-justify">
                        <h1 class="h2">{{$post->title}}</h1>
                        <hr class="offset-md">
                        <hr class="offset-md">
                        <p class="text-muted"><i>{{$post->author()->first()->name}} -  {{$post->created_at}}  <span class="pull-right"><i class="text-muted fa fa-eye"></i> {{$post->view}} </i></span></p>
                        <hr class="offset-lg">
                        <hr class="offset-lg">
                        {!! $post->content !!}
                    </div>
                </div>
            </div>
            <hr class="offset-lg">
            <hr class="offset-lg">
            <hr class="offset-lg">
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script>
        $(document).ready(()=>{
            var seconds = 30;
            let url = '{{route("shop.post.addview",$post->slug)}}';
            // console.log(url);
            setTimeout(() => {
                
                $.ajax({
                    url : url,
                    method: 'get',
                    success: function(result){
                        console.log(result);
                    },
                    error: function(response){
                        console.log(response);
                    }
                });
            }, seconds*1000);
           

        })
    </script>
@endsection