@extends('shop.layout.master')
@section('title')
    Trang Chủ
@endsection
@section('headdoc')
    @parent
    <link href="{{ asset('shop/assets/css/carousel.css') }}" rel="stylesheet">
@endsection
@section('content')
    <hr class="offset-top hidden-lg hidden-lg">
    
    <header>
        <div class="carousel" data-count="{{ $sliders->count() }}" data-current="1">

            <div class="items">
                <button class="btn btn-control" data-direction="right"> <i class="ion-ios-arrow-right"></i></button>
                <button class="btn btn-control" data-direction="left"> <i class="ion-ios-arrow-left"></i></button>


                @foreach ($sliders as $key => $item)
                    <div class="item {{ $key + 1 == 1 ? 'center' : '' }}" data-marker="{{ $key + 1 }}">
                        <a href="#" class="background hidden-xs hidden-sm"><img
                                src="{{ asset('storage/' . $item->image) }}" alt="Background"
                                style="display:block; width: 100%; height:100%" /></a>
                        <img src="{{ asset('storage/' . $item->image) }}" alt="Background" class="background visible-sm" />
                        <img src="{{ asset('storage/' . $item->image) }}" alt="Background" class="background visible-xs" />

                        <!-- <img src="shop/assets/img/carousel/newlaptops.jpg" alt="New laptops" title="New laptops" class="item-left hidden-xs"/> -->

                        {{-- <div class="content">
                        <div class="outside-content">
                            <div class="inside-content">
                                <div class="container">

                                    <h1 class="h3 colorful blue hidden-xs">Device is designed for the creative people
                                    </h1>
                                    <hr class="offset-sm">

                                    <h2 class="h1 lg upp colorful blue">Apple <br> iMac 27 Retina</h2>
                                    <hr class="offset-md">
                                    <hr class="offset-md">
                                    <a href="./store/" rel="nofollow" class="btn btn-primary btn-lg black"> View
                                        products </a>

                                </div>
                            </div>
                        </div>
                    </div> --}}
                    </div>
                @endforeach
            </div>

            <ul class="markers">
                @for ($i = 1; $i <= $sliders->count(); $i++)
                    <li data-marker="{{ $i }}" data-style="white" class="{{ $i == 1 ? 'active' : '' }}"></li>
                @endfor
            </ul>

        </div>
    </header>

    <hr class="offset-lg">
    <hr class="offset-lg">
    {{-- banner --}}
    {{-- <div class="bars">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-4 no-padding padding-xs">
                    <div class="bar medium" data-background="shop/assets/img/bars/macbook.jpg">
                        <h3 class="title black">MacBook Air</h3>

                        <div class="wrapper">
                            <div class="content">
                                <hr class="offset-sm">
                                <a href="./store/" rel="nofollow" class="btn btn-default black"> Buy now </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="bar small" data-background="shop/assets/img/bars/dellinspirion.jpg">
                        <h3 class="title black">Dell Inspirion 7000</h3>

                        <div class="wrapper">
                            <div class="content">
                                <hr class="offset-sm">
                                <a href="./store/" rel="nofollow" class="btn btn-primary black"> Buy now </a>
                            </div>
                        </div>
                    </div>

                    <hr class="offset-xs">
                    <hr class="offset-xs">

                    <div class="bar small" data-background="shop/assets/img/bars/surfacestudio.jpg">
                        <h3 class="title">Surface Studio</h3>

                        <div class="wrapper">
                            <div class="content">
                                <hr class="offset-sm">
                                <a href="./store/" rel="nofollow" class="btn btn-primary black"> Buy now </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 no-padding hidden-xs hidden-sm">
                    <div class="bar medium" data-background="shop/assets/img/bars/accessories.jpg">
                        <h3 class="title black">Accessories</h3>

                        <div class="wrapper">
                            <div class="content">
                                <hr class="offset-sm">
                                <a href="./store/" rel="nofollow" class="btn btn-primary black"> Buy now </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <hr class="offset-lg">
    <hr class="offset-md">

    {{-- end banner --}}
    <section class="products">
        <div class="container">
            <h2 class="h2 upp align-center"> Laptop Nổi Bật </h2>
            <hr class="offset-lg">

            <div class="row">
                @foreach ($highlight as $item)
                    @php
                        $discounts = $item->discount;
                        // if($discounts->count()!=0)dd($discounts);
                        $discounted = 0;
                        foreach ($discounts as $discount) {
                            if ($discount->type == 0) {
                                $discounted += $item->sell_price * $discount->discounted_rate * 0.01;
                            } elseif ($discount->type == 1) {
                                $discounted += $discount->discounted_amount;
                            }
                        }
                    @endphp

                    <div class="col-sm-6 col-md-3 product">
                        <div class="body">
                            @if (Auth::check())
                                <a href="#favorites" class="favorites"  data-url="{{route('mua-sau.add',$item->id)}}" data-favorite="inactive"><i
                                        class="ion-ios-heart-outline"></i></a>
                            @endif
                            <a href="{{route('shop.product.show',$item->slug)}}"><img src="{{ asset('storage/' . $item->card_image) }}"
                                    alt="{{ $item->name }}" /></a>

                            <div class="content align-center">
                                <p class="price">{{ number_format($item->sell_price - $discounted) }}đ</p>
                                @if ($discounted > 0)
                                    <p class="price through">{{ number_format($item->sell_price) }}đ</p>
                                @else
                                <p class="price through" style="visibility: hidden">{{$item->sell_price}}đ</p>
                                @endif
                                <h2 class="h3" style="overflow: hidden;
                                    text-overflow: ellipsis;
                                    display: -webkit-box;
                                    -webkit-line-clamp: 2; /* number of lines to show */
                                            line-clamp: 2; 
                                    -webkit-box-orient: vertical;" title="{{ $item->name }}">{{ $item->name }}</h2>
                                <hr class="offset-sm">

                                <a class="btn btn-link" href="{{ route('shop.product.show', $item->slug) }}"> <i
                                        class="ion-android-open"></i> Chi tiết</a>
                                <button class="btn btn-primary btn-xs rounded add-to-cart"
                                    data-url="{{ route('shop.product.addtocart', $item->id) }}"> <i
                                        class="ion-bag"></i> Thêm vào giỏ</button>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

            <div class="align-right align-center-xs">
                <hr class="offset-sm">
                <a href="{{ route('shop.product.index') }}">
                    <h5 class="upp">Xem tất cả laptop </h5>
                </a>
            </div>
        </div>
    </section>

    <section class="products">
        <div class="container">
            <h2 class="h2 upp align-center"> Laptop mới </h2>
            <hr class="offset-lg">

            <div class="row">

                @foreach ($new as $item)
                    @php
                        $discounts = $item->discount;
                        // if($discounts->count()!=0)dd($discounts);
                        $discounted = 0;
                        foreach ($discounts as $discount) {
                            if ($discount->type == 0) {
                                $discounted += $item->sell_price * $discount->discounted_rate * 0.01;
                            } elseif ($discount->type == 1) {
                                $discounted += $discount->discounted_amount;
                            }
                        }
                    @endphp

                    <div class="col-sm-6 col-md-4 product">
                        <div class="body">
                            @if (Auth::check())
                                <a href="#favorites"  data-url="{{route('mua-sau.add',$item->id)}}" class="favorites" data-favorite="inactive"><i
                                        class="ion-ios-heart-outline"></i></a>
                            @endif

                            <a href="{{route('shop.product.show',$item->slug)}}"><img src="{{ asset('storage/' . $item->card_image) }}"
                                    alt="{{ $item->name }}" /></a>

                            <div class="content align-center">
                                <p class="price">{{ number_format($item->sell_price - $discounted) }}đ</p>
                                @if ($discounted > 0)
                                    <p class="price through">{{ number_format($item->sell_price) }}đ</p>
                                @endif
                                <h2 class="h3" style="overflow: hidden;
                                text-overflow: ellipsis;
                                display: -webkit-box;
                                -webkit-line-clamp: 2; /* number of lines to show */
                                        line-clamp: 2; 
                                -webkit-box-orient: vertical;" title="{{ $item->name }}">{{ $item->name }}</h2>

                                <hr class="offset-sm">

                                <a href="{{ route('shop.product.show', $item->slug) }}" class="btn btn-link"> <i class="ion-android-open"></i> Chi tiết</a>
                                <button class="btn btn-primary btn-sm rounded add-to-cart"
                                    data-url="{{ route('shop.product.addtocart', $item->id) }}"> <i
                                        class="ion-bag"></i> Thêm vào giỏ</button>
                            </div>
                        </div>
                    </div>
                @endforeach






            </div>
            <div class="align-right align-center-xs">
                <hr class="offset-sm">
                <a href="{{ route('shop.product.index') }}">
                    <h5 class="upp">Xem tất cả laptop </h5>
                </a>
            </div>
        </div>
    </section>


    <section class="products">
        <div class="container">
            <h2 class="h2 upp align-center"> Laptop bán chạy</h2>
            <hr class="offset-lg">

            <div class="row">

                @foreach ($bestseller as $item)
                @php
                    $discounts = $item->discount;
                    // if($discounts->count()!=0)dd($discounts);
                    $discounted = 0;
                    foreach ($discounts as $discount) {
                        if ($discount->type == 0) {
                            $discounted += $item->sell_price * $discount->discounted_rate * 0.01;
                        } elseif ($discount->type == 1) {
                            $discounted += $discount->discounted_amount;
                        }
                    }
                @endphp

                <div class="col-sm-6 col-md-4 product">
                    <div class="body">
                        @if (Auth::check())
                            <a href="#favorites"  data-url="{{route('mua-sau.add',$item->id)}}" class="favorites" data-favorite="inactive"><i
                                    class="ion-ios-heart-outline"></i></a>
                        @endif

                        <a href="{{route('shop.product.show',$item->slug)}}"><img src="{{ asset('storage/' . $item->card_image) }}"
                                alt="{{ $item->name }}" /></a>

                        <div class="content align-center">
                            <p class="price">{{ number_format($item->sell_price - $discounted) }}đ</p>
                            @if ($discounted > 0)
                                <p class="price through">{{ number_format($item->sell_price) }}đ</p>
                                @else
                                <p class="price through" style="visibility: hidden">{{$item->sellprice}}</p>
                            @endif
                            <h2 class="h3" style="overflow: hidden;
                            text-overflow: ellipsis;
                            display: -webkit-box;
                            -webkit-line-clamp: 2; /* number of lines to show */
                                    line-clamp: 2; 
                            -webkit-box-orient: vertical;" title="{{ $item->name }}">{{ $item->name }}</h2>

                            <hr class="offset-sm">

                            <a href="{{ route('shop.product.show', $item->slug) }}" class="btn btn-link"> <i class="ion-android-open"></i> Chi tiết</a>
                            <button class="btn btn-primary btn-sm rounded add-to-cart"
                                data-url="{{ route('shop.product.addtocart', $item->id) }}"> <i
                                    class="ion-bag"></i> Thêm vào giỏ</button>
                        </div>
                    </div>
                </div>
            @endforeach



            </div>
            <div class="align-right align-center-xs">
                <hr class="offset-sm">
                <a href="./store/">
                    <h5 class="upp">Xem tất cả laptop </h5>
                </a>
            </div>
        </div>
    </section>


    <section class="blog">
        <div class="container">
            <h2 class="h2 upp align-center"> Bài viết </h2>
            <hr class="offset-lg">

            <div class="row">

                @foreach ($posts as $item)
                <div class="col-sm-6 col-md-6 item">

                    <div class="body">
                        <a href="{{route('shop.post.show',$item->slug)}}" class="view"><i class="ion-ios-book-outline"></i></a>
                        <a href="{{route('shop.post.show',$item->slug)}}">
                            <img src="{{asset('storage/'.$item->cover_image)}}"
                                title="{{$item->title}}" alt="{{$item->title}}">
                        </a>

                        <div class="caption">
                            <h2 class="h3">{{$item->title}}</h2>
                            <label> {{$item->created_at}}</label>
                            <hr class="offset-sm">

                            <p>
                                {{$item->meta_description}}
                            </p>
                            <hr class="offset-sm">

                            <a href="{{route('shop.post.show',$item->slug)}}"> Xem bài viết </a>
                        </div>
                    </div>
                </div>
                @endforeach
                

               

            </div>

            <div class="align-right align-center-xs">
                <hr class="offset-sm">
                <a href="{{route('shop.post')}}">
                    <h5 class="upp">Xem thêm bài viết </h5>
                </a>
            </div>
        </div>
    </section>

    {{-- end content --}}

    <hr class="offset-lg">
    <hr class="offset-sm">
@endsection
@section('scripts')
    @parent
    <script type="text/javascript" src="{{ asset('shop/assets/js/carousel.js') }}"></script>
@endsection
