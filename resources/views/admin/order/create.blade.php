@extends('admin.layout.master')
@section('content')
    @include('admin.layout.message')
    <div class="box box-primary">
        <div class="box-header with-border">
            <span class="h4 text-red">
                Tạo hóa đơn
            </span>
        </div>
        <div class="box-body">
            <a href="{{ route('order.index') }}" class="btn"><i class="fa fa-caret-left"></i> Trở về</a>

            <form action="{{ route('order.store') }}" method="post" class="form">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <h2 class="text-info">Thông tin khách hàng</h2>
                        <div class="form-group">
                            <label for="">Họ và Tên: </label>
                            <input type="text" name="name" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">SDT: </label>
                            <input type="text" class="form-control" name="phone">
                        </div>
                        <div class="form-group">
                            <label for="">Email: </label>
                            <input type="mail" class="form-control" name="email">
                        </div>
                        <div class="form-group">
                            <label for="">Địa chỉ: </label>
                            <input type="text" class="form-control" name="address">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h2 class="text-success">Danh sách sản phẩm <span style="float: right;" class="btn btn-success"
                                onclick="createInput()">Thêm SP</span></h2>

                        <div id="productList">
                            <div class="input">
                                <div class="form-group">
                                    <label for="">Tìm sản phẩm:</label><br>
                                    <select class="form-control" name="products[id][]" style="width:80%"  id="select1">

                                    </select>
                                    <input type="number" name="products[quantity][]" min="1" max="10" value="1" step="1" style="width: 10%;display:inline" class="form-control">
                                    <span class="btn"><i class="fa fa-times"
                                            onclick="selfRemove(this)"></i></span>
                                </div>
                                {{-- Khi validate xảy ra, lấy lại các sản phẩm cũ bằng cách tìm trong giá trị trả về kiểu mảng của hàm old --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <input type="submit" class="btn btn-primary pull-left" value="Tạo hóa đơn">
                    <a href="{{ route('order.create') }}" class="pull-right btn">Refresh</a>
                </div>
            </form>
        </div>
    </div>
    <script>
        function select2Setup() {
            $('select').select2({
                ajax: {
                    url: '{{ route('order.search_product') }}',
                    type: 'post',
                    data: function(params) {

                        return {
                            search: params.term,
                            _token: '{{ csrf_token() }}'
                        };
                    },
                    processResults: function(response) {
                        console.log({
                            results: response
                        });
                        return {
                            results: response
                        }
                    }
                }
            })
        }
        $(document).ready(() => {
            select2Setup();
        })

        function createInput() {

            var html = ` <div class="input">
                                <div class="form-group">
                                    <label for="">Tìm sản phẩm:</label><br>
                                    <select name="products[id][]" style="width: 80%">
                                    </select>
                                    <input type="number" name="products[quantity][]" min="1" max="10" step="1" value="1" style="width: 10%;display:inline" class="form-control">

                                    <span class="btn" onclick="selfRemove(this)"><i class="fa fa-times"></i></span>
                                </div>
                            </div>`;
            $('#productList').append(html);
            select2Setup();
        }

        function selfRemove(target) {
            var div = $(target).parentsUntil('#productList');
            div.remove();
        }
    </script>
@endsection
