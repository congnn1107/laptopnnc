@extends('admin.layout.master')
@section('content')
    @include('admin.layout.message')
    
    <div class="box box-primary">
        <div class="box-header with-border">
            <span class="h4 text-muted">
                 Danh sách Hóa đơn
            </span>
        </div>
        <div class="box-body">
            <a href="{{ route('order.create') }}" class="btn btn-primary">Tạo hóa đơn mới</a>
            <div class="table">
                <table class="table" id="orderTable">

                    
                </table>
            </div>
        </div>
    </div>
@endsection