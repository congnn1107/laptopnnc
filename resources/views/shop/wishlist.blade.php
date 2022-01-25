@extends('shop.layout.master')
@section('title')
    Danh sách mua sau
@endsection
@section('content')
    <hr class="offset-top">
    <hr class="offset-md">
    <div class="container white">
        <hr class="offset-md">

        <h1 class="h3">Danh sách sản phẩm mua sau</h1>
        <hr>
        <hr class="offset-lg">

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Hình</th>
                    <th>Sản phẩm</th>
                    <th>Giá</th>
                    <th>Tùy chọn</th>
                </tr>

            </thead>
            <tbody>
                @php
                    $products = Auth::user()
                        ->wishlist;
                @endphp
                @foreach ($products as $key => $item)
                    <tr>
                        <td>
                            {{ $key + 1 }}
                        </td>
                        @php
                            $product = $item->getProduct;
                        @endphp
                        <td>
                            <img style="display: inline-block; width:100px"
                                src="{{ asset('storage/' . $product->card_image) }}" alt="">
                        </td>
                        <td>
                            <a href="{{ route('shop.product.show', $product->slug) }}">
                                {{ $product->name }}
                            </a>
                        </td>
                        <td>{{ number_format($product->sell_price) }}đ</td>
                        <td>
                            <form action="{{ route('mua-sau.destroy', $item->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button>
                            </form>
                            <br>
                            @if ($product->status == 1)
                                <button class="btn btn-xs btn-primary add-to-cart"
                                    data-url="{{ route('shop.product.addtocart', $product->id) }}">Thêm vào giỏ</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <hr class="offset-md">
    </div>
    <hr class="offset-lg">
@endsection
@section('scripts')
    @parent
    <script>

    </script>
@endsection
