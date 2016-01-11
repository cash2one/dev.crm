<!DOCTYPE html>
<html lang="zh" xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>                
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta charset="utf-8" />
        <meta http-equiv="cache-control" content="no-cache" />
        <meta http-equiv="expires" content="0" />
        <meta http-equiv="pragma" content="no-cache" />
        <link rel="shortcut icon" type="image/ico" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/icons/favicon.ico" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/font-awesome.min.css" />
        <!-- blueprint CSS framework -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/screen.css" media="screen, projection" />        
        <!--[if lt IE 8]>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/ie.css" media="screen, projection" />
        <![endif]-->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/main.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/form.css" />        

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>

    <body>

        <div class="container" id="page">

            <div id="header">
                <div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
            </div><!-- header -->
            <div id="mainmenu">
                <?php
                $this->widget('zii.widgets.CMenu', array(
                    'items' => array(
                        array('label' => '首页', 'url' => array('/admin/default/index')),
                        array('label' => '医院', 'url' => array('/admin/hospital/index'), 'visible' => !Yii::app()->user->isGuest),
//                        array('label' => '科室', 'url' => array('/admin/faculty/index'), 'visible' => !Yii::app()->user->isGuest),
                        array('label' => '医生', 'url' => array('/admin/doctor/index'), 'visible' => !Yii::app()->user->isGuest),
                        array('label' => '预约-患者', 'url' => array('/admin/booking/list'), 'visible' => !Yii::app()->user->isGuest),
                        array('label' => '预约-手术直通车', 'url' => array('/admin/patientbooking/list'), 'visible' => !Yii::app()->user->isGuest),
                        array('label' => '订单', 'url' => array('/admin/order/index'), 'visible' => !Yii::app()->user->isGuest),
                        array('label' => '医生用户', 'url' => array('/admin/user/listdoctors'), 'visible' => !Yii::app()->user->isGuest),
			array('label' => '消息', 'url' => array('/admin/adminMsg/index'), 'visible' => !Yii::app()->user->isGuest),
                        //   array('label' => '病历', 'url' => array('/admin/medicalrecord/index'), 'visible' => !Yii::app()->user->isGuest),
                        //   array('label' => '预约', 'url' => array('/admin/mrbooking/index'), 'visible' => !Yii::app()->user->isGuest),
                        //   array('label' => '用户', 'url' => array('/admin/user/index'), 'visible' => !Yii::app()->user->isGuest),
                        array('label' => 'Login', 'url' => array('/admin/default/login'), 'visible' => Yii::app()->user->isGuest),
                        array('label' => 'Logout (' . Yii::app()->user->name . ')', 'url' => array('/admin/default/logout'), 'visible' => !Yii::app()->user->isGuest)
                    ),
                ));
                ?>
            </div><!-- mainmenu -->
            <div>
                <?php if (isset($this->breadcrumbs)): ?>
                    <?php
                    $this->widget('zii.widgets.CBreadcrumbs', array(
                        'links' => $this->breadcrumbs,
                    ));
                    ?><!-- breadcrumbs -->
                <?php endif ?>

                <?php echo $content; ?>

                <div class="clear"></div>
            </div>
            <div id="footer"></div>
            <!-- footer -->

        </div><!-- page -->

    </body>
</html>
