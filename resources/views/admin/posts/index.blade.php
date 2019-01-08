@extends('admin.layouts.app')
@section('content')
    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="/admin/dashboard">الرئيسية</a></li>
        <li class="active">المشاركات </li>
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
                <table class="table">
                    <thead>
                    <tr>
                        <th class="rtl_th">#</th>
                        <th class="rtl_th">إسم المستخدم</th>
                        <th class="rtl_th">المنشور</th>
                        <th class="rtl_th">عدد الإعجبات</th>
                        <th class="rtl_th">عدد البلاغات</th>
                        <th class="rtl_th">التاريخ</th>
                        <th class="rtl_th">الإجراء المتخذ</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($posts as $post)
                    <tr>
                        <td>{{$post->id}}</td>
                        <td>{{$post->user->name}}</td>
                        <td>{{mb_substr($post->body, 0, 20)}}</td>
                        <td>{{$post->likes}}</td>
                        <td>{{count($post->report)}}</td>
                        <td>{{$post->created_at->diffForHumans()}}</td>
                        <td>
                            <a href="/admin/posts/view/{{$post->id}}">
                                <button type="button" class="btn btn-info">عرض <i class="fa fa-eye"></i></button>
                            </a>
                           <button class="btn btn-danger btn-condensed mb-control" data-box="#message-box-danger-{{$post->id}}" title="حذف"><i class="fa fa-trash-o"></i></button>
                        </td>
                    </tr>

                        <!-- danger with sound -->
                        <div class="message-box message-box-danger animated fadeIn" data-sound="alert/fail" id="message-box-danger-{{$post->id}}">
                            <div class="mb-container">
                                <div class="mb-middle warning-msg alert-msg">
                                    <div class="mb-title"><span class="fa fa-times"></span> الرجاء الإنتباه</div>
                                    <div class="mb-content">
                                    <p>أنت علي وشك أن تحذف هذه المشاركة و لن تستطيع إسترجاع بياناته مره أخري,هل أنت متأكد ؟</p>
                                    </div>
                                    <div class="mb-footer buttons">
                                        <form method="post" action="/admin/posts/delete" class="buttons">
                                            {{csrf_field()}}
                                            <input type="hidden" name="post_id" value="{{$post->id}}">
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
                {{$posts->links()}}
            </div>
            </div>
            </div>
            </div>
        </div>
    </div>

@endsection
