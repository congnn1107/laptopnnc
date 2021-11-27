@extends('shop.layout.master')
@section('title')
    Trang Chủ
@endsection
@section('content')
<hr class="offset-lg">
    <hr class="offset-lg">
    <hr class="offset-lg hidden-xs">
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
            <h2 class="h2 upp align-center"> Sản Phẩm Nổi Bật </h2>
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
                            <p class="price">{{ $item->sell_price }}đ</p>
                            <h2 class="h3" style="overflow: hidden;
                            text-overflow: ellipsis;
                            display: -webkit-box;
                            -webkit-line-clamp: 2; /* number of lines to show */
                                    line-clamp: 2; 
                            -webkit-box-orient: vertical;" title="{{ $item->name }}">{{ $item->name }}</h2>
                            <hr class="offset-sm">

                            <button class="btn btn-link"> <i class="ion-android-open"></i> Xem chi tiết</button>
                            <button class="btn btn-primary btn-sm rounded"> <i class="ion-bag"></i> Thêm vào giỏ hàng</button>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>

            <div class="align-right align-center-xs">
                <hr class="offset-sm">
                <a href="./store/">
                    <h5 class="upp">View all desktops </h5>
                </a>
            </div>
        </div>
    </section>

    <section class="products">
        <div class="container">
            <h2 class="h2 upp align-center"> Hybrid devices</h2>
            <hr class="offset-lg">

            <div class="row">

                <div class="col-sm-6 col-md-4 product">
                    <div class="body">
                        <a href="#favorites" class="favorites" data-favorite="inactive"><i
                                class="ion-ios-heart-outline"></i></a>
                        <a href="./"><img src="shop/assets/img/products/lenovo-yoga.jpg" alt="Lenovo Yoga 900" /></a>

                        <div class="content align-center">
                            <p class="price">$1899.99</p>
                            <h2 class="h3">Lenovo Yoga 900</h2>
                            <hr class="offset-sm">

                            <button class="btn btn-link"> <i class="ion-android-open"></i> Details</button>
                            <button class="btn btn-primary btn-sm rounded"> <i class="ion-bag"></i> Add to
                                cart</button>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-4 product">
                    <div class="body">
                        <a href="#favorites" class="favorites" data-favorite="inactive"><i
                                class="ion-ios-heart-outline"></i></a>
                        <a href="./"><img src="shop/assets/img/products/surface-pro.jpg" alt="Surface Pro" /></a>

                        <div class="content align-center">
                            <p class="sale">$2099.99</p>
                            <p class="price through">$2499.99</p>
                            <h2 class="h3">Microsoft Surface Pro</h2>
                            <hr class="offset-sm">

                            <button class="btn btn-link"> <i class="ion-android-open"></i> Details</button>
                            <button class="btn btn-primary btn-sm rounded"> <i class="ion-bag"></i> Add to
                                cart</button>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-4 product">
                    <div class="body">
                        <a href="#favorites" class="favorites" data-favorite="inactive"><i
                                class="ion-ios-heart-outline"></i></a>
                        <a href="./"><img src="shop/assets/img/products/hp-spectre-x360.jpg" alt="HP Spectre x360" /></a>

                        <div class="content align-center">
                            <p class="price">$2994.99</p>
                            <h2 class="h3">HP Spectre x360</h2>
                            <hr class="offset-sm">

                            <button class="btn btn-link"> <i class="ion-android-open"></i> Details</button>
                            <button class="btn btn-primary btn-sm rounded"> <i class="ion-bag"></i> Add to
                                cart</button>
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
                            <p class="price">$1994.99</p>
                            <h2 class="h3">Dell Inspiron 7000</h2>
                            <hr class="offset-sm">

                            <button class="btn btn-link"> <i class="ion-android-open"></i> Details</button>
                            <button class="btn btn-primary btn-sm rounded"> <i class="ion-bag"></i> Add to
                                cart</button>
                        </div>
                    </div>
                </div>


            </div>
            <div class="align-right align-center-xs">
                <hr class="offset-sm">
                <a href="./store/">
                    <h5 class="upp">View all devices </h5>
                </a>
            </div>
        </div>
    </section>


    <section class="products">
        <div class="container">
            <h2 class="h2 upp align-center"> Tablets</h2>
            <hr class="offset-lg">

            <div class="row">

                <div class="col-sm-6 col-md-4 product">
                    <div class="body">
                        <a href="#favorites" class="favorites" data-favorite="inactive"><i
                                class="ion-ios-heart-outline"></i></a>
                        <a href="./"><img src="shop/assets/img/products/mi-pad-2.jpg" alt="Xiamomi Mi Pad 2" /></a>

                        <div class="content align-center">
                            <p class="price">$899.99</p>
                            <h2 class="h3">Mi Pad 2</h2>
                            <hr class="offset-sm">

                            <button class="btn btn-link"> <i class="ion-android-open"></i> Details</button>
                            <button class="btn btn-primary btn-sm rounded"> <i class="ion-bag"></i> Add to
                                cart</button>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-4 product">
                    <div class="body">
                        <a href="#favorites" class="favorites" data-favorite="inactive"><i
                                class="ion-ios-heart-outline"></i></a>
                        <a href="./"><img src="shop/assets/img/products/ipad-air.jpg" alt="Apple iPad Air" /></a>

                        <div class="content align-center">
                            <p class="price">$1099.99</p>
                            <h2 class="h3">Apple iPad Air</h2>
                            <hr class="offset-sm">

                            <button class="btn btn-link"> <i class="ion-android-open"></i> Details</button>
                            <button class="btn btn-primary btn-sm rounded"> <i class="ion-bag"></i> Add to
                                cart</button>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-4 product">
                    <div class="body">
                        <a href="#favorites" class="favorites" data-favorite="inactive"><i
                                class="ion-ios-heart-outline"></i></a>
                        <a href="./"><img src="shop/assets/img/products/asus-transformer.jpg" alt="Asus Transformer" /></a>

                        <div class="content align-center">
                            <p class="price">$987.99</p>
                            <h2 class="h3">Asus Transformer</h2>
                            <hr class="offset-sm">

                            <button class="btn btn-link"> <i class="ion-android-open"></i> Details</button>
                            <button class="btn btn-primary btn-sm rounded"> <i class="ion-bag"></i> Add to
                                cart</button>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-4 product visible-sm">
                    <div class="body">
                        <a href="#favorites" class="favorites" data-favorite="inactive"><i
                                class="ion-ios-heart-outline"></i></a>
                        <a href="./"><img src="shop/assets/img/products/ipad-mini.jpg" alt="iPad Mini" /></a>

                        <div class="content align-center">
                            <p class="price">$399.99</p>
                            <h2 class="h3">iPad Mini</h2>
                            <hr class="offset-sm">

                            <button class="btn btn-link"> <i class="ion-android-open"></i> Details</button>
                            <button class="btn btn-primary btn-sm rounded"> <i class="ion-bag"></i> Add to
                                cart</button>
                        </div>
                    </div>
                </div>


            </div>
            <div class="align-right align-center-xs">
                <hr class="offset-sm">
                <a href="./store/">
                    <h5 class="upp">View all tablets </h5>
                </a>
            </div>
        </div>
    </section>


    <section class="blog">
        <div class="container">
            <h2 class="h2 upp align-center"> Blog Headlines </h2>
            <hr class="offset-lg">

            <div class="row">

                <div class="col-sm-6 col-md-6 item">

                    <div class="body">
                        <a href="#" class="view"><i class="ion-ios-book-outline"></i></a>
                        <a href="#">
                            <img src="shop/assets/img/blog/img1.jpg" title="Apple Devices" alt="Apple Devices">
                        </a>

                        <div class="caption">
                            <h2 class="h3">The next generation of Multi-Touch</h2>
                            <label> 07.01.2017</label>
                            <hr class="offset-sm">

                            <p>
                                The original iPhone introduced the world to Multi-Touch, forever changing the way people
                                experience technology. With 3D Touch, you can do things that were never possible before.
                                It senses how deeply you press the display, letting you do all kinds of essential things
                                more quickly and simply. And it gives you real-time feedback in the form of subtle taps
                                from the all-new Taptic Engine.
                            </p>
                            <hr class="offset-sm">

                            <a href="#"> View article </a>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-6 item">

                    <div class="body">
                        <a href="#" class="view"><i class="ion-ios-book-outline"></i></a>
                        <a href="#">
                            <img src="shop/assets/img/blog/img2.jpg" title="Coffee" alt="Coffee">
                        </a>

                        <div class="caption">
                            <h2 class="h3">MacBook Pro - brand new day for business.</h2>
                            <label> 02.01.2017</label>
                            <hr class="offset-sm">

                            <p>
                                Organizations everywhere are realizing the potential that Mac brings to their employees
                                by giving them the freedom to use the tools they already know and love. Software and
                                hardware made for each other. Because Apple designs both the software and hardware,
                                every Mac delivers the best possible experience for employees.
                            </p>
                            <hr class="offset-sm">

                            <a href="#"> View article <i class="ion-ios-arrow-right"></i> </a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="align-right align-center-xs">
                <hr class="offset-sm">
                <a href="./blog/">
                    <h5 class="upp">View all articels </h5>
                </a>
            </div>
        </div>
    </section>

    {{-- end content --}}

    <hr class="offset-lg">
    <hr class="offset-sm">
@endsection