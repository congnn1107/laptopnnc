@extends('admin.layout.master')
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">

        </div>
        <div class="box-body">
            <div class="box">
                <div style="width: 500px; max-height: 250px " id="carousel-example-generic" class="carousel slide"
                    data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        @php
                            $count = count($slider);
                        @endphp
                        @for ($i = 0; $i < $count; $i++)
                            <li data-target="#carousel-example-generic" data-slide-to="{{ $i }}" {{ $i==0?'class="active"':'' }}></li>
                        @endfor
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        
                        @foreach ($slider as $key => $slide)
                            
                                <div class="item {{ $key == 0 ? 'active' : '' }}">
                                    <a href="{{$slide->url}}"><img style="display:block;width: 500px; max-height: 250px"
                                        src="{{ asset('storage/' . $slide->image) }}" alt="..."></a>
                                </div>
                            
                        @endforeach
                    </div>

                    <!-- Controls -->
                    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection
