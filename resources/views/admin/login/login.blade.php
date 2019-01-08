<!DOCTYPE html>
<html lang="en" class="body-full-height">
<head>
    <!-- META SECTION -->
    <title>سائح - تسجيل الدخول</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="icon" href="{{asset('/admin/img/favicon.ico')}}" type="image/x-icon" />
    <!-- END META SECTION -->

    <!-- CSS INCLUDE -->
    <link rel="stylesheet" type="text/css" id="theme" href="{{asset('/admin/css/theme-default.css')}}"/>
    <!-- EOF CSS INCLUDE -->
</head>
<body>
{{--{{dd($errors)}}--}}
<div class="login-container">

    <div class="login-box animated fadeInDown">

        <div class="login-body" style="direction: rtl;">
            <div class="login-title"><strong>أهلاً</strong>, يرجي تسجيل الدخول</div>
            @include('admin.layouts.message')
            <form action="/admin/login" class="form-horizontal" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <div class="col-md-12">
                        <input type="text" class="form-control" name="email" placeholder="البريد الإلكتروني"/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <input type="password" class="form-control" name="password" placeholder="كلمة المرور"/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                        <button class="btn btn-info btn-block">تسجيل الدخول</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

</body>
</html>

