@extends('admin.layout.master')
@section('content')

    <div class="box box-primary">
        <div class="box-header with-border">
            <span class="h4 text-muted">
                Danh sách các sản phẩm bảo hành
            </span>
        </div>
        <div class="box-body">
            <table class="table" id="warrantyTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên khách</th>
                        <th>SDT</th>
                        <th>Sản phẩm</th>
                        <th>EMEI</th>
                        <th>Ngày kích hoạt BH</th>
                        <th>Tùy Chọn</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list as $record)
                        <tr>
                            <td>{{ $record->id }}</td>
                            <td>{{ $record->customer->name }}</td>
                            <td>{{ $record->customer_phone }}</td>
                            <td>{{ $record->products->name }}</td>
                            <td>{{ $record->emei }}</td>
                            <td>{{ $record->actived_at }}</td>
                            <td></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(()=>{
            $('#warrantyTable').DataTable();
        })
    </script>
@endsection

