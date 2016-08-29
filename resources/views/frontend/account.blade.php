@extends('frontend')

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"></i> Chào mừng đến với thủ lĩnh campus, vui lòng cập nhật thông tin
                </div>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">

        {!! Form::open(['method' => 'POST','url' => 'tai-khoan','class' => 'formInfo']) !!}

            <div class="form-group">
                {!! Form::label('full_name', 'Họ và tên') !!}
                {!! Form::text('full_name',null,['placeholder'=>'Họ và tên','class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('identity_card', 'CMND') !!}
                {!! Form::text('identity_card',null,['placeholder'=>'Chứng minh thư','class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('university_id', 'Chọn Bảng đấu') !!} :
                {!! Form::select('university_id', array('' => 'Danh sách các trường đại học') + \App\University::lists('name','id')->all(), null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('phone_number', 'Số điện thoại') !!}
                {!! Form::text('phone_number',null,['placeholder'=>'Số điện thoại','class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('email', 'Email') !!}
                {!! Form::text('email',null,['placeholder'=>'email','class' => 'form-control']) !!}
            </div>

            {!! app('captcha')->display(); !!}

            <div class="form-group">
                {!! Form::submit('Cập nhật', ['class' => 'btn btn-primary form-control']) !!}
            </div>

        {!! Form::close() !!}
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong> Có lỗi trong quá trình cập nhật thông tin</strong><br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        </div>
    </div>
@endsection