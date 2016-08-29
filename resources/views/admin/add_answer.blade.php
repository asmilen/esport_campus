@extends('admin')
@section('content')

    @if (Session::has('success'))
        <div class="alert alert-success }}">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ Session::get('success') }}
        </div>
    @elseif (Session::has('danger'))
        <div class="alert alert-danger }}">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ Session::get('danger') }}
        </div>
    @endif
    <div class="row" style="margin-top: 20px">
        <div align="middle" class="col-lg-12">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                            <label style="color: #000000; font-size: 18px; margin-bottom: 20px">Nhập File Đáp Án</label>
                            <input style="color: #000000" type="file" name="uploadfile"></br>
                            <li style="color: #000000"><a href="{{url('/template/Template_Answer.xlsx')}}"> Tải file Template</a></li>
                            <div align="middle" style="margin-top: 00px">
                                <button class="btn btn-primary " type="submit" style="margin-top: 30px">Thêm</button>
                                <a class="btn btn-primary" href="{{url('/')}}" style="margin-top: 30px">Thoát</a>
                            </div>
                        </form>

            </div>
        </div>
    @endsection
