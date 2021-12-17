@extends('shop.layout.master')
@section('title')
    Xác nhận đặt hàng
@endsection
@section('headdoc')
    @parent
    <link rel="stylesheet" href="{{ asset('/bower_components/select2/dist/css/select2.min.css') }}">
@endsection
@section('content')
    <hr class="offset-top">

    <div class="white">
        <div class="container checkout">
            <h1>Xác nhận đặt hàng</h1>
            <hr class="offset-sm">
        </div>
    </div>
    <hr class="offset-md">

    <div class="container checkout">
        <form action="{{ route('shop.order') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-7">
                    <div class="row group">
                        <div class="col-sm-4">
                            <h2 class="h4">Họ và tên:</h2>
                        </div>
                        <div class="col-sm-8"> <input type="text" class="form-control" name="name" required=""
                                placeholder="" /></div>
                    </div>

                    <div class="row group">
                        <div class="col-sm-4">
                            <h2 class="h4">Số điện thoại</h2>
                        </div>
                        <div class="col-sm-8"> <input type="text" class="form-control" name="phone" required=""
                                placeholder="" /></div>
                    </div>

                    <div class="row group">
                        <div class="col-sm-4">
                            <h2 class="h4">E-mail</h2>
                        </div>
                        <div class="col-sm-8"> <input type="email" class="form-control" name="email" required=""
                                placeholder="" /></div>
                    </div>

                    <br><br>
                    <div class="">
                        <div class="row">
                            <div class="col-sm-4">
                                <h2 class="h4">Tỉnh/Thành phố:</h2>

                                <select name="address[]" class="form-control" id="select1" required></select>
                                {{-- <input type="text" class="form-control" name="address[]" value="" required=""
                                    placeholder="" /> --}}
                            </div>
                            <div class="col-sm-4">
                                <h2 class="h4">Quận/Huyện:</h2>
                                <select name="address[]" class="form-control" id="select2" required></select>

                                {{-- <input type="text" class="form-control" name="address[]" value="" required=""
                                    placeholder="" /> --}}
                            </div>
                            <div class="col-sm-4">
                                <h2 class="h4">Phường/Xã:</h2>
                                <select name="address[]" class="form-control" id="select3" required></select>

                                {{-- <input type="text" class="form-control" name="address[]" value="" required=""
                                    placeholder="" /> --}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <h2 class="h4">Địa chỉ chi tiết</h2>
                                <input type="text" class="form-control" name="address[]" value="" required=""
                                    placeholder="" />
                            </div>
                        </div>
                    </div>
                    <br>


                    <div class="row group">
                        <div class="col-sm-4">
                            <h2 class="h4">Phương thức thanh toán:</h2>
                        </div>
                        <div class="col-sm-8">
                            <div class="group-select justify" tabindex='1'>
                                <input class="form-control select" id="payment" name="payment"
                                    value="Thanh toán tiền mặt khi nhận hàng" placeholder="" required="" />

                                <ul class="dropdown">
                                    <li data-value="Thanh toán tiền mặt khi nhận hàng">Thanh toán tiền mặt khi nhận hàng
                                    </li>
                                </ul>

                                <div class="arrow bold"><i class="ion-chevron-down"></i></div>
                            </div>
                        </div>
                    </div>

                    <div class="row group">
                        <div class="col-sm-4">
                            <h2 class="h4">Mã khuyến mại</h2>
                        </div>
                        <div class="col-sm-8"> <input type="text" class="form-control" name="promo" value=""
                                placeholder="" /></div>
                    </div>


                    <hr class="offset-lg visible-xs visible-sm">
                    <hr class="offset-lg visible-xs">
                </div>

                <div class="col-md-5 white">
                    <hr class="offset-md visible-xs visible-sm">
                    <div class="checkout-cart">
                        <div class="content">
                            @foreach (Cart::content() as $item)
                                <div class="media">
                                    <input type="hidden" name="product_id[]" value="{{ $item->id }}">
                                    <div class="media-left">
                                        <a href="{{ $item->options['product_url'] }}">
                                            <img class="media-object" src="{{ $item->options['image'] }}"
                                                alt="{{ $item->name }}" />
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <h2 class="h4 media-heading">{{ $item->name }}</h2>
                                        {{-- <label>Tablets</label> --}}
                                        <p class="price" data-price="{{ $item->price }}">
                                            {{ $item->options['display_price'] }} vnđ</p>
                                    </div>
                                    <div class="controls">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default btn-sm" type="button" data-action="minus"><i
                                                        class="ion-minus-round"></i></button>
                                            </span>
                                            <input type="text" name="qty[]" class="form-control input-sm" placeholder="Qty"
                                                value="{{ $item->qty }}" readonly="">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default btn-sm" type="button" data-action="plus"><i
                                                        class="ion-plus-round"></i></button>
                                            </span>
                                        </div><!-- /input-group -->

                                        <a href="#remove"> <i class="ion-trash-b"></i> Xóa </a>
                                    </div>
                                </div>
                            @endforeach


                        </div>
                    </div>
                    <hr class="offset-md visible-xs visible-sm">
                </div>

                <hr class="offset-lg hidden-xs">

                <div class="col-sm-12 white">
                    <hr class="offset-md">
                    <div class="row">
                        <div class="col-xs-6 col-md-4">
                            <h3 class="h5 no-margin">Tổng số số sản phẩm: <span id="count">{{ Cart::count() }}</span>
                            </h3>
                            <h3 class="h4 no-margin">Tổng tiền: <span id="total">{{ Cart::subtotal() }}</span> vnđ</h3>
                        </div>
                        <div class="col-md-4 hidden-xs">
                        </div>
                        <div class="col-xs-6 col-md-4">
                            <button class="btn btn-primary pull-right" type="submit">Đặt hàng</button>
                        </div>
                    </div>
                    <hr class="offset-md">
                </div>

            </div>
        </form>
    </div>
@endsection
@section('scripts')
    @parent
    <script src="{{ asset('shop/assets/js/checkout.js') }}"></script>
    <script src="{{ asset('bower_components/select2/dist/js/select2.min.js') }}"></script>
    <script>
        function updateCountAndTotal() {
            let media = $('.checkout-cart .media');
            let count = 0;
            let total = 0;
            media.each(function(index) {
                qty = parseInt($(this).find('input[name="qty[]"]').val());
                count += qty;
                price = $(this).find('p.price').data('price');
                total += price * qty;
            })
            //xóa hết sản phẩm thì chuyển hướng về trang chủ
            if(count<1) setTimeout(() => {
                location.href='{{route('shop.index')}}';
            }, 500);

            $('#count').text(count);
            $('#total').text(total.toLocaleString('en-US', {
                minimumFractionDigits: 2
            }));

        }

        async function setAddressData(selectID = 'select1', level = "province", parentID = 1) {
            let host = '{{ url("/") }}/local/';
            let url;
            let first_option;
            if (level == "province") {
                url = host + level;
            }
            else{
                url = `${host}${level}/parent=${parentID}`;
            }
            await $.ajax({
                url: url,
                method: 'get',
                success: function(result) {
                    // console.log(result)
                    // console.log(selectID)
                    $('#'+selectID).empty();
                    $('#'+selectID).select2({
                        data: result
                    });
                    first_option=result[0];
                    
                }
            });
            // console.log(first_option);
            return first_option;
        }
        $(document).ready(() => {

            $('.checkout-cart').on('click', 'a[href="#remove"]', function() {


                $(this).parents('.media').remove();
                updateCountAndTotal();
                //update quantity and total
            });
            $('.checkout-cart').on('click', '.input-group button[data-action="minus"]', function(e) {
                // alert('minus');
                //update quantity and total
                updateCountAndTotal();
            })
            $('.checkout-cart').on('click', '.input-group button[data-action="plus"]', function() {
                // alert('plus');
                //update quantity and total
                updateCountAndTotal();
            })

            setAddressData();
            setAddressData('select2','district');
            setAddressData('select3','ward');
            
            $('#select1').on('change', async function(event) {
                let province = $(this).val();
                first_option = await setAddressData('select2','district',province);
                console.log(first_option)
                setAddressData('select3','ward',first_option.id);

            })
            $('#select2').on('change', function(event) {
                let district = $(this).val();
                setAddressData('select3','ward',district);
            })
           

        })
    </script>
@endsection
