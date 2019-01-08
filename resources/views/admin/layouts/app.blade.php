<!DOCTYPE html>
<html lang="en">
    <head>        
        <!-- META SECTION -->
        <title>سائح - لوحة التحكم</title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        <link rel="icon" href="{{asset('admin/assets/images/users/avatar.jpg')}}" type="image/x-icon" />
        <!-- END META SECTION -->

        <!-- CSS INCLUDE -->
        <link rel="stylesheet" type="text/css" id="theme" href="{{asset('admin/css/theme-default_rtl.css')}}"/>
        <link rel="stylesheet" type="text/css" id="theme" href="{{asset('admin/css/rtl.css')}}"/>
        <script type="text/javascript" src="{{asset('admin/js/plugins/jquery/jquery.min.js')}}"></script>
        <!-- START PLUGINS -->
        <script type="text/javascript" src="{{asset('admin/js/plugins/jquery/jquery-ui.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('admin/js/plugins/bootstrap/bootstrap.min.js')}}"></script>
        <!-- END PLUGINS -->
        <!-- EOF CSS INCLUDE --> 
    </head>
    <body>
        <!-- START PAGE CONTAINER -->
        <div class="page-container page-mode-rtl page-content-rtl">
            
            <!-- START PAGE SIDEBAR -->
            <div class="page-sidebar page-sidebar-fixed scroll" style="height: 0px !important">
                <!-- START X-NAVIGATION -->
                <ul class="x-navigation">
                    <li class="xn-logo">
                        <a href="/admin/dashboard">Tourist</a>
                    </li>
                    <li class="xn-profile">
                        <a href="#" class="profile-mini">
                            <img src="assets/images/users/avatar.jpg" alt="John Doe"/>
                        </a>
                        <div class="profile">
                            <div class="profile-image">
                                <img style="height: 100px; width: 100px;" src="{{asset('admin/assets/images/users/avatar.jpg')}}" alt="tourist"/>
                            </div>
                        </div>                                                                        
                    </li>
                    <li class="active">
                        <li>
                            <a href="/admin/dashboard"><span class="xn-text">الرئيسية</span> <span class="fa fa-home"></span></a>
                        </li>
                        <li class="xn-openable @if(Request::is('admin/users/*')) active @endif" >
                            <a href="#"><span class="xn-text">المستخدمين</span> <span class="fa fa-group"></span></a>
                            <ul>
                                <li @if(Request::is('admin/users/admins ')) class="active" @endif>
                                    <a href="/admin/users/admins"><span class="xn-text">المديرين</span><span class="fa fa-user-secret"></span></a>
                                </li>
                                <li @if(Request::is('admin/users/active')) class="active" @endif>
                                    <a href="/admin/users/active"><span class="xn-text">المستخدمين</span><span class="fa fa-users"></span></a>
                                </li>
                                <li @if(Request::is('admin/users/suspended')) class="active" @endif>
                                    <a href="/admin/users/suspended"><span class="xn-text">المستخدمين الموقوفين</span><span class="fa fa-user-o"></span></a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="/admin/posts"><span class="xn-text">المشاركات</span> <span class="fa fa-clipboard"></span></a>
                        </li> 
                        <li class="xn-openable @if(Request::is('settings/*')) active @endif">
                            <a href="#"><span class="xn-text">إعدادات التطبيق</span> <span class="fa fa-cogs"></span></a>
                            <ul>
                                <li @if(Request::is('admin/settings/about')) class="active" @endif>
                                    <a href="/admin/settings/about"><span class="xn-text">معلومات عنا</span><span class="fa fa-info-circle"></span></a>
                                </li>
                                <li @if(Request::is('admin/settings/term')) class="active" @endif>
                                    <a href="/admin/settings/term"><span class="xn-text">القواعد و الشروط</span><span class="fa fa-check-square-o"></span></a>
                                </li>
                                <li @if(Request::is('admin/settings/suggestion')) class="active" @endif>
                                    <a href="/admin/settings/suggestion"><span class="xn-text">الشكاوي و المقترحات</span><span class="fa fa-newspaper-o"></span></a>
                                </li>
                            </ul>
                        </li>                      
                    </li>                    
                    
                </ul>
                <!-- END X-NAVIGATION -->
            </div>
            <!-- END PAGE SIDEBAR -->
            
            <!-- PAGE CONTENT -->
            <div class="page-content">
                
                <!-- START X-NAVIGATION VERTICAL -->
                <ul class="x-navigation x-navigation-horizontal x-navigation-panel">
                    <!-- POWER OFF -->
                    <li class="xn-icon-button last">
                        <a href="/admin/logout" title="تسجيل الخروج"><span class="fa fa-power-off"></span></a>
                    </li>
                    <!-- END POWER OFF -->
                </ul>
                <!-- END X-NAVIGATION VERTICAL -->             
   
        
        @yield('content')

        <!-- START PRELOADS -->
        <audio id="audio-alert" src="{{asset('admin/audio/alert.mp3')}}" preload="auto"></audio>
        <audio id="audio-fail" src="{{asset('admin/audio/fail.mp3')}}" preload="auto"></audio>
        <!-- END PRELOADS -->                  
        
    <!-- START SCRIPTS -->
        <!-- THIS PAGE PLUGINS -->
        <script type='text/javascript' src="{{asset('admin/js/plugins/icheck/icheck.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('admin/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js')}}"></script>

        <script type="text/javascript" src="{{asset('admin/js/plugins/owl/owl.carousel.min.js')}}"></script>
        <!-- END PAGE PLUGINS -->

        <!-- START TEMPLATE -->
        <script type="text/javascript" src="{{asset('admin/js/plugins.js')}}"></script>
        <script type="text/javascript" src="{{asset('admin/js/actions.js')}}"></script>
        <script type="text/javascript" src="{{asset('admin/js/demo_dashboard.js')}}"></script>


        <script type="text/javascript" src="{{asset('admin/js/plugins/bootstrap/bootstrap-datepicker.js')}}"></script>
        <script type="text/javascript" src="{{asset('admin/js/plugins/bootstrap/bootstrap-file-input.js')}}"></script>
        <script type="text/javascript" src="{{asset('admin/js/plugins/bootstrap/bootstrap-select.js')}}"></script>
        <script type="text/javascript" src="{{asset('admin/js/plugins/tagsinput/jquery.tagsinput.min.js')}}"></script>
        <!-- END THIS PAGE PLUGINS -->
    <!-- END SCRIPTS -->         
    </body>
</html>






