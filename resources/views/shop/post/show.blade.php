@extends('shop.layout.master')
@section('title')
    {{$post->title}}
@endsection
@section('headdoc')
    @parent
    <meta name="description" content="{{$post->meta_description}}">
    <meta name="keywords" content="{{$post->meta_keyword}}">
    <meta name="author" content="{{$post->author()->first()->name}}">
@endsection
@section('content')
    <div class="blog-item">
        <hr class="offset-lg visible-xs">
        <hr class="offset-lg visible-xs">
        <img src="{{asset('storage/'.$post->cover_image)}}" alt="{{$post->title}}" class="hidden-xs" />
        <div class="white">
            <hr class="offset-md">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2 text-justify">
                        <h1>{{$post->title}}</h1>
                        <p><i>{{$post->author()->first()->name}} -  {{$post->created_at}}</i></p>
                        {!! $post->content !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection