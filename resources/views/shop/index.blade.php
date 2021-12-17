@extends('shop.layout.master')
@section('title')
    Trang Chủ
@endsection
@section('headdoc')
    @parent
    <link href="{{asset('shop/assets/css/carousel.css')}}" rel="stylesheet">
@endsection
@section('content')

    <header>
        <div class="carousel" data-count="{{ $sliders->count() }}" data-current="1">

            <div class="items">
                <button class="btn btn-control" data-direction="right"> <i class="ion-ios-arrow-right"></i></button>
                <button class="btn btn-control" data-direction="left"> <i class="ion-ios-arrow-left"></i></button>


                @foreach ($sliders as $key => $item)
                <div class="item {{ $key+1 ==1?'center':'' }}" data-marker="{{ $key+1 }}">
                    <a href="#" class="background hidden-xs hidden-sm"><img src="{{ asset('storage/'.$item->image) }}" alt="Background"  style="display:block; width: 100%; height:100%"/></a>
                    <img src="{{ asset('storage/'.$item->image) }}" alt="Background" class="background visible-sm" />
                    <img src="{{ asset('storage/'.$item->image) }}" alt="Background" class="background visible-xs" />

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
                <li data-marker="{{$i}}" data-style="white" class="{{ $i==1?'active':'' }}"></li>
                @endfor
            </ul>

        </div>
    </header>
    
    <hr class="offset-lg">
    <hr class="offset-lg">
    {{-- banner --}}
    <div class="bars">
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
    </div>
    <hr class="offset-lg">
    <hr class="offset-md">

    {{-- end banner --}}
    <section class="products">
        <div class="container">
            <h2 class="h2 upp align-center"> Laptop Nổi Bật </h2>
            <hr class="offset-lg">

            <div class="row">
                @foreach ($products as $item)
                    
                
                <div class="col-sm-6 col-md-3 product">
                    <div class="body">
                        <a href="#favorites" class="favorites" data-favorite="inactive"><i
                                class="ion-ios-heart-outline"></i></a>
                        <a href="./"><img src="{{ asset('storage/'.$item->card_image) }}"
                                alt="{{ $item->name }}" /></a>

                        <div class="content align-center">
                            <p class="price">{{ number_format($item->sell_price) }}đ</p>
                            <h2 class="h3" style="overflow: hidden;
                            text-overflow: ellipsis;
                            display: -webkit-box;
                            -webkit-line-clamp: 2; /* number of lines to show */
                                    line-clamp: 2; 
                            -webkit-box-orient: vertical;" title="{{ $item->name }}">{{ $item->name }}</h2>
                            <hr class="offset-sm">

                            <a class="btn btn-link" href="{{{route('shop.product.show',$item->slug)}}}"> <i class="ion-android-open" ></i > Chi tiết</a>
                            <button class="btn btn-primary btn-xs rounded add-to-cart" data-url="{{ route('shop.product.addtocart',$item->id) }}"> <i class="ion-bag"></i> Thêm vào giỏ</button>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>

            <div class="align-right align-center-xs">
                <hr class="offset-sm">
                <a href="{{route('shop.product.index')}}">
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

                <div class="col-sm-6 col-md-4 product">
                    <div class="body">
                        <a href="#favorites" class="favorites" data-favorite="inactive"><i
                                class="ion-ios-heart-outline"></i></a>
                        <a href="./"><img src="shop/assets/img/products/lenovo-yoga.jpg" alt="Lenovo Yoga 900" /></a>

                        <div class="content align-center">
                            <p class="price">17,550,000đ</p>
                            <h2 class="h3">Lenovo Yoga 900</h2>
                            <hr class="offset-sm">

                            <button class="btn btn-link"> <i class="ion-android-open"></i> Chi tiết</button>
                            <button class="btn btn-primary btn-sm rounded"> <i class="ion-bag"></i> Thêm vào giỏ</button>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-4 product">
                    <div class="body">
                        <a href="#favorites" class="favorites" data-favorite="inactive"><i
                                class="ion-ios-heart-outline"></i></a>
                        <a href="./"><img src="shop/assets/img/products/surface-pro.jpg" alt="Surface Pro" /></a>

                        <div class="content align-center">
                            <p class="sale">18,840,000đ</p>
                            <p class="price through">19,990,000đ</p>
                            <h2 class="h3">Microsoft Surface Pro</h2>
                            <hr class="offset-sm">

                            <button class="btn btn-link"> <i class="ion-android-open"></i> Chi tiết</button>
                            <button class="btn btn-primary btn-sm rounded"> <i class="ion-bag"></i>Thêm vào giỏ</button>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-4 product">
                    <div class="body">
                        <a href="#favorites" class="favorites" data-favorite="inactive"><i
                                class="ion-ios-heart-outline"></i></a>
                        <a href="./"><img src="shop/assets/img/products/hp-spectre-x360.jpg" alt="HP Spectre x360" /></a>

                        <div class="content align-center">
                            <p class="price">21,090,000đ</p>
                            <h2 class="h3">HP Spectre x360</h2>
                            <hr class="offset-sm">

                            <button class="btn btn-link"> <i class="ion-android-open"></i> Chi tiết</button>
                            <button class="btn btn-primary btn-sm rounded"> <i class="ion-bag"></i>Thêm vào giỏ</button>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-4 product visible-sm">
                    <div class="body">
                        <a href="#favorites" class="favorites" data-favorite="inactive"><i
                                class="ion-ios-heart-outline"></i></a>
                        <a href="./"><img src="shop/assets/img/products/dell-inspiron-2in1.jpg"
                                alt="Dell Inspiron 7000 2-in-1s" /></a>

                        <div class="content align-center">
                            <p class="price">17,200,000đ</p>
                            <h2 class="h3">Dell Inspiron 7000</h2>
                            <hr class="offset-sm">

                            <button class="btn btn-link"> <i class="ion-android-open"></i> Chi tiết</button>
                            <button class="btn btn-primary btn-sm rounded"> <i class="ion-bag"></i> Thêm vào giỏ</button>
                        </div>
                    </div>
                </div>


            </div>
            <div class="align-right align-center-xs">
                <hr class="offset-sm">
                <a href="{{route('shop.product.index')}}">
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

                <div class="col-sm-6 col-md-4 product">
                    <div class="body">
                        <a href="#favorites" class="favorites" data-favorite="inactive"><i
                                class="ion-ios-heart-outline"></i></a>
                        <a href="./"><img src="shop/assets/img/products/surface-pro.jpg" alt="Surface Pro" /></a>

                        <div class="content align-center">
                            <p class="sale">19,990,000đ</p>
                            <p class="price through">21,690,000đ</p>
                            <h2 class="h3">Microsoft Surface Pro</h2>
                            <hr class="offset-sm">

                            <button class="btn btn-link"> <i class="ion-android-open"></i> Chi tiết</button>
                            <button class="btn btn-primary btn-sm rounded"> <i class="ion-bag"></i> Thêm vào giỏ</button>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-4 product visible-sm">
                    <div class="body">
                        <a href="#favorites" class="favorites" data-favorite="inactive"><i
                                class="ion-ios-heart-outline"></i></a>
                        <a href="./"><img src="shop/assets/img/products/dell-inspiron-2in1.jpg"
                                alt="Dell Inspiron 7000 2-in-1s" /></a>

                        <div class="content align-center">
                            <p class="price">18,290,000đ</p>
                            <h2 class="h3">Dell Inspiron 7000</h2>
                            <hr class="offset-sm">

                            <button class="btn btn-link"> <i class="ion-android-open"></i> Chi tiết</button>
                            <button class="btn btn-primary btn-sm rounded"> <i class="ion-bag"></i> Thêm vào giỏ</button>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-4 product">
                    <div class="body">
                        <a href="#favorites" class="favorites" data-favorite="inactive"><i
                                class="ion-ios-heart-outline"></i></a>
                        <a href="./"><img src="shop/assets/img/products/hp-spectre-x360.jpg" alt="HP Spectre x360" /></a>

                        <div class="content align-center">
                            <p class="price">22,349,000đ</p>
                            <h2 class="h3">HP Spectre x360</h2>
                            <hr class="offset-sm">

                            <button class="btn btn-link"> <i class="ion-android-open"></i> Chi tiết</button>
                            <button class="btn btn-primary btn-sm rounded"> <i class="ion-bag"></i>Thêm vào giỏ</button>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-4 product">
                    <div class="body">
                        <a href="#favorites" class="favorites" data-favorite="inactive"><i
                                class="ion-ios-heart-outline"></i></a>
                        <a href="./"><img src="shop/assets/img/products/lenovo-yoga.jpg" alt="Lenovo Yoga 900" /></a>

                        <div class="content align-center">
                            <p class="price">15,690,000đ</p>
                            <h2 class="h3">Lenovo Yoga 900</h2>
                            <hr class="offset-sm">

                            <button class="btn btn-link"> <i class="ion-android-open"></i> Chi tiết</button>
                            <button class="btn btn-primary btn-sm rounded"> <i class="ion-bag"></i> Thêm vào giỏ</button>
                        </div>
                    </div>
                </div>


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

                <div class="col-sm-6 col-md-6 item">

                    <div class="body">
                        <a href="#" class="view"><i class="ion-ios-book-outline"></i></a>
                        <a href="#">
                            <img src="https://cellphones.com.vn/sforum/wp-content/uploads/2021/12/thong-tin-Mac-2022-cover-350x250.jpg" title="Apple Devices" alt="Apple Devices">
                        </a>

                        <div class="caption">
                            <h2 class="h3">Chúng ta có thể mong chờ gì từ dòng máy Mac 2022 của Apple?</h2>
                            <label> 07.11.2021</label>
                            <hr class="offset-sm">

                            <p>
                                Vào cuối năm ngoái, Apple đã bắt đầu quá trình chuyển đổi từ chip Intel sang Silicon M-series cho dòng máy Mac của hãng. Hiện tại, công ty này đã đi được một nửa chặng đường và gặt hái được khá nhiều thành công.
                            </p>
                            <hr class="offset-sm">

                            <a href="#"> Xem bài viết </a>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-6 item">

                    <div class="body">
                        <a href="#" class="view"><i class="ion-ios-book-outline"></i></a>
                        <a href="#">
                            <img src="https://cellphones.com.vn/sforum/wp-content/uploads/2021/10/ASUS-TUF-GAMING-F7-1-350x250.jpg" title="Coffee" alt="Coffee">
                        </a>

                        <div class="caption">
                            <h2 class="h3">Trên tay Asus TUF Gaming F17: Thiết kế tinh tế, đậm chất gaming</h2>
                            <label> 01.09.2021</label>
                            <hr class="offset-sm">

                            <p>
                                Một mùa “Back to school nữa cũng đã tới” đã tới, và đây cũng chính là thời điểm mà Asus vừa tung ra thị trường 2 mẫu laptop gaming mới trong bộ sưu tập TUF Gaming của mình để phục vụ nhu cầu học tập của các bạn học sinh, sinh viên...
                            </p>
                            <hr class="offset-sm">

                            <a href="#"> Xem bài viết <i class="ion-ios-arrow-right"></i> </a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="align-right align-center-xs">
                <hr class="offset-sm">
                <a href="./blog/">
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