@extends('admin.layouts.app')
@section('content')
    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="/admin/dashboard">الرئيسية</a></li>
        <li>إعدادات التطبيق</li>
        <li class="active">معلومات عن التطبيق</li>
    </ul>
    <!-- END BREADCRUMB -->
    <div class="page-content-wrap">
        <div class="row">
            <div class="col-md-12 col-xs-12">
            @include('admin.layouts.message')
            <!-- START BASIC TABLE SAMPLE -->
                <div class="panel panel-default">
                    <div class="panel-body" style="overflow: auto;">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th class="rtl_th">#</th>
                                    <th class="rtl_th">النص بالعربية</th>
                                    <th class="rtl_th">الإجراء المتخذ</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($abouts as $about)
                                    <tr>
                                        <td>{{$about->id}}</td>
                                        <td>
                                            {!! $about->ar_text !!}
                                        </td>
                                        <td>
                                            <a href="/admin/settings/about/edit" title="تعديل" class="buttons"><button class="btn btn-info btn-condensed"><i class="fa fa-edit"></i></button></a>
                                        </td>
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
