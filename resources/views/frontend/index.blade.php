@extends('frontend')

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"></i> Chào mừng đến với thủ lĩnh campus, ấn bắt đầu để tham gia
                    
                </div>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
        	<a href="{{url('/tham-gia')}}" class="btn btn-primary">Bắt đầu</a>
        </div>
    </div>
@endsection