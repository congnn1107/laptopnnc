<div class="cart" data-toggle="inactive">
    <div class="label">
        <i class="ion-bag"></i> <span id="items-quantity"> {{ Cart::count() }}</span>
    </div>

    <div class="overlay"></div>

    <div class="window">
        <div class="title">
            <button type="button" class="close"><i class="ion-android-close"></i></button>
            <h4>Giỏ Hàng</h4>
        </div>

        <div class="content" id="cart-body">
            @if (Cart::count() > 0)
                @foreach (Cart::content() as $item)
                    <div class="media">
                        <div class="media-left">
                            <a href="{{$item->options['product_url']}}">
                                <img class="media-object" src="{{$item->options['image']}}"
                                    alt="{{$item->name}}" />
                            </a>
                        </div>
                        <div class="media-body">
                            <h6 class="media-heading">{{ $item->name }}</h6>
                            <p class="price">{{$item->options['display_price']}}vnđ</p>
                            <label></label>
                        </div>
                        <div class="controls">
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn btn-default btn-sm" type="button" data-action="minus"><i
                                            class="ion-minus-round"></i></button>
                                </span>
                                <input type="text" class="form-control input-sm" id="qty-{{$item->id}}" data-id="{{$item->rowId}}" placeholder="Qty" value="{{$item->qty}}"
                                    readonly="">
                                <span class="input-group-btn">
                                    <button class="btn btn-default btn-sm" type="button" data-action="plus"><i
                                            class="ion-plus-round"></i></button>
                                </span>
                            </div><!-- /input-group -->

                            <a href="#remove" class="remove-item" data-url="{{route('shop.product.removecart',$item->rowId)}}"> <i class="ion-trash-b"></i> Xóa </a>
                        </div>
                    </div>
                @endforeach
            @else
                <h4 class="text-center">Bạn chưa có sản phẩm nào trong giỏ hàng!</h4>
            @endif





        </div>

        <div class="checkout container-fluid">
            <div class="row">
                <div class="col-xs-12 col-sm-12 align-right checkout-box">
                    @if (Cart::count()>0)
                    <a class="btn btn-primary" href="checkout/"> Mua hàng </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
