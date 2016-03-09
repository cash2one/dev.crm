<!DOCTYPE html>
<html lang="zh" xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
    <head>
        <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
            <meta name="viewport" content="width=device-width, initial-scale=1"/>
            <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
            <title><?php echo CHtml::encode($this->pageTitle); ?></title>
            <link rel="shortcut icon" type="image/ico" href="http://www.mingyizhudao.com/themes/v4/images/icons/favicon.ico"/>
            <!-- Bootstrap -->
            <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.min.css" />
            <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/basic.css" />
            <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/crm.css" />                   
            <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery-1.9.1.min.js"></script>
            <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/bootstrap.min.js"></script>           
            <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/main.js"></script>     
    </head>	
    <body>
        <script>
        </script>
        <section id="body">
            <div class="container-fluid">
                <nav class="navbar navbar-default" role="navigation">
                    <h3>后台管理系统</h3>
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#header-navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>   
                </nav>
                <div class="row bg-blue" >
                    <div class="col-sm-3 col-md-2 ">
                        <div class="menu" >
                            <h3 class="color-white">操作导航</h3>
                            <div class="collapse navbar-collapse" id="header-navbar-collapse"> 
                                <style>ul{padding-left:0px; }#header-navbar-collapse a{color:#fff;}</style>
                                <div class="mt20 text16" >
                                    <a href="<?php echo $this->createUrl('default/index') ?>">
                                        首页
                                    </a>
                                </div> 
                                <?php if (!Yii::app()->user->isGuest): ?>
                                    <div class="dropdown mt20" >
                                        <div class="dropdown-toggle color-white"  id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            任务<span class="task"></span>
                                            <span class="caret pull-right"></span>
                                        </div>
                                        <ul class="dropdown-menu bg-success" aria-labelledby="dropdownMenu1">
                                            <?php if (Yii::app()->user->checkAccess('Admin.AdminTask.List')): ?>
                                                <li><a href="<?php echo $this->createUrl('admintask/list') ?>">列表</a></li>
                                            <?php endif; ?>
                                            <?php if (Yii::app()->user->checkAccess('Admin.AdminTask.Search')): ?>
                                                <li><a href="<?php echo $this->createUrl('admintask/search') ?>">搜索</a></li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                    <div class="dropdown mt20" >
                                        <div class="dropdown-toggle color-white"  id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            医院
                                            <span class="caret pull-right"></span>
                                        </div>                                                         
                                        <ul class="dropdown-menu bg-success" aria-labelledby="dropdownMenu2">
                                            <?php if (Yii::app()->user->checkAccess('Admin.Hospital.List')): ?>
                                                <li><a href="<?php echo $this->createUrl('hospital/list') ?>">列表</a></li>
                                            <?php endif; ?>
                                            <?php if (Yii::app()->user->checkAccess('Admin.Hospital.Admin')): ?>
                                                <li><a href="<?php echo $this->createUrl('hospital/admin') ?>">搜索</a></li>
                                            <?php endif; ?>
                                            <?php if (Yii::app()->user->checkAccess('Admin.Hospital.Create')): ?>
                                                <li ><a href="<?php echo $this->createUrl('hospital/create') ?>">创建</a></li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                    <div class="dropdown mt20" >
                                        <div class="dropdown-toggle color-white"  id="dropdownMenu3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            医生
                                            <span class="caret pull-right"></span>
                                        </div>                                                         
                                        <ul class="dropdown-menu bg-success" aria-labelledby="dropdownMenu3">
                                            <?php if (Yii::app()->user->checkAccess('Admin.Doctor.Index')): ?>
                                                <li><a href="<?php echo $this->createUrl('doctor/index') ?>">列表</a></li>
                                            <?php endif; ?>
                                            <?php if (Yii::app()->user->checkAccess('Admin.Doctor.Admin')): ?>
                                                <li><a href="<?php echo $this->createUrl('doctor/admin') ?>">搜索</a></li>
                                            <?php endif; ?>
                                            <?php if (Yii::app()->user->checkAccess('Admin.Doctor.CreateDoctor')): ?>
                                                <li ><a href="<?php echo $this->createUrl('doctor/createDoctor') ?>">创建医生</a></li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                    <div class="dropdown mt20" >
                                        <div class="dropdown-toggle color-white"  id="dropdownMenu4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            预约
                                            <span class="caret pull-right"></span>
                                        </div>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu4">
                                            <?php if (Yii::app()->user->checkAccess('Admin.AdminBooking.List')): ?>
                                                <li><a href="<?php echo $this->createUrl('adminbooking/list') ?>">列表</a></li>
                                            <?php endif; ?>
                                            <?php if (Yii::app()->user->checkAccess('Admin.AdminBooking.Admin')): ?>
                                                <li><a href="<?php echo $this->createUrl('adminbooking/admin') ?>">搜索</a></li>
                                            <?php endif; ?>
                                            <?php if (Yii::app()->user->checkAccess('Admin.AdminBooking.Create')): ?>
                                                <li><a href="<?php echo $this->createUrl('adminbooking/create') ?>">创建</a></li>
                                            <?php endif; ?>
                                    </div> 
                                    <div class="dropdown mt20" >
                                        <div class="dropdown-toggle color-white"  id="dropdownMenu5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            预约-患者端
                                            <span class="caret pull-right"></span>
                                        </div>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu5">
                                            <?php if (Yii::app()->user->checkAccess('Admin.Booking.List')): ?>
                                                <li><a href="<?php echo $this->createUrl('booking/list') ?>">列表</a></li>
                                            <?php endif; ?>
                                            <?php if (Yii::app()->user->checkAccess('Admin.Booking.Admin')): ?>
                                                <li><a href="<?php echo $this->createUrl('booking/admin') ?>">搜索</a></li>
                                            <?php endif; ?>
                                    </div> 
                                    <div class="dropdown mt20" >
                                        <div class="dropdown-toggle color-white"  id="dropdownMenu6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            预约-医生端
                                            <span class="caret pull-right"></span>
                                        </div>

                                        <ul class="dropdown-menu " aria-labelledby="dropdownMenu6">
                                            <?php if (Yii::app()->user->checkAccess('Admin.Patientbooking.List')): ?>
                                                <li><a href="<?php echo $this->createUrl('patientbooking/list') ?>">列表</a></li>
                                            <?php endif; ?>
                                            <?php if (Yii::app()->user->checkAccess('Admin.Patientbooking.Admin')): ?>
                                                <li><a href="<?php echo $this->createUrl('patientbooking/admin') ?>">搜索</a></li>
                                            <?php endif; ?>
                                        </ul>
                                    </div> 
                                    <div class="dropdown mt20" >
                                        <div class="dropdown-toggle color-white"  id="dropdownMenu7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            订单
                                            <span class="caret pull-right"></span>
                                        </div>
                                        <ul class="dropdown-menu bg-success" aria-labelledby="dropdownMenu7">
                                            <?php if (Yii::app()->user->checkAccess('Admin.Order.Index')): ?>
                                                <li><a href="<?php echo $this->createUrl('order/index') ?>">列表</a></li>  
                                            <?php endif; ?>
                                            <?php if (Yii::app()->user->checkAccess('Admin.Order.Search')): ?>
                                                <li><a href="<?php echo $this->createUrl('order/search') ?>">搜索</a></li>  
                                            <?php endif; ?>
                                            <?php if (Yii::app()->user->checkAccess('Admin.Order.Create')): ?>
                                                <li><a href="<?php echo $this->createUrl('order/create') ?>">创建</a></li> 
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                    <div class="dropdown mt20" >
                                        <div class="dropdown-toggle color-white"  id="dropdownMenu8" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            医生用户
                                            <span class="caret pull-right"></span>
                                        </div>

                                        <ul class="dropdown-menu bg-success" aria-labelledby="dropdownMenu8">
                                            <?php if (Yii::app()->user->checkAccess('Admin.User.Index')): ?>
                                                <li><a href="<?php echo $this->createUrl('user/index') ?>">列表</a></li>
                                            <?php endif; ?>
                                            <?php if (Yii::app()->user->checkAccess('Admin.User.Admin')): ?>
                                                <li><a href="<?php echo $this->createUrl('user/admin') ?>">搜索</a></li>     
                                            <?php endif; ?>
                                        </ul>
                                    </div>                             
                                    <div class="dropdown mt20" >
                                        <div class="dropdown-toggle color-white"  id="dropdownMenu9" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            平台用户
                                            <span class="caret pull-right"></span>
                                        </div>
                                        <ul class="dropdown-menu bg-success" aria-labelledby="dropdownMenu9">
                                            <?php if (Yii::app()->user->checkAccess('Admin.Adminuser.Admin')): ?>
                                                <li><a href="<?php echo $this->createUrl('adminuser/admin') ?>">搜索</a></li>   
                                            <?php endif; ?>
                                            <?php if (Yii::app()->user->checkAccess('Admin.Adminuser.Create')): ?>
                                                <li><a href="<?php echo $this->createUrl('adminuser/create') ?>">创建</a></li>
                                            <?php endif; ?>
                                            <?php if (Yii::app()->user->checkAccess(Rights::module()->superuserName)): ?>
                                                <li><a href="<?php echo $this->createAbsoluteUrl('/rights') ?>">权限</a></li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                                <?php if (Yii::app()->user->isGuest): ?>
                                    <div class="mt20 text16" > 
                                        <a href="<?php echo $this->createUrl('default/login') ?>">Login</a> 
                                    </div> 
                                <?php endif; ?>
                                <?php if (!Yii::app()->user->isGuest): ?>
                                    <div class="mt20 text16" >
                                        <a href="<?php echo $this->createUrl('default/logout') ?>">LoginOut(<?php echo Yii::app()->user->name ?>)</a> 
                                    </div> 
                                <?php endif; ?>
                            </div><!-- /.navbar-collapse -->

                        </div>
                    </div>
                    <div class="col-sm-9 col-md-10 bg-info list" >
                        <div class="list-area">
                            <h4 class="list-title">  <?php if (isset($this->breadcrumbs)): ?>
                                    <script>$(function () {
                                            var firstChild = $(".breadcrumbs>:first");
                                            firstChild.attr('onclick', 'return false');
                                        });</script>                                                          
                                    <?php
                                    $this->widget('zii.widgets.CBreadcrumbs', array(
                                        'links' => $this->breadcrumbs,
                                    ));
                                    ?><?php endif ?></h4>

                            <?php echo $content; ?>
                        </div>
                    </div>
                    <div id='task-area' class="col-sm-12">

                    </div>
                </div>
            </div>
            <script>
                $(document).ready(function () {
                    ajaxGetAlert();
                    ajaxGetPlan();
                    //30s获取一次任务提醒条数
                    setInterval('ajaxGetAlert()', 30000);
                    //1min获取一次计划跟单并提醒
                    setInterval('ajaxGetPlan()', 60000);

                });
                //异步获取任务提醒条数
                function ajaxGetAlert() {
                    var innerHtml = '';
                    $.ajax({
                        url: '<?php echo $this->createUrl('admintask/ajaxAlert'); ?>',
                        success: function (data) {
                            innerHtml += '<span class="new">' + data.results.new + '</span>未读<span class="undown">' + data.results.undone + '</span>未完成';
                            $('#dropdownMenu1 .task').html(innerHtml);
                        }
                    });
                }
                //异步获取计划跟单并提醒
                function ajaxGetPlan() {
                    $.ajax({
                        url: '<?php echo $this->createUrl('admintask/ajaxPlan'); ?>',
                        success: function (data) {
                            setPlanHtml(data.results);
                        }
                    });
                }
                function setPlanHtml(results) {
                    var innerHtml = '';
                    if (results) {
                        for (var i = 0; i < results.length; i++) {
                            var taskPlan = results[i];
                            innerHtml += '<div class="taskplan"><div class="taskplan-title"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4 class="text-center">跟单任务提醒</h4></div>' +
                                    '<div class="taskplan-content"><div>' + taskPlan.subject + '</div><div>' + taskPlan.content + '</div></div>' +
                                    '<div class="taskplan-footer"><div class="text-right"><a href="' + taskPlan.url + '" target="_blank">详情>></a></div><div class="mt5 text-right">创建时间: ' + taskPlan.date_created + '</div></div></div>';
                        }
                    }
                    $('#task-area').append(innerHtml);
                    $('.taskplan .close').click(function () {
                        $(this).parents('.taskplan').remove();
                    });
                }
            </script>
        </section>                     
    </body>
</html>

