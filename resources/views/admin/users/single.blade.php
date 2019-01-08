@extends('admin.layouts.app')
@section('content')
    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="/admin/dashboard">الرئيسية</a></li>
        <li><a>مستخدمين التطبيق</a></li>
        <li class="active">إضافة مستخدم</li>
    </ul>
    <!-- END BREADCRUMB -->
{{--{{dd($errors)}}--}}
    <div class="page-content-wrap">

        <div class="row">
            <div class="col-md-12">
                <form class="form-horizontal" method="post" @if(Request::is('admin/user/createadmin')) action="/admin/user/storeadmin" @else action="/admin/user/store" @endif>
                    {{csrf_field()}}
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <strong>
                                   إضافة مستخدم
                                </strong>
                            </h3>
                        </div>
                        <div class="panel-body">
                            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                <label class="col-md-3 col-xs-12 control-label">الإسم</label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-user"></span></span>
                                        <input type="text" class="form-control" name="name" value="{{old('name')}}"/>
                                    </div>
                                    @include('admin.layouts.error', ['input' => 'name'])
                                </div>
                            </div>


                            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                <label class="col-md-3 col-xs-12 control-label">البريد الإلكتروني</label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-envelope"></span></span>
                                        <input type="email" class="form-control" name="email" value="{{old('email')}}"/>
                                    </div>
                                    @include('admin.layouts.error', ['input' => 'email'])
                                </div>
                            </div>


                            <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label class="col-md-3 col-xs-12 control-label">رقم الهاتف</label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-phone"></span></span>
                                        <input type="text" class="form-control" name="phone" value="{{old('phone')}}"/>
                                    </div>
                                    @include('admin.layouts.error', ['input' => 'phone'])
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                <label class="col-md-3 col-xs-12 control-label">كلمة المرور</label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-asterisk"></span></span>
                                        <input type="password" class="form-control" name="password"/>
                                    </div>
                                    @include('admin.layouts.error', ['input' => 'password'])
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label class="col-md-3 col-xs-12 control-label">تأكيد كلمة المرور</label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-asterisk"></span></span>
                                        <input type="password" class="form-control" name="password_confirmation"/>
                                    </div>
                                    @include('admin.layouts.error', ['input' => 'password_confirmation'])
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <button type="reset" class="btn btn-default">تفريغ</button> &nbsp;
                            <button class="btn btn-primary pull-right">
                                إضافة
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

    </div>
@endsection
