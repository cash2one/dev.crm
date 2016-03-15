<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/qiniu/highlight.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/qiniu/main.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/qiniu/plupload.full.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/qiniu/zh_CN.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/qiniu/ui.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/qiniu/qiniu.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/qiniu/highlight.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/doctorcert.js', CClientScript::POS_END);
?>
<div class="form-wrapper mt20">
    <div class="mb20 row">
        <div class="col-sm-12">
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
</div>