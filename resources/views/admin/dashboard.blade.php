@extends('admin.layout.master')
@section('content')
    <!-- Info boxes -->
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-laptop"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Tổng số sản phẩm</span>
                    <span class="info-box-number">{{ $totalProduct }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-file-text"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Tổng số đơn hàng</span>
                    <span class="info-box-number">{{ $totalOrder }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Số sản phẩm đã bán</span>
                    <span class="info-box-number">{{ $totalSoldProduct }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Số người dùng đăng ký tk</span>
                    <span class="info-box-number">{{ $totalUser }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Báo cáo doanh số</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <div class="btn-group">
                            <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-wrench"></i></button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{route('admin.dashboard')}}">Tất cả</a></li>
                                <li><a href="{{route('admin.dashboard')}}?reportBy=week">Theo tuần</a></li>
                                <li><a href="{{route('admin.dashboard')}}?reportBy=month">Theo tháng</a></li>
                                <li class="divider"></li>
                                {{-- <li><a href="#">Separated link</a></li> --}}
                            </ul>
                        </div>
                        {{-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                class="fa fa-times"></i></button> --}}
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-8">
                            <p class="text-center">
                                @php
                                    
                                    $now = Carbon\Carbon::now();
                                    
                                @endphp
                                @if (request()->query('reportBy'))
                                    @if (request()->query('reportBy') == 'month')
                                        <strong>Doanh số bán hàng tháng {{ $now->month }}/{{ $now->year }}</strong>

                                    @else
                                        <strong>Doanh số bán hàng tuần {{ $now->weekOfMonth }} tháng
                                            {{ $now->month }}/{{ $now->year }}</strong>
                                    @endif
                                @else
                                    <strong>Tổng doanh số bán hàng</strong>
                                @endif

                            </p>

                            <div class="chart">
                                <!-- Sales Chart Canvas -->
                                <canvas id="salesChart" style="height: 180px;"></canvas>
                            </div>
                            <!-- /.chart-responsive -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-4">
                            <p class="text-center">
                                <strong>Thông tin đơn hàng</strong>
                            </p>

                            <p class="text-left row">
                                <span class="col-md-6">Đơn hàng chờ xác nhận: </span> <span
                                    class="label bg-yellow  col-md-6">{{ $report['waiting'] }}</span>

                            </p>
                            <p class="text-left row">
                                <span class="col-md-6">Đơn hàng đã xác nhận: </span> <span
                                    class="label bg-orange  col-md-6">{{ $report['accepted'] }}</span>
                            </p>
                            <p class="text-left row">
                                <span class="col-md-6">Đơn hàng đang giao: </span> <span
                                    class="label bg-blue  col-md-6">{{ $report['shipping'] }}</span>
                            </p>
                            <p class="text-left row">
                                <span class="col-md-6">Đơn hàng đã giao: </span> <span
                                    class="label bg-green  col-md-6">{{ $report['received'] }}</span>
                            </p>
                            <p class="text-left row">
                                <span class="col-md-6">Đơn hàng đã hủy: </span> <span
                                    class="label bg-red col-md-6">{{ $report['canceled'] }}</span>
                            </p>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- ./box-body -->
                <div class="box-footer">
                    <div class="row">
                        <div class="col-sm-4 col-xs-6">
                            <div class="description-block border-right">
                                <span class="description-percentage text-info"><i class="fa fa-caret-up"></i>
                                    <!--20%-->
                                </span>
                                <h5 class="description-header">{{ number_format($report['turnOver']) }} đ</h5>
                                <span class="description-text">Tổng doanh thu</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 col-xs-6">
                            <div class="description-block border-right">
                                <span class="description-percentage text-yellow"><i class="fa fa-caret-up"></i>
                                    <!--20%-->
                                </span>
                                <h5 class="description-header">{{ number_format($report['raw']) }} đ</h5>
                                <span class="description-text">Tổng vốn thu lại</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 col-xs-6">
                            <div class="description-block border-right">
                                <span class="description-percentage text-green"><i class="fa fa-caret-up"></i>
                                    <!--20%-->
                                </span>
                                <h5 class="description-header">{{ number_format($report['turnOver'] - $report['raw']) }} đ
                                </h5>
                                <span class="description-text">Tổng lợi nhuận</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        {{-- <div class="col-sm-3 col-xs-6">
                            <div class="description-block">
                                <span class="description-percentage text-red"><i class="fa fa-caret-down"></i> 18%</span>
                                <h5 class="description-header">1200</h5>
                                <span class="description-text">GOAL COMPLETIONS</span>
                            </div>
                            <!-- /.description-block -->
                        </div> --}}
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.box-footer -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <div class="col-md-8">



            <!-- TABLE: LATEST ORDERS -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Đơn hàng mới nhất</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        {{-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                class="fa fa-times"></i></button> --}}
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                                <tr>
                                    <th>Mã đơn hàng</th>
                                    <th>Khách hàng</th>
                                    <th>Trạng thái</th>
                                    <th>Giá trị</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($newOrders as $item)


                                    <tr>
                                        <td><a href="{{ route('order.show', $item->id) }}">{{ $item->order_code }}</a>
                                        </td>
                                        <td>{{ $item->customer()->first()->name }}</td>
                                        <td><span
                                                class="label bg-{{ $orderStatusColor[$item->status] }}">{{ $orderStatus[$item->status] }}</span>
                                        </td>
                                        <td>
                                            <div class="sparkbar" data-color="#00a65a" data-height="20">
                                                {{ number_format($item->detail()->sum('final_price')) }}đ</div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <a href="{{ route('order.create') }}" class="btn btn-sm btn-info btn-flat pull-left">Tạo đơn hàng
                        mới</a>
                    <a href="{{ route('order.index') }}" class="btn btn-sm btn-default btn-flat pull-right">Xem tất cả
                        đơn
                        hàng</a>
                </div>
                <!-- /.box-footer -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->

        <div class="col-md-4">

            <!-- PRODUCT LIST -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Sản phẩm mới thêm</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                class="fa fa-minus"></i>
                        </button>
                        {{-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                class="fa fa-times"></i></button> --}}
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <ul class="products-list product-list-in-box">
                        @foreach ($products as $item)


                            <!--.item-->
                            <li class="item">
                                <div class="product-img">
                                    <img src="{{ asset('storage/' . $item->card_image) }}" alt="Product Image">
                                </div>
                                <div class="product-info">
                                    <a href="{{ route('shop.product.show', $item->slug) }}" target="_blank"
                                        class="product-title">{{ $item->name }}
                                        <span
                                            class="label label-warning pull-right">{{ number_format($item->sell_price) }}đ</span></a>
                                    <span class="product-description">
                                        {{--  --}}
                                    </span>
                                </div>
                            </li>
                            <!-- /.item -->
                        @endforeach

                    </ul>
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                    <a href="{{ route('product.index') }}" class="uppercase">Xem tất cả sản phẩm</a>
                </div>
                <!-- /.box-footer -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <span class="h4">Sản phẩm bán chạy</span>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <table class="table" id="best-seller">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên SP</th>
                                <th>Số lượng đã bán</th>
                                <th>Trạng thái</th>
                                <th>Đã xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $statusArray = ['Sắp về','Đang kinh doanh','Không kinh doanh'];
                                $colors = ['orange','green','gray']
                            @endphp
                            @foreach ($bestSeller as $key => $item)
                                <tr>
                                    <td>
                                        {{$key+1}}
                                    </td>
                                    <td>
                                        {{$item->name}}
                                    </td>
                                    <td>{{$item->sold_qty}}</td>
                                    <td><span class="label bg-{{$colors[$item->status]}}">{{$statusArray[$item->status]}}</span></td>
                                    <td><span class="label bg-red">{{$item->deleted_at?'Đã xóa':''}}</span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('bower_components/chart.js/Chart.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    {{-- <script src="{{ asset('dist/js/pages/dashboard2.js') }}"></script> --}}

    {{-- Xử lí dữ liệu vẽ biểu đồ --}}
    @php
    $dayOfWeekName = ['Monday'=>'Thứ 2','Tuesday'=> 'Thứ 3','Wednesday' => 'Thứ 4', 'Thusday'=> 'Thứ 5','Friday' => 'Thứ 6','Saturday'=> 'Thứ 7','Sunday' =>'Chủ Nhật'];
    $label = '';
    $daysInMonth = Carbon\Carbon::now()->daysInMonth;
    $receivedData='';
    $data = '';
    if (request()->query('reportBy')) {
        if (request()->query('reportBy') == 'month') {
            for ($i = 1; $i <= $daysInMonth; $i++) {
                $label .= $i.',';
                
                
                if ($day = $countOrderDataResult->where('day',$i)->first()) {
                    $data.=$day->orders.',';
                }
                
                else{
                    $data.=0;
                    $data.=',';
                }

                if($day= $countReceivedOrderData->where('day',$i)->first()){
                     $receivedData.=$day->orders.',';
                }  else{
                    $receivedData.=0;
                    $receivedData.=',';
                }
                
            }
        }
        if (request()->query('reportBy') == 'week') {
            foreach ($dayOfWeekName as $key => $value) {
                $label .= "'$value',";
                
                
                if ($day = $countOrderDataResult->where('day',$key)->first()) {
                    $data.=$day->orders.',';
                }
                
                else{
                    $data.=0;
                    $data.=',';
                }

                if($day= $countReceivedOrderData->where('day',$key)->first()){
                     $receivedData.=$day->orders.',';
                }  else{
                    $receivedData.=0;
                    $receivedData.=',';
                }
                
            }
        }
    }
    else{
        
        for($i = 0; $i< $countOrderDataResult->count();$i++){
            $label.= "'".$countOrderDataResult->get($i)->day."',";
            $data.=$countOrderDataResult->get($i)->orders;
            $data.=',';
            if($day = $countReceivedOrderData->where('day',$countOrderDataResult->get($i)->day)->first()){
                $receivedData.=$day->orders.',';
               
            }
            else{
                $receivedData.=0;
                $receivedData.=',';
            }
        }
    }
    

    // dd(Carbon\Carbon::now()->dayOfWeek)

    @endphp
    <script>
        //xử lý data table bảng sản phẩm bán chạy
        $(document).ready(()=>{
            $('#best-seller').DataTable();
        })
    </script>
    <script>
        $(document).ready(() => {
            var salesChartCanvas = $('#salesChart').get(0).getContext('2d');
            // This will get the first returned node in the jQuery collection.
            var salesChart = new Chart(salesChartCanvas);

            var salesChartData = {
                labels: [0,{!! $label !!}],
                datasets: [{
                        label: 'Đặt hàng',
                        fillColor: 'rgb(210, 214, 222)',
                        strokeColor: 'rgb(210, 214, 222)',
                        pointColor: 'rgb(210, 214, 222)',
                        pointStrokeColor: '#c1c7d1',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgb(220,220,220)',
                        data: [0,{{$data}}]
                    },
                    {
                        label: 'Đã giao',
                        fillColor: 'rgba(60,141,188,0.9)',
                        strokeColor: 'rgba(60,141,188,0.8)',
                        pointColor: '#3b8bba',
                        pointStrokeColor: 'rgba(60,141,188,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data: [0,{{$receivedData}}]
                    }
                ]
            };

            var salesChartOptions = {
                // Boolean - If we should show the scale at all
                showScale: true,
                // Boolean - Whether grid lines are shown across the chart
                scaleShowGridLines: false,
                // String - Colour of the grid lines
                scaleGridLineColor: 'rgba(0,0,0,.05)',
                // Number - Width of the grid lines
                scaleGridLineWidth: 1,
                // Boolean - Whether to show horizontal lines (except X axis)
                scaleShowHorizontalLines: true,
                // Boolean - Whether to show vertical lines (except Y axis)
                scaleShowVerticalLines: true,
                // Boolean - Whether the line is curved between points
                bezierCurve: true,
                // Number - Tension of the bezier curve between points
                bezierCurveTension: 0.3,
                // Boolean - Whether to show a dot for each point
                pointDot: false,
                // Number - Radius of each point dot in pixels
                pointDotRadius: 4,
                // Number - Pixel width of point dot stroke
                pointDotStrokeWidth: 1,
                // Number - amount extra to add to the radius to cater for hit detection outside the drawn point
                pointHitDetectionRadius: 20,
                // Boolean - Whether to show a stroke for datasets
                datasetStroke: true,
                // Number - Pixel width of dataset stroke
                datasetStrokeWidth: 2,
                // Boolean - Whether to fill the dataset with a color
                datasetFill: true,
                // String - A legend template
                legendTemplate: '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<datasets.length; i++){%><li><span style=\'background-color:<%=datasets[i].lineColor%>\'></span><%=datasets[i].label%></li><%}%></ul>',
                // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
                maintainAspectRatio: true,
                // Boolean - whether to make the chart responsive to window resizing
                responsive: true
            };

            // Create the line chart
            salesChart.Line(salesChartData, salesChartOptions);
        })
    </script>
@endsection
