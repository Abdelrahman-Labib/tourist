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
                                    <th class="rtl_th">الإسم</th>
                                    <th class="rtl_th">الإيميل</th>
                                    <th class="rtl_th">المقترح</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($suggestions as $suggestion)
                                    <tr>
                                        <td>{{$suggestion->id}}</td>
                                        <td>
                                            {!! $suggestion->name !!}
                                        </td>
                                        <td>
                                            {!! $suggestion->email !!}
                                        </td>
                                        <td>
                                            {!! $suggestion->text !!}
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
