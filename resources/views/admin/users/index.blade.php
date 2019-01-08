@extends('admin.layouts.app')
@section('content')
    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="/admin/dashboard">الرئيسية</a></li>
        <li class="active">المستخدمين </li>
    </ul>
    <!-- END BREADCRUMB -->
    <div class="page-content-wrap">
        <div class="row">
            <div class="col-md-12 col-xs-12">
            @include('admin.layouts.message')
            <!-- START BASIC TABLE SAMPLE -->
    <div class="panel panel-default">
        <div class="panel-heading">
            @if(Request::is('admin/users/admins'))
            <a href="/admin/user/createadmin">
            <button type="button" class="btn btn-info">أضف مستخدم</button>
            </a>
            @else
            <a href="/admin/user/create">
            <button type="button" class="btn btn-info">أضف مستخدم</button>
            </a>
            @endif
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th class="rtl_th">#</th>
                        <th class="rtl_th">الإسم</th>
                        <th class="rtl_th">البريد الإلكتروني</th>
                        <th class="rtl_th">رقم الهاتف</th>
                        @if(Request::is('admin/users/suspended'))
                            <th class="rtl_th">النوع</th>
                        @endif
                        <th class="rtl_th">الحالة</th>
                        <th class="rtl_th">الإجراء المتخذ</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->phone}}</td>
                        @if(Request::is('admin/users/suspended'))
                            <td>
                                @if($user->role == 'admin')
                                    مدير
                                @else
                                    مستخدم عادي
                                @endif
                            </td>
                        @endif
                        <td>@if($user->active == 1) <span style="color: green;">مفعل</span> @else <span style="color: red;">غير مفعل</span> @endif</td>
                        <td>
                                <!-- @if($user->role == 'admin')
                                    <button class="btn btn-default btn-condensed mb-control" data-box="#message-box-warning-{{$user->id}}" title="أجعله مستخدم عادي"><i class="fa fa-user-secret"></i></button>
                                @else
                                <button class="btn btn-success btn-condensed mb-control" data-box="#message-box-success-{{$user->id}}" title="أجعله مدير"><i class="fa fa-user-secret"></i></button>
                                @endif -->

                                @if($user->active == 0) <a href="/admin/user/{{$user->id}}/change_status" title="تفعيل" class="buttons"><button class="btn btn-success btn-condensed"><i class="fa fa-thumbs-up"></i>  </button> </a> @else<a href="/admin/user/{{$user->id}}/change_status"  title="إلغاء التفعيل" class="buttons"><button class="btn btn-dark btn-condensed"><i class="fa fa-thumbs-down"></i> </button></a>@endif
                            <button class="btn btn-danger btn-condensed mb-control" data-box="#message-box-danger-{{$user->id}}" title="حذف"><i class="fa fa-trash-o"></i></button>
                        </td>
                    </tr>

                    <!-- danger with sound -->
                    <div class="message-box message-box-success animated fadeIn" data-sound="alert/fail" id="message-box-success-{{$user->id}}">
                        <div class="mb-container">
                            <div class="mb-middle warning-msg alert-msg">
                                <div class="mb-title"><span class="fa fa-times"></span> الرجاء الإنتباه</div>
                                <div class="mb-content">
                                    <p>أنت علي وشك أن تمكن هذا المستخدم أن يكون مدير,وسيستطيع الآن بأن يقوم بمهام المدير من الدخول إلي لوحة التحكم و ما إلي خلافه,هل أنت متأكد ؟</p>
                                </div>
                                <div class="mb-footer buttons">
                                    <form method="post" action="/admin/user/adminize" class="buttons">
                                        {{csrf_field()}}
                                        <input type="hidden" name="user_id" value="{{$user->id}}">
                                        <button class="btn btn-success btn-lg btn-success btn-lg pull-right">تعيين</button>
                                    </form>
                                    <button class="btn btn-default btn-lg pull-right mb-control-close" style="margin-right: 5px;">إلغاء</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end danger with sound -->

                    <!-- danger with sound -->
                    <div class="message-box message-box-default animated fadeIn" data-sound="alert/fail" id="message-box-warning-{{$user->id}}">
                        <div class="mb-container">
                            <div class="mb-middle warning-msg alert-msg">
                                <div class="mb-title"><span class="fa fa-times"></span> الرجاء الإنتباه</div>
                                <div class="mb-content">
                                    <p>أنت علي وشك أن تحجب هذا المستخدم من أن يكون مدير,و لن يتمكن الدخول إلي لوحة التحكم و ما إلي خلافه,هل أنت متأكد ؟</p>
                                </div>
                                <div class="mb-footer buttons">
                                    <form method="post" action="/admin/user/adminize" class="buttons">
                                        {{csrf_field()}}
                                        <input type="hidden" name="user_id" value="{{$user->id}}">
                                        <button class="btn btn-default btn-lg btn-default btn-lg pull-right">إلغاء التعيين</button>
                                    </form>
                                    <button class="btn btn-default btn-lg pull-right mb-control-close" style="margin-right: 5px;">إلغاء</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end danger with sound -->

                    <!-- danger with sound -->
                    <div class="message-box message-box-danger animated fadeIn" data-sound="alert/fail" id="message-box-danger-{{$user->id}}">
                        <div class="mb-container">
                            <div class="mb-middle warning-msg alert-msg">
                                <div class="mb-title"><span class="fa fa-times"></span> الرجاء الإنتباه</div>
                                <div class="mb-content">
                                   <p>أنت علي وشك أن تحذف هذا المستخدم و لن تستطيع إسترجاع بياناته مره أخري,مثل الطلبات و الرسائل و ما إلي خلافه,هل أنت متأكد ؟</p>
                                </div>
                                <div class="mb-footer buttons">
                                    <form method="post" action="/admin/user/delete" class="buttons">
                                        {{csrf_field()}}
                                        <input type="hidden" name="user_id" value="{{$user->id}}">
                                        <button class="btn btn-danger btn-lg btn-danger btn-lg pull-right">حذف</button>
                                    </form>
                                    <button class="btn btn-default btn-lg pull-right mb-control-close" style="margin-right: 5px;">إلغاء</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end danger with sound -->
                    @endforeach
                    </tbody>

                </table>
                {{$users->links()}}
            </div>
            </div>
            </div>
            </div>
        </div>
    </div>

@endsection
