@extends('admin.layouts.app')
@section('content')
    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="/admin/dashboard">الرئيسية</a></li>
        <li>الحجوزات</li>
        <li class="active">حجوزات غير تامة </li>
    </ul>
    <!-- END BREADCRUMB -->
    <div class="page-content-wrap">
        <div class="row">
            <div class="col-md-12 col-xs-12">
            @include('admin.layouts.message')
            <!-- START BASIC TABLE SAMPLE -->
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="table-responsive">
            @if(count($post->postImage) == 0)

            @else
            <H2>صور المشاركة <i class="fa fa-user"></i></H2>
            @foreach($post->postImage as $postImage)
                <img src="/tourist/{{$postImage->image}}" alt="Smiley face" height="150" width="150">
                
            @endforeach
            <br><br>
            @endif
                <H2>معلومات المستخدم <i class="fa fa-user"></i></H2>
                <table class="table">
                    <thead>
                    <tr>
                        <th class="rtl_th">إسم المستخدم</th>
                        <th class="rtl_th"></th>
                        <th class="rtl_th">البريد الإلكتروني</th>
                        <th class="rtl_th"></th>
                        <th class="rtl_th">الموبايل</th>
                    </tr>
                    </thead>
                    <tbody>
                   
                    <tr>
                        <td>{{$post->user->name}}</td>
                        <td></td>
                        <td>{{$post->user->email}}</td>
                        <td></td>
                        <td>{{$post->user->phone}}</td>
                        <td>
                    </tr>
               
                    </tbody>

                </table>

                <H2>معلومات المشاركة <i class="fa fa-clipboard"></i></H2>
                <table class="table">
                    <thead>
                    <tr>
                        <th class="rtl_th">المنشور</th>
                        <th class="rtl_th">عدد الإعجبات</th>
                    </tr>
                    </thead>
                    <tbody>
                 
                    <tr>
                        <td>{{$post->body}}</td>
                        <td>{{$post->likes}}</td>
                    </tr>
                    </tbody>

                </table>

                <H2>معلومات التبليغ <i class="fa fa-clipboard"></i></H2>
                <table class="table">
                    <thead>
                    <tr>
                        <th class="rtl_th">اسم صاحب التبليغ</th>
                        <th class="rtl_th">نوع التبليغ</th>
                    </tr>
                    </thead>
                    <tbody>
                 
                    @foreach($post->report as $report)
                    <tr>
                        <td>{{$report->user->name}}</td>
                        <td>{{$report->type}}</td>
                    </tr>
                    @endforeach
                    </tbody>

                </table>

                <H2>معلومات التعليقات <i class="fa fa-clipboard"></i></H2>
                <table class="table">
                    <thead>
                    <tr>
                        <th class="rtl_th">اسم صاحب التعليق</th>
                        <th class="rtl_th">التعليق</th>
                    </tr>
                    </thead>
                    <tbody>
                 
                    @foreach($post->comment as $comment)
                    <tr>
                        <td>{{$comment->user->name}}</td>
                        <td>{{$comment->comment}}</td>
                    </tr>
                    @endforeach
                    </tbody>

                </table>
            </div>
            </div>
            </div>
            </div>
        </div>
    </div>

@endsection
