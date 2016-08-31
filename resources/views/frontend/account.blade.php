@extends('frontend')

@section('content')
    <div class="content v-1">
        <div class="container">
            <div class="row">
                    @if (Auth::guard('frontend')->check())
                        <h2>Nhập thông tin cá nhân để tham gia vòng Kiến Thức &nbsp;  </h2>
                        <div class="col-md-9 col-md-offset-2">
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
                        {!! Form::open(['method' => 'POST','url' => 'tai-khoan','class' => 'form-horizontal frm-userinfo']) !!}
                            <div class="form-group">
                                <label for="" class="col-md-2 control-label">Họ tên:</label>
                                <div class="col-md-7">
                                    {!! Form::text('full_name',null,['placeholder'=>'Họ tên','class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-md-2 control-label">CMND:</label>
                                <div class="col-md-7">
                                    {!! Form::text('identity_card',null,['placeholder'=>'Chứng minh thư','class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-md-2 control-label">Trường:</label>
                                <div class="col-md-7">
                                    {!! Form::select('university_id', array('' => 'Danh sách các trường đại học') + \App\University::lists('name','id')->all(), null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-md-2 control-label">SĐT:</label>
                                <div class="col-md-7">
                                    {!! Form::text('phone_number',null,['placeholder'=>'Số điện thoại','class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-md-2 control-label">Email:</label>
                                <div class="col-sm-7">
                                    {!! Form::text('email',null,['placeholder'=>'email','class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-offset-2 col-md-7">
                                    {!! app('captcha')->display(); !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-7">
                                    {!! Form::submit('Bắt đầu tham gia vòng kiến thức', ['class' => 'btn btn-default btn-large']) !!}
                                </div>
                            </div>
                        {!! Form::close() !!}
                        </div>
                    @else
                        <h2>Đăng nhập để tham gia vòng Kiến Thức &nbsp;  </h2>
                        <div class="col-md-9 col-md-offset-2">
                         <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-7">
                                   <a href="{{url('dang-nhap')}}" class="btn btn-default btn-large">ĐĂNG NHẬP</a>
                                </div>
                            </div>
                        </div>
                    @endif
            </div>
        </div>
    </div>
    <div class="content v1-top">
        <div class="container">
            <div class="row">
                    <h2>Top 20 trường dẫn đầu cuộc thi </h2>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table >
                            <tr>
                                <th>STT</th>
                                <th></th>
                                <th>Trường</th>
                                <th>Số lượng người tham gia</th>
                                <th>Số điểm người tham gia</th>
                                <th>Tổng điểm</th>
                            </tr>
                            <tr>
                                <td>
                                    01

                                </td>
                                <td>
                                    <img src="images/logo-ftu.png" alt="">
                                </td>
                                <td>
                                    FTU
                                    <span>
                                        ĐH Ngoại Thương
                                    </span>
                                </td>
                                <td>
                                    1000
                                </td>
                                <td>
                                    2000
                                </td>
                                <td>
                                    1700
                                </td>
                            </tr>
                            
                            <tr>
                                <td>
                                    02

                                </td>
                                <td>
                                    <img src="images/iu.png" alt="">
                                </td>
                                <td>
                                    IU
                                    <span>
                                        ĐH Quốc tế
                                    </span>
                                </td>
                                <td>
                                    1000
                                </td>
                                <td>
                                    2000
                                </td>
                                <td>
                                    1700
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    03

                                </td>
                                <td>
                                    <img src="images/logo-ftu.png" alt="">
                                </td>
                                <td>
                                    FTU
                                    <span>
                                        ĐH Ngoại Thương
                                    </span>
                                </td>
                                <td>
                                    1000
                                </td>
                                <td>
                                    2000
                                </td>
                                <td>
                                    1700
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    04

                                </td>
                                <td>
                                    <img src="images/logo-ftu.png" alt="">
                                </td>
                                <td>
                                    FTU
                                    <span>
                                        ĐH Ngoại Thương
                                    </span>
                                </td>
                                <td>
                                    1000
                                </td>
                                <td>
                                    2000
                                </td>
                                <td>
                                    1700
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    05

                                </td>
                                <td>
                                    <img src="images/logo-ftu.png" alt="">
                                </td>
                                <td>
                                    FTU
                                    <span>
                                        ĐH Ngoại Thương
                                    </span>
                                </td>
                                <td>
                                    1000
                                </td>
                                <td>
                                    2000
                                </td>
                                <td>
                                    1700
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    06

                                </td>
                                <td>
                                    <img src="images/logo-ftu.png" alt="">
                                </td>
                                <td>
                                    FTU
                                    <span>
                                        ĐH Ngoại Thương
                                    </span>
                                </td>
                                <td>
                                    1000
                                </td>
                                <td>
                                    2000
                                </td>
                                <td>
                                    1700
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    07

                                </td>
                                <td>
                                    <img src="images/logo-ftu.png" alt="">
                                </td>
                                <td>
                                    FTU
                                    <span>
                                        ĐH Ngoại Thương
                                    </span>
                                </td>
                                <td>
                                    1000
                                </td>
                                <td>
                                    2000
                                </td>
                                <td>
                                    1700
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    08

                                </td>
                                <td>
                                    <img src="images/logo-ftu.png" alt="">
                                </td>
                                <td>
                                    FTU
                                    <span>
                                        ĐH Ngoại Thương
                                    </span>
                                </td>
                                <td>
                                    1000
                                </td>
                                <td>
                                    2000
                                </td>
                                <td>
                                    1700
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    09

                                </td>
                                <td>
                                    <img src="images/logo-ftu.png" alt="">
                                </td>
                                <td>
                                    FTU
                                    <span>
                                        ĐH Ngoại Thương
                                    </span>
                                </td>
                                <td>
                                    1000
                                </td>
                                <td>
                                    2000
                                </td>
                                <td>
                                    1700
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    10

                                </td>
                                <td>
                                    <img src="images/logo-ueh.png" alt="">
                                </td>
                                <td>
                                    ueh
                                    <span>
                                        ĐH Kinh tế Tp.HCM
                                    </span>
                                </td>
                                <td>
                                    1000
                                </td>
                                <td>
                                    2000
                                </td>
                                <td>
                                    1700
                                </td>
                            </tr>
                        </table>
                    </div>
                    <a class="btn btn-default">
                        Trở về đầu trang
                    </a>
                </div>
            </div>
        </div>
    </div>

        
@endsection