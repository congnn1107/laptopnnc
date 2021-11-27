@extends('shop.layout.master')
@section('headdoc')
@parent
<link href="{{asset('shop/assets/css/carousel-product.css')}}" rel="stylesheet">
<style>
    h1,
    h2.h1 {
        font-size: 25px;
        line-height: 28px;
        word-break: break-all;
    }

    p a img {
        display: block;
        width: 100%;
    }

    .carousel-product>.markers>li {
        width: 30px;
        height: 30px;
        opacity: 0.3;
    }

</style>
@endsection

@section('title')
    {{ $product->name }}
@endsection

@section('content')
    <hr class="offset-lg">
    <hr class="offset-lg">
    <hr class="offset-lg hidden-xs">

    <section class="product">
        <div class="container">
            <div class="row">
                <div class="col-sm-7 col-md-7 white no-padding">
                    @php
                        $productImages = $product->images;
                        $imageCount = count($productImages);
                    @endphp
                    <div class="carousel-product" data-count="{{ $imageCount }}" data-current="1">

                        <div class="items">
                            <button class="btn btn-control" data-direction="right"> <i
                                    class="ion-ios-arrow-right"></i></button>
                            <button class="btn btn-control" data-direction="left"> <i
                                    class="ion-ios-arrow-left"></i></button>

                            @foreach ($productImages as $key => $item)
                                <div class="item{{ $key == 0 ? ' center' : '' }}" data-marker="{{ $key + 1 }}">
                                    <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $product->name }}"
                                        class="background" />
                                </div>
                            @endforeach

                        </div>

                        <ul class="markers">
                            @for ($i = 1; $i <= $imageCount; $i++)
                                <li data-marker="{{ $i }}" {{ $i == 1 ? 'class=active' : '' }}></li>
                            @endfor
                        </ul>
                    </div>


                </div>
                <div class="col-sm-5 col-md-5 no-padding-xs">
                    <div class="caption">
                        {{-- <img src="../assets/img/brands/microsoft.png" alt="Microsoft" class="brand hidden-xs hidden-sm" /> --}}

                        <h1>{{ $product->name }}</h1>
                        @php
                            $cpu = $product->cpu()->first();
                            $gpu = $product->gpu()->first();
                        @endphp
                        <p> &middot; {{ $product->operating_system }}</p>
                        <p> &middot; {{ $product->screen_detail }}</p>
                        <p> &middot; {{ $cpu->name }}</p>
                        <hr class="offset-md hidden-sm">
                        <hr class="offset-sm visible-sm">
                        <hr class="offset-xs visible-sm">

                        <p class="price">{{ number_format($product->sell_price) }}đ</p>
                        <p class="price through">$3 449.99</p>
                        <hr class="offset-md">

                        <button class="btn btn-primary rounded"> <i class="ion-bag"></i> Thêm vào giỏ hàng</button>
                        <button class="btn btn-link"> <i class="ion-ios-heart"></i> Mua sau </button>
                    </div>
                </div>
            </div>
            <hr class="offset-sm hidden-xs">

            <div class="row">
                <div class="col-sm-7 white sm-padding scrollable">
                    <hr class="offset-sm visible-xs">

                    <h2>{{ $product->name }}</h2>

                    <h2 class="h1">Thông số sản phẩm</h2>
                    <br>

                    <div class="row specification">
                        <div class="col-sm-4"> <label>Hệ điều hành theo máy: </label> </div>
                        <div class="col-sm-8">
                            <p>{{ $product->operating_system }}</p>
                        </div>
                    </div>

                    <div class="row specification">
                        <div class="col-sm-4"> <label>Màn hình</label> </div>
                        <div class="col-sm-8">
                            <p>
                                Loại màn hình: {{ $product->screen_type }}<br>
                                Kích thước: {{ $product->screen_size }} inches <br>
                                Chi tiết: {{ $product->screen_detail }}
                            </p>
                        </div>
                    </div>

                    <div class="row specification">
                        <div class="col-sm-4"> <label>Vi xử lý</label> </div>
                        <div class="col-sm-8">
                            <p>{{ "$cpu->brand $cpu->name $cpu->cores nhân - $cpu->threads luồng" }} <br>
                                Xung nhịp cơ bản: {{ $cpu->base_clock }} <br>
                                Xung nhịp turbo: {{ $cpu->turbo_clock }} <br>
                                Bộ nhớ đệm: {{ $cpu->cache }}
                            </p>
                        </div>
                    </div>


                    <div class="row specification">
                        <div class="col-sm-4"> <label>Đồ họa: </label> </div>
                        <div class="col-sm-8">
                            <p>
                                Đồ họa tích hợp: {{ $cpu->intergrated_gpu }}
                                @if ($gpu)
                                    <br>
                                    Đồ họa rời: {{ "$gpu->brand $gpu->series $gpu->name, $gpu->clock" }}. <br>
                                    Mô tả: {{ $gpu->addition }}
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="row specification">
                        <div class="col-sm-4"> <label>Bộ nhớ Ram</label> </div>
                        <div class="col-sm-8">
                            <p>
                                Số khe RAM: {{ $product->memory_slots }} <br>
                                Loại RAM: {{ $product->memory_type }} <br>
                                Dung lượng: {{ $product->memory_capacity }}
                            </p>
                        </div>
                    </div>

                    <div class="row specification">
                        <div class="col-sm-4"> <label>Ổ cứng</label> </div>
                        <div class="col-sm-8">
                            <p>
                                SSD: {{ $product->ssd_storage }} <br>
                                Dung lượng SSD: {{ $product->ssd_capacity }} <br>
                                HDD: {{ $product->hdd_storage }} <br>
                                Dung lượng HDD: {{ $product->hdd_capacity }}
                            </p>
                        </div>
                    </div>

                    <div class="row specification">
                        <div class="col-sm-4"> <label>Kết nối không dây</label> </div>
                        <div class="col-sm-8">
                            <p>
                                Wi-Fi: {{ $product->wifi }}<br>
                                Bluetooth: {{ $product->bluetooth }}<br>
                            </p>
                        </div>
                    </div>

                    <div class="row specification">
                        <div class="col-sm-4"> <label>Cổng kết nối</label> </div>
                        <div class="col-sm-8">
                            <p>
                                {!! str_replace(', ', '<br>', $product->connection_jacks) !!}
                            </p>
                        </div>
                    </div>

                    <div class="row specification">
                        <div class="col-sm-4"> <label>Bàn phím</label> </div>
                        <div class="col-sm-8">
                            <p>{{ $product->keyboard }}</p>
                        </div>
                    </div>
                    <div class="row specification">
                        <div class="col-sm-4"> <label>Đặc điểm khác</label> </div>
                        <div class="col-sm-8">
                            <p>{{ $product->addition }}</p>
                        </div>
                    </div>
                    <div class="row specification">
                        <div class="col-sm-4"> <label>Vỏ</label> </div>
                        <div class="col-sm-8">
                            <p>Chất liệu: {{ $product->case_material }}
                                <br>
                                Màu: {{ $product->color }}
                            </p>
                        </div>
                    </div>
                    <div class="row specification">
                        <div class="col-sm-4"> <label>Pin</label> </div>
                        <div class="col-sm-8">
                            <p>{{ $product->battery }}</p>
                        </div>
                    </div>

                    <hr class="offset-lg">
                    <h2>Mô tả sản phẩm</h2>
                    <div class="wrapper">
                        <div class="content">
                            {!! $product->describe !!}
                        </div>
                    </div>
                    <hr class="offset-lg">
                </div>
                <div class="col-sm-5 no-padding-xs">
                    <div class="talk white">
                        <h2 class="h3">Bạn có bất kỳ thắc mắc gì?</h2>
                        <p class="">Liên hệ ngay với chúng tôi</p>
                        <hr class="offset-md">

                        <a href="tel:0352765398" class="btn btn-primary btn-sm"> <i class="fa fa-phone"></i> 0352765398
                        </a>
                        <hr class="offset-md visible-xs">
                    </div>
                    <hr class="offset-sm hidden-xs">

                    <div class="comments white">
                        <h2 class="h3">What do you think? (#3)</h2>
                        <br>


                        <div class="wrapper">
                            <div class="content">
                                <h3>Anne Hathaway</h3>
                                <label>2 years ago</label>
                                <p>
                                    Apple Music brings iTunes music streaming to the UK. But is it worth paying for? In our
                                    Apple Music review, we examine the service's features, UK pricing, audio quality and
                                    music library
                                </p>


                                <h3>Chris Hemsworth</h3>
                                <label>Today</label>
                                <p>
                                    Samsung's Galaxy S7 smartphone is getting serious hype. Here's what it does better than
                                    Apple's iPhone 6s.
                                </p>


                                <h3>Anne Hathaway</h3>
                                <label>2 years ago</label>
                                <p>
                                    Apple Music brings iTunes music streaming to the UK. But is it worth paying for? In our
                                    Apple Music review, we examine the service's features, UK pricing, audio quality and
                                    music library
                                </p>
                            </div>
                        </div>
                        <hr class="offset-lg">
                        <hr class="offset-md">

                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#Modal-Comment"> <i
                                class="ion-chatbox-working"></i> Add comment </button>
                        <hr class="offset-md visible-xs">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <hr class="offset-lg">

    {{-- <section class="products">
        <div class="container">
            <h2 class="upp align-center-xs"> Related products </h2>
            <hr class="offset-lg">

            <div class="row">

                <div class="col-sm-4 col-md-3 product">
                    <div class="body">
                        <a href="#favorites" class="favorites" data-favorite="inactive"><i
                                class="ion-ios-heart-outline"></i></a>
                        <a href="./"><img src="../assets/img/products/apple-imac-27-retina.jpg"
                                alt="Apple iMac 27 Retina" /></a>

                        <div class="content align-center">
                            <p class="price">$2099.99</p>
                            <h2 class="h3">iMac 27 Retina</h2>
                            <hr class="offset-sm">

                            <button class="btn btn-link"> <i class="ion-android-open"></i> Details</button>
                            <button class="btn btn-primary btn-sm rounded"> <i class="ion-bag"></i> Add to
                                cart</button>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4 col-md-3 product">
                    <div class="body">
                        <a href="#favorites" class="favorites" data-favorite="inactive"><i
                                class="ion-ios-heart-outline"></i></a>
                        <a href="./"><img src="../assets/img/products/dell-inspiron-23.jpg" alt="Dell Inspion 23" /></a>

                        <div class="content align-center">
                            <p class="price">$1987.99</p>
                            <h2 class="h3">Dell Inspion 23</h2>
                            <hr class="offset-sm">

                            <button class="btn btn-link"> <i class="ion-android-open"></i> Details</button>
                            <button class="btn btn-primary btn-sm rounded"> <i class="ion-bag"></i> Add to
                                cart</button>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4 col-md-3 product">
                    <div class="body">
                        <a href="#favorites" class="favorites" data-favorite="inactive"><i
                                class="ion-ios-heart-outline"></i></a>
                        <a href="./"><img src="../assets/img/products/lenovo-yoga.jpg" alt="Lenovo Yoga 900" /></a>

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

                <div class="col-sm-6 col-md-3 product hidden-sm">
                    <div class="body">
                        <a href="#favorites" class="favorites" data-favorite="inactive"><i
                                class="ion-ios-heart-outline"></i></a>
                        <a href="./"><img src="../assets/img/products/hp-spectre-x360.jpg" alt="HP Spectre x360" /></a>

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

            </div>

        </div>
    </section> --}}


    <hr class="offset-lg">
    <hr class="offset-sm">
    <div class="modal fade" id="Modal-Comment" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header align-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true"><i class="ion-android-close"></i></span></button>
                    <h1 class="h4 modal-title">Add your comment</h1>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form class="join" action="index.php" method="post">
                            <div class="row">
                                <div class="col-sm-12">
                                    <textarea name="comment" placeholder="Type here" required="" class="form-control"
                                        rows="5"></textarea>
                                    <br>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" name="name" value="" placeholder="Name" required=""
                                        class="form-control" />
                                </div>
                                <div class="col-sm-6">
                                    <input type="email" name="email" value="" placeholder="E-mail" required=""
                                        class="form-control" />
                                </div>
                                <div class="col-sm-12">
                                    <div class="align-center">
                                        <br>
                                        <button type="submit" class="btn btn-primary btn-sm"> <i
                                                class="ion-android-send"></i> Send</button>
                                        <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal"> <i
                                                class="ion-android-share"></i> No, thanks </button>
                                        <br><br>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    @parent
    <script src="{{asset('shop/assets/js/carousel-product.js')}}"></script>
    <script>
        $(document).ready(() => {
            $('scrollable').mCustomScrollbar({
                axis: "y",
                theme: "dark",
                setHeight: 100
            });
        });
    </script>
@endsection
