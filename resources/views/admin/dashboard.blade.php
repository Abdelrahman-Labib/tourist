@extends('admin.layouts.app')
@section('content')
<!-- START BREADCRUMB -->
<ul class="breadcrumb">
                    <li><a href="/admin/dashboard">الرئيسية</a></li> 
                </ul>
                <!-- END BREADCRUMB -->                       
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                    
                    <!-- START WIDGETS -->                    
                    <div class="row">
                        <div class="col-md-4">
                            
                            <!-- START WIDGET SLIDER -->
                            <div class="widget widget-default widget-item-icon">
                                    <div class="widget-item-left">
                                        <span class="fa fa-user"></span>
                                    </div>
                                    <div class="widget-data">                                    
                                        <div class="widget-title">Total Users</div>     
                                        <div class="widget-int">{{$totals['users']}}</div>
                                    </div>                           
                                <div class="widget-controls">                                
                                </div>                             
                            </div>         
                            <!-- END WIDGET SLIDER -->
                            
                        </div>
                        <div class="col-md-4">
                            
                            <!-- START WIDGET REGISTRED -->
                            <div class="widget widget-default widget-item-icon">
                                <div class="widget-item-left">
                                    <span class="fa fa-building"></span>
                                </div>
                                <div class="widget-data">
                                        <div class="widget-title">Total Posts</div>     
                                        <div class="widget-int">{{$totals['post']}}</div>
                                </div>
                                <div class="widget-controls">                                
                                </div>                            
                            </div>                            
                            <!-- END WIDGET REGISTRED -->
                            
                        </div>
                        <div class="col-md-4">
                            
                            <!-- START WIDGET CLOCK -->
                            <div class="widget widget-danger widget-padding-sm">
                                <div class="widget-big-int plugin-clock">00:00</div>                            
                                <div class="widget-subtitle plugin-date">Loading...</div>
                                <div class="widget-controls">                                
                                    <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="left" title="Remove Widget"><span class="fa fa-times"></span></a>
                                </div>                            
                                <div class="widget-buttons widget-c3">
                                    <div class="col">
                                        <a href="#"><span class="fa fa-clock-o"></span></a>
                                    </div>
                                    <div class="col">
                                        <a href="#"><span class="fa fa-bell"></span></a>
                                    </div>
                                    <div class="col">
                                        <a href="#"><span class="fa fa-calendar"></span></a>
                                    </div>
                                </div>                            
                            </div>                        
                            <!-- END WIDGET CLOCK -->
                    
@endsection