<!DOCTYPE html>
<html lang="zh" xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>                
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta charset="utf-8" />
        <meta http-equiv="cache-control" content="no-cache" />
        <meta http-equiv="expires" content="0" />
        <meta http-equiv="pragma" content="no-cache" />
        <link rel="shortcut icon" type="image/ico" href="http://www.mingyizhudao.com/themes/v4/images/icons/favicon.ico"/>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/basic.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/crm.css" /> 
        <!--[if lt IE 8]>
        <link rel="stylesheet" type="text/css" href="<?php //echo Yii::app()->theme->baseUrl;       ?>/css/ie.css" media="screen, projection" />
        <![endif]-->
        <?php
        Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/jquery-1.9.1.min.js', CClientScript::POS_HEAD);
        Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/bootstrap.min.js', CClientScript::POS_HEAD);
        ?>
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>
    <style>ul{padding-left:0px; }#header-navbar-collapse a{color:#fff;}</style>
    <body>
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
                                    <a href="<?php echo $this->createUrl('/admin/default/index') ?>">
                                        首页
                                    </a>
                                </div> 
                                <?php if (!Yii::app()->user->isGuest): ?>
                                    <div class="dropdown mt20" >
                                        <div class="dropdown-toggle color-white"  id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            医院
                                            <span class="caret pull-right"></span>
                                        </div>                                                         
                                        <ul class="dropdown-menu bg-success" aria-labelledby="dropdownMenu1">
                                            <?php if (Yii::app()->user->checkAccess('Admin.Hospital.Admin')): ?>
                                                <li><a href="<?php echo $this->createUrl('/admin/hospital/index') ?>">搜索</a></li>
                                            <?php endif; ?>
                                            <?php if (Yii::app()->user->checkAccess('Admin.Hospital.Create')): ?>
                                                <li ><a href="<?php echo $this->createUrl('/admin/hospital/create') ?>">创建</a></li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                    <div class="dropdown mt20" >
                                        <div class="dropdown-toggle color-white"  id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            医生
                                            <span class="caret pull-right"></span>
                                        </div>                                                         
                                        <ul class="dropdown-menu bg-success" aria-labelledby="dropdownMenu1">
                                            <?php if (Yii::app()->user->checkAccess('Admin.Doctor.Admin')): ?>
                                                <li><a href="<?php echo $this->createUrl('/admin/doctor/index') ?>">搜索</a></li>
                                            <?php endif; ?>
                                            <?php if (Yii::app()->user->checkAccess('Admin.Doctor.Create')): ?>
                                                <li ><a href="<?php echo $this->createUrl('/admin/doctor/createDoctor') ?>">创建医生</a></li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                    <div class="dropdown mt20" >
                                        <div class="dropdown-toggle color-white"  id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            预约-患者
                                            <span class="caret pull-right"></span>
                                        </div>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                            <?php if (Yii::app()->user->checkAccess('Admin.Booking.List')): ?>
                                                <li><a href="<?php echo $this->createUrl('/admin/booking/list') ?>">列表</a></li>
                                            <?php endif; ?>
                                            <?php if (Yii::app()->user->checkAccess('Admin.Booking.Admin')): ?>
                                                <li><a href="<?php echo $this->createUrl('/admin/booking/admin') ?>">搜索</a></li>
                                            <?php endif; ?>
                                    </div> 
                                    <div class="dropdown mt20" >
                                        <div class="dropdown-toggle color-white"  id="dropdownMenu3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            预约-手术直通车
                                            <span class="caret pull-right"></span>
                                        </div>

                                        <ul class="dropdown-menu " aria-labelledby="dropdownMenu3">
                                            <?php if (Yii::app()->user->checkAccess('Admin.Patientbooking.List')): ?>
                                                <li><a href="<?php echo $this->createUrl('/admin/patientbooking/list') ?>">列表</a></li>
                                            <?php endif; ?>
                                            <?php if (Yii::app()->user->checkAccess('Admin.Patientbooking.Admin')): ?>
                                                <li><a href="<?php echo $this->createUrl('/admin/patientbooking/admin') ?>">搜索</a></li>
                                            <?php endif; ?>
                                        </ul>
                                    </div> 
                                    <div class="dropdown mt20" >
                                        <div class="dropdown-toggle color-white"  id="dropdownMenu4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            订单
                                            <span class="caret pull-right"></span>
                                        </div>
                                        <ul class="dropdown-menu bg-success" aria-labelledby="dropdownMenu4">
                                            <?php if (Yii::app()->user->checkAccess('Admin.Order.Index')): ?>
                                                <li><a href="<?php echo $this->createUrl('/admin/order/index') ?>">列表</a></li>  
                                            <?php endif; ?>
                                            <?php if (Yii::app()->user->checkAccess('Admin.Order.Admin')): ?>
                                                <li><a href="<?php echo $this->createUrl('/admin/order/admin') ?>">搜索</a></li>  
                                            <?php endif; ?>
                                            <?php if (Yii::app()->user->checkAccess('Admin.Order.Create')): ?>
                                                <li><a href="<?php echo $this->createUrl('/admin/order/create') ?>">创建</a></li> 
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                    <div class="dropdown mt20" >
                                        <div class="dropdown-toggle color-white"  id="dropdownMenu4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            医生用户
                                            <span class="caret pull-right"></span>
                                        </div>

                                        <ul class="dropdown-menu bg-success" aria-labelledby="dropdownMenu4">
                                            <?php if (Yii::app()->user->checkAccess('Admin.User.Index')): ?>
                                                <li><a href="<?php echo $this->createUrl('/admin/user/index') ?>">列表</a></li>
                                            <?php endif; ?>
                                            <?php if (Yii::app()->user->checkAccess('Admin.User.Admin')): ?>
                                                <li><a href="<?php echo $this->createUrl('/admin/user/admin') ?>">搜索</a></li>     
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                    <div class="dropdown mt20" >
                                        <div class="dropdown-toggle color-white"  id="dropdownMenu4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            消息
                                            <span class="caret pull-right"></span>
                                        </div>

                                        <ul class="dropdown-menu bg-success" aria-labelledby="dropdownMenu4">
                                            <?php if (Yii::app()->user->checkAccess('Admin.AdminMsg.Admin')): ?>
                                                <li><a href="<?php echo $this->createUrl('/admin/adminMsg/admin') ?>">搜索</a></li>    
                                            <?php endif; ?>
                                            <?php if (Yii::app()->user->checkAccess('Admin.AdminMsg.Create')): ?>
                                                <li><a href="<?php echo $this->createUrl('/admin/adminMsg/create') ?>">创建</a></li>  
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                    <div class="dropdown mt20" >
                                        <div class="dropdown-toggle color-white"  id="dropdownMenu4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            平台用户
                                            <span class="caret pull-right"></span>
                                        </div>
                                        <ul class="dropdown-menu bg-success" aria-labelledby="dropdownMenu4">
                                            <?php if (Yii::app()->user->checkAccess('Admin.Adminuser.Admin')): ?>
                                                <li><a href="<?php echo $this->createUrl('/admin/adminuser/admin') ?>">搜索</a></li>   
                                            <?php endif; ?>
                                            <?php if (Yii::app()->user->checkAccess('Admin.Adminuser.Create')): ?>
                                                <li><a href="<?php echo $this->createUrl('/admin/adminuser/create') ?>">创建</a></li>
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
                                        <a href="<?php echo $this->createUrl('/admin/default/logout') ?>">LoginOut(<?php echo Yii::app()->user->name ?>)</a> 
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
                            <div id="content">
                                <?php if ($this->id !== 'install'): ?>
                                    <div id="menu">
                                        <?php $this->renderPartial('//layouts/_menu'); ?>
                                    </div>
                                <?php endif; ?>
                                <?php $this->renderPartial('//layouts/_flash'); ?>
                                <?php echo $content; ?>
                            </div><!-- content -->
                            <style>#content>#menu>ul.actions>li>a{color:#fff;}</style>
                        </div><!-- page -->
                    </div>
                </div>
            </div>
        </section>   
    </body>
</html>
