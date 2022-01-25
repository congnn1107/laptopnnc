<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{ asset('shop/assets/js/jquery-latest.min.js') }}"></script>

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script type="text/javascript" src="{{ asset('shop/assets/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('shop/assets/js/core.js') }}"></script>
<script type="text/javascript" src="{{ asset('shop/assets/js/store.js') }}"></script>
<script type="text/javascript" src="{{ asset('shop/assets/js/jquery.touchSwipe.min.js') }}"></script>

<script type="text/javascript"
src="{{ asset('shop/assets/js/custom-scroll/jquery.mCustomScrollbar.concat.min.js') }}">
</script>


<script type="text/javascript" src="{{ asset('shop/assets/js/jquery-ui-1.11.4.js') }}"></script>
<script type="text/javascript" src="{{ asset('shop/assets/js/jquery.ui.touch-punch.js') }}"></script>

<script>
    function addToCart() {
        var url = $(this).data('url');
        // alert(url);
        $.ajax({
            url: url,
            method: "get",
            success: function(result) {
                if(result.error){
                    alert(result.error);
                    return;
                }
                if (result.type == 'create') {
                    //if
                    let box = $('#mCSB_1_container');
                    empty = box.find('h4');
                    console.log(empty.length)
                    if (empty.length > 0) {
                        empty.remove();
                        $('.checkout-box').append(
                            '<a class="btn btn-primary" href="{{route('shop.checkout')}}"> Mua hàng </a>')

                    }

                    //hiển thị item trong giỏ hàng
                    let template = ` <div class="media">
                        <div class="media-left">
                            <a href="${result.item.options.product_url}">
                                <img class="media-object" src="${result.item.options.image}"
                                    alt="${result.item.name}" />
                            </a>
                        </div>
                        <div class="media-body">
                            <h6 class="media-heading">${result.item.name}</h6>
                            <p class="price">${result.item.options.display_price}vnđ</p>
                            <label></label>
                        </div>
                        <div class="controls">
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn btn-default btn-sm" type="button" data-action="minus"><i
                                            class="ion-minus-round"></i></button>
                                </span>
                                <input type="text" class="form-control input-sm" id="qty-${result.item.id}" data-id="${result.item.rowId}" placeholder="Qty" value="${result.item.qty}"
                                    readonly="">
                                <span class="input-group-btn">
                                    <button class="btn btn-default btn-sm" type="button" data-action="plus"><i
                                            class="ion-plus-round"></i></button>
                                </span>
                            </div><!-- /input-group -->

                            <a href="#remove" class="remove-item" data-url="${result.remove_link}"> <i class="ion-trash-b"></i> Xóa </a>
                        </div>
                    </div>`;
                    box.append(template);

                } else {
                    //todo: change quantity trong giao diện giỏ hàng
                    let qty = $('#qty-' + result.item.id);
                    qty.val(parseInt(qty.val()) + 1);
                }
                let items_quantity = $('.items-quantity');
                items_quantity.text(result.total_items);

            },
            error: function(response) {

            }
        });
    }

    function removeCartItem() {
        let url = $(this).data('url');
        $.ajax({
            method: 'get',
            url: url,
            success: function(result) {
                //
                console.log(result);
                if (result.total_items == 0) {
                    $('#mCSB_1_container').append(
                        '<h4 class="text-center">Bạn chưa có sản phẩm nào trong giỏ hàng!</h4>');
                    $('.checkout-box').empty();
                }
                $('.items-quantity').text(result.total_items);
            },
            error: function(response) {
                //
                console.log(response);
            }
        });
    }

    function updateQuantityCartItem(id, quantity, target) {
        $.ajax({
            url: '{{ route('shop.product.update_qty_cart') }}',
            method: 'post',
            data: {
                rowId: id,
                qty: quantity,
                _token: '{{ csrf_token() }}'
            },
            success: function(result) {
                if(result.error){
                    alert(result.error);
                    $(target).parents('.input-group').find('input').val( parseInt($(target).parents('.input-group').find('input').val()) - 1 );
                    return;
                }
                console.log(result);
                $('#items-quantity').text(result.total_items);

            },
            error: function(response) {
                console.log(response);
            }
        })
    }
</script>

<script>
    $(document).ready(() => {
        $('.add-to-cart').on('click', addToCart);
        $('.cart').on('click', 'a[href="#remove"]', removeCartItem);
        $('.cart').on('click', '.input-group button[data-action="plus"]', function() {
            let quantity = $(this).parents('.input-group').find('input').val();
            let id = $(this).parents('.input-group').find('input').data('id');
            updateQuantityCartItem(id, quantity,this);

        });
        $('.cart').on('click', '.input-group button[data-action="minus"]', function() {
                let quantity = $(this).parents('.input-group').find('input').val();
                let id = $(this).parents('.input-group').find('input').data('id');
                updateQuantityCartItem(id, quantity);
        });
    })
</script>

<script>
    //xử lí tìm kiếm sản phẩm
    $(document).ready(()=>{
        $('#txtSearch').keypress(function(event){
            
            let searchKey = this.value;
            if(searchKey.trim() != ''){

                searchUrl = `{{route('shop.livesearch')}}?q=${searchKey}`;
                if(event.key=='Enter'){
                    console.log(searchKey);
                    location.href=`{{route('shop.product.index')}}?q=${searchKey}`;
                }
                
               
               //xử lí live search
                    $.ajax({
                    url: searchUrl,
                    method: 'get',
                    success: function(result){
                        console.log(result)
                    },
                    error: function(response){
                        console.log('error!',response)
                        // hiển thị tên và link sản phẩm chỗ khung tìm kiếm
                    }
                })
               
                

            }
            
        })
    })
</script>
{{-- Xử lí form đăng nhập đăng ký khi lỗi --}}
@if ($errors->register->any())
<script>
    $(document).ready(()=>{
        $('#btnRegister').click();
    })
</script>
@endif
@if ($errors->login->any())
<script>
    $(document).ready(()=>{
        $('#btnLogin').click();
    })
</script>
@endif
@if ($errors->forget->any() || Session::has('email-sent'))
<script>
    $(document).ready(()=>{
        $('#btnForget').click();
    })
</script>
@endif
{{-- Thêm sản phẩm vào giỏ hàng --}}
<script>
    function addToWishlist(){
        console.log(this);
        let url = $(this).data('url');
        $.ajax({
            url: url,
            method: 'get',
            success: function(result){
                console.log(result);
            },
            error: function(response){
                console.log(response);
            }
        })
    }
    $(document).ready(()=>{
        $('.products .product').on('click', 'a.favorites',addToWishlist);
        $('a.add-to-wishlist').on('click',addToWishlist);
    })
</script>

