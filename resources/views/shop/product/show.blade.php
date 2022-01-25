@extends('shop.layout.master')
@section('headdoc')
    @parent
    <link href="{{ asset('shop/assets/css/carousel-product.css') }}" rel="stylesheet">
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

        /* Review Star */
        .star {
            font-size: 25px;
            color: gray;

        }

        .star.small {
            font-size: 16px;
        }

        .btn-star {
            cursor: pointer;
        }

        .star.checked {
            color: rgb(255, 196, 0);
        }

        .star .btn-star .checked {}

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
                            //xử lý khuyến mại
                            $discounts = $product->discount;
                            // if($discounts->count()!=0)dd($discounts);
                            $discounted = 0;
                            foreach ($discounts as $discount) {
                                if ($discount->type == 0) {
                                    $discounted += $product->sell_price * $discount->discounted_rate * 0.01;
                                } elseif ($discount->type == 1) {
                                    $discounted += $discount->discounted_amount;
                                }
                            }
                        @endphp
                        <p> &middot; {{ $product->operating_system }}</p>
                        <p> &middot; {{ $product->screen_detail }}</p>
                        <p> &middot; {{ $cpu->name }}</p>
                        <hr class="offset-md hidden-sm">
                        <hr class="offset-sm visible-sm">
                        <hr class="offset-xs visible-sm">

                        @if ($product->status == 1)


                            <p class="price">{{ number_format($product->sell_price - $discounted) }}đ</p>
                            @if ($discounted > 0)
                                <p class="price through">{{ number_format($product->sell_price) }}</p>
                            @endif

                            <hr class="offset-md">

                            <button class="btn btn-primary rounded add-to-cart"
                                data-url="{{ route('shop.product.addtocart', $product->id) }}"> <i
                                    class="ion-bag"></i>
                                Thêm vào giỏ hàng</button>
                            @if (Auth::check())
                                <a class="add-to-wishlist" data-url="http://localhost:8000/mua-sau/{{ $product->id }}">
                                    <button class="btn btn-link"> <i class="ion-ios-heart"></i> Mua sau </button></a>

                            @endif
                            
                        @else
                            @if ($product->status==0)
                                <span class="h2 label" style="background-color: red">Sắp về hàng</span>
                            @else
                                <span class="label h2" style="background-color: darkgray">Không kinh doanh</span>
                            @endif
                        @endif
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
                    @if ($discounts->count() > 0)
                        <div class="talk white">
                            <h2 class="h3">Khuyến mãi:</h2>


                            @foreach ($discounts as $discount)


                                <p class="text-danger"> &middot; {{ $discount->title }}</p>

                            @endforeach

                            <hr class="offset-md hidden-sm">
                            <hr class="offset-sm visible-sm">
                            <hr class="offset-xs visible-sm">

                        </div>
                    @endif
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
                        <h2 class="h3">Đánh giá: (#{{ $product->review()->count() }}) <span
                                class="pull-right star checked">{{ number_format($product->review()->avg('points')), 1, '.', ',' }}
                                <i class="fa fa-star"></i></span></h2>
                        <br>


                        <div class="wrapper">
                            <div class="content">


                                @foreach ($product->review as $review)
                                    <h3>{{ $review->name }} </h3>
                                    <label>{{ $review->created_at }}</label>
                                    <h4>{{ $review->title }} <span
                                            class="pull-right star checked small">{{ $review->points }} <i
                                                class="fa fa-star"></i></span></h4>
                                    <p>
                                        {{ $review->content }}
                                    </p>

                                @endforeach


                            </div>
                        </div>
                        <hr class="offset-lg">
                        <hr class="offset-md">

                        @if ($product->status == 1)


                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#Modal-Comment"> <i
                                    class="ion-chatbox-working"></i> Đánh giá </button>
                        @endif
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
                    <h1 class="h4 modal-title">Để lại đánh giá</h1>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form class="" action="{{ route('review.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="product" value="{{ $product->id }}">
                            <div class="row">
                                <div class="col-sm-12">
                                    <span class="star btn-star checked" data-point="1"><i
                                            class="fa fa-star"></i></span>
                                    <span class="star btn-star checked" data-point="2"><i
                                            class="fa fa-star"></i></span>
                                    <span class="star btn-star checked" data-point="3"><i
                                            class="fa fa-star"></i></span>
                                    <span class="star btn-star checked" data-point="4"><i
                                            class="fa fa-star"></i></span>
                                    <span class="star btn-star checked" data-point="5"><i
                                            class="fa fa-star"></i></span>
                                </div>

                            </div>
                            <br>
                            <input type="hidden" name="point" id="txtPoint" value="5">
                            <div class="row">
                                <div class="col-sm-12">
                                    <input required type="text" name="title" id="" placeholder="Đánh giá.."
                                        class="form-control">

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <textarea name="comment" placeholder="Thêm mô tả" class="form-control"
                                        rows="5"></textarea>
                                    <br>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" name="name" value="@if (Auth::check()) {{ Auth::user()->name }} @endif" placeholder="Họ tên"
                                        required="" class="form-control" />
                                </div>
                                <div class="col-sm-6">
                                    <input type="email" name="email" value="@if (Auth::check()) {{ Auth::user()->email }} @endif" placeholder="Email"
                                        required="" class="form-control" />
                                </div>
                                <div class="col-sm-12">
                                    <div class="align-center">
                                        <br>
                                        <button type="submit" class="btn btn-primary btn-sm"> <i
                                                class="ion-android-send"></i> Gửi</button>
                                        <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal"> <i
                                                class="ion-android-share"></i> Đóng </button>
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
@section('scripts')
    @parent
    <script src="{{ asset('shop/assets/js/carousel-product.js') }}"></script>
    <script>
        $(document).ready(() => {
            $('.btn-star').on('click', function(event) {

                $('.btn-star').removeClass('checked');
                let stars = $(this).prevAll().addClass('checked');
                $(this).addClass('checked');

                $('#txtPoint').val($(this).data('point'));

            })
        })
    </script>
@endsection
