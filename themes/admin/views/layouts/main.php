<!DOCTYPE html>
<html lang="zh" xmlns="http://www.w3.org/1999/xhtml" dir="ltr">

    <?php
//    $this->widget('zii.widgets.CMenu', array(
//        'items' => array(
//            array('label' => '首页', 'url' => array('/admin/default/index')),
//            //    array('label' => '医院', 'url' => array('/admin/hospital/index'), 'visible' => !Yii::app()->user->isGuest),
//            array('label' => '医生', 'url' => array('/admin/doctor/index'), 'visible' => !Yii::app()->user->isGuest),
//            //     array('label' => '科室', 'url' => array('/admin/faculty/index'), 'visible' => !Yii::app()->user->isGuest),
//            array('label' => '预约-患者', 'url' => array('/admin/booking/list'), 'visible' => !Yii::app()->user->isGuest),
//            array('label' => '预约-手术直通车', 'url' => array('/admin/patientbooking/list'), 'visible' => !Yii::app()->user->isGuest),
//            array('label' => '医生认证', 'url' => array('/admin/user/listdoctors'), 'visible' => !Yii::app()->user->isGuest),
//            //   array('label' => '病历', 'url' => array('/admin/medicalrecord/index'), 'visible' => !Yii::app()->user->isGuest),
//            //   array('label' => '预约', 'url' => array('/admin/mrbooking/index'), 'visible' => !Yii::app()->user->isGuest),
//            //    array('label' => '用户', 'url' => array('/admin/user/index'), 'visible' => !Yii::app()->user->isGuest),
//            array('label' => 'Login', 'url' => array('/admin/default/login'), 'visible' => Yii::app()->user->isGuest),
//            array('label' => '患者', 'url' => array('/admin/patientinfo/index'), 'visible' => !Yii::app()->user->isGuest),
//            array('label' => 'Logout (' . Yii::app()->user->name . ')', 'url' => array('/admin/default/logout'), 'visible' => !Yii::app()->user->isGuest)
//        ),
//    ));
    ?>
    <!--                </div> mainmenu 
                    <div class="container">-->
    <?php //if (isset($this->breadcrumbs)): ?>
    <!--                                                                    <div class="row">
                                                                        <div class="col-sm-8 col-sm-offset-1">-->
    <?php
    // $this->widget('zii.widgets.CBreadcrumbs', array(
    //    'links' => $this->breadcrumbs,
    //   ));
    ?> 
    <!--                                                                    </div>
                                                                        </div>-->
    <?php //endif ?>
    <head>
        <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
            <meta name="viewport" content="width=device-width, initial-scale=1"/>
            <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
            <title>后台管理系统</title>
            <link rel="shortcut icon" type="image/ico" href="http://www.mingyizhudao.com/themes/v4/images/icons/favicon.ico"/>
            <!-- Bootstrap -->
            <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.min.css" />
            <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/basic.css" />
            <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/crm.css" />                   
            <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery-1.9.1.min.js"></script>
            <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/bootstrap.min.js"></script>
    </head>	
    <body>
      <script>
       $(document).ready(function(){
//        $(".dropdown-toggle").dropdown('toggle');
//       $(".dropdown-menu li a").click(function(){
//           var $url=$(this).attr("href");
//           var ss;
//           ss=$url.substr(0, $url.indexOf('/'));
//           alert(ss);
       });
   });
</script>
        <section id="body">
            <div class="container-fluid">
                <nav class="navbar navbar-default" role="navigation">
                    <h3>后台管理系统</h3>
                    <div class="">
                        <!-- Brand and toggle get grouped for better mobile display -->
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
                                            医院
                                            <span class="caret pull-right"></span>
                                        </div>                                                         
                                        <ul class="dropdown-menu bg-success" aria-labelledby="dropdownMenu1">
                                            <li><a href="<?php echo $this->createUrl('hospital/admin') ?>">搜索</a></li>
                                            <li ><a href="<?php echo $this->createUrl('hospital/create') ?>">创建</a></li>
                                        </ul>
                                    </div>
                                    <div class="dropdown mt20" >
                                        <div class="dropdown-toggle color-white"  id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            医生
                                            <span class="caret pull-right"></span>
                                        </div>                                                         
                                        <ul class="dropdown-menu bg-success" aria-labelledby="dropdownMenu1">

                                            <li><a href="<?php echo $this->createUrl('doctor/admin') ?>">搜索</a></li>
                                            <li ><a href="<?php echo $this->createUrl('doctor/create') ?>">创建医生</a></li>
                                        </ul>
                                    </div>

                                    <div class="dropdown mt20" >
                                        <div class="dropdown-toggle color-white"  id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            预约-患者
                                            <span class="caret pull-right"></span>
                                        </div>

                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                            <li><a href="<?php echo $this->createUrl('booking/admin') ?>">搜索</a></li>
                                    </div> 
                                    <div class="dropdown mt20" >
                                        <div class="dropdown-toggle color-white"  id="dropdownMenu3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            预约-手术直通车
                                            <span class="caret pull-right"></span>
                                        </div>

                                        <ul class="dropdown-menu " aria-labelledby="dropdownMenu3">
                                            <li><a href="<?php echo $this->createUrl('patientbooking/admin') ?>">搜索</a></li>
                                        </ul>
                                    </div> 
                                    <div class="dropdown mt20" >
                                        <div class="dropdown-toggle color-white"  id="dropdownMenu4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            订单
                                            <span class="caret pull-right"></span>
                                        </div>

                                        <ul class="dropdown-menu bg-success" aria-labelledby="dropdownMenu4">
                                            <li><a href="<?php echo $this->createUrl('order/admin') ?>">搜索</a></li>  
                                             <li><a href="<?php echo $this->createUrl('order/create') ?>">创建</a></li> 
                                        </ul>
                                    </div>
                                    <div class="dropdown mt20" >
                                        <div class="dropdown-toggle color-white"  id="dropdownMenu4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            医生用户
                                            <span class="caret pull-right"></span>
                                        </div>

                                        <ul class="dropdown-menu bg-success" aria-labelledby="dropdownMenu4">
                                            <li><a href="<?php echo $this->createUrl('user/admin') ?>">搜索</a></li>                                                             
                                        </ul>
                                    </div>
                                    <div class="dropdown mt20" >
                                        <div class="dropdown-toggle color-white"  id="dropdownMenu4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            消息
                                            <span class="caret pull-right"></span>
                                        </div>

                                        <ul class="dropdown-menu bg-success" aria-labelledby="dropdownMenu4">
                                            <li><a href="<?php echo $this->createUrl('adminMsg/admin') ?>">搜索</a></li>    
                                            <li><a href="<?php echo $this->createUrl('adminMsg/create') ?>">创建</a></li>  
                                        </ul>
                                    </div>
                                    <div class="dropdown mt20" >
                                        <div class="dropdown-toggle color-white"  id="dropdownMenu4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            平台用户
                                            <span class="caret pull-right"></span>
                                        </div>

                                        <ul class="dropdown-menu bg-success" aria-labelledby="dropdownMenu4">
                                            <li><a href="<?php echo $this->createUrl('adminuser/admin') ?>">搜索</a></li>    
                                            <li><a href="<?php echo $this->createUrl('adminuser/create') ?>">创建</a></li>  
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
                </div>
            </div>
            </div>
        </section>                     

    </body>
</html>

