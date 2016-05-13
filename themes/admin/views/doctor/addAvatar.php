<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/qiniu/highlight.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/qiniu/main.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/qiniu/plupload.full.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/qiniu/zh_CN.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/qiniu/ui.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/qiniu/qiniu.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/qiniu/highlight.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/doctorAvatar.js?v=' . time(), CClientScript::POS_END);

/* @var $this DoctorController */
/* @var $doctor Doctor */
/* @var $model DoctorAvatar */
/* @var $form CActiveForm */

$this->breadcrumbs = array(
    '医生' => array('admin'),
    $doctor->getName() => array('view', 'id' => $doctor->getId()),
);

$this->menu = array(
//    array('label' => '查看', 'url' => array('view', 'id' => $doctor->id)),
//    array('label' => 'List Doctor', 'url' => array('index')),
//    array('label' => 'Create Doctor', 'url' => array('create')),
//    array('label' => 'Update Doctor', 'url' => array('update', 'id' => $doctor->id)),
//    array('label' => 'Delete Doctor', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $doctor->id), 'confirm' => 'Are you sure you want to delete this item?')),
//    array('label' => 'Manage Doctor', 'url' => array('admin')),
);
$urlUploadFile = $this->createUrl("doctor/ajaxSaveAvatarFile");

$urlReturn = $this->createUrl('doctor/view', array('id' => $doctor->getId()));
?>
<h2>设置头像</h2>
<h3><?php echo $doctor->getName(); ?></h3>
<div>
    <?php
    if (strIsEmpty($doctor->avatar_url) == false) {
        echo CHtml::Image($doctor->getAbsUrlAvatar(false), $doctor->getName(), array('title' => $doctor->getName()));
    }
    ?>
</div>

<div class="form">

    <form id="doctor-form" data-url-uploadfile="<?php echo $urlUploadFile; ?>" data-url-return="<?php echo $urlReturn; ?>">
        <input id="doctorId" type="hidden" name="doctor[id]" value="<?php echo $doctor->getId(); ?>" />
        <input type="hidden" id="domain" value="http://7xtetc.com1.z0.glb.clouddn.com/"> 
        <input type="hidden" id="uptoken_url" value="<?php echo $this->createUrl('doctor/ajaxUpload'); ?>">
    </form>
    <div class="mb20 row mt20">
        <div class="">
            <div class="body">
                <div class="col-md-12">
                    <div id="container">
                        <a class="btn btn-default btn-lg " id="pickfiles" href="#" >
                            <i class="glyphicon glyphicon-plus"></i>
                            <span>选择文件</span>
                        </a>
                    </div>
                </div>
                <div style="display:none" id="success" class="col-md-12">
                    <div class="alert-success">
                        队列全部文件处理完毕
                    </div>
                </div>
                <div class="col-md-12 ">
                    <table class="table table-striped table-hover text-left"   style="margin-top:40px;display:none">
                        <thead>
                            <tr>
                                <th class="col-md-4">Filename</th>
                                <th class="col-md-2">Size</th>
                                <th class="col-md-6">Detail</th>
                            </tr>
                        </thead>
                        <tbody id="fsUploadProgress">
                        </tbody>
                    </table>
                </div>
                <div>
                    <button id="btnSubmit" class="btn btn-primary">上传</button>
                </div>
            </div>
        </div>
    </div>

</div><!-- form -->