<?php
Yii::app()->clientScript->registerCssFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/webuploader/css/webuploader.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/js/webuploader/css/webuploader.custom.css');
Yii::app()->clientScript->registerScriptFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/mobile/js/webuploader/js/webuploader.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/uploadsummary.js', CClientScript::POS_END);
?>
<style>
    #uploader .filelist>li{clear: none;}
</style>
<div id="uploader" class="mt20 uploader">
    <div class="imglist">
        <ul class="filelist"></ul>
    </div>
    <div class="queueList">
        <div id="dndArea" class="placeholder">
            <!-- btn 选择图片 -->
            <div id="filePicker"></div>
        <!-- <p>或将照片拖到这里，单次最多可选10张</p>-->
        </div>
    </div>
    <div class="statusBar clearfix" style="display:none;">
        <div class="progress" style="display: none;">
            <span class="text">0%</span>
            <span class="percentage" style="width: 0%;"></span>
        </div>
        <div class="info">共0张（0B），已上传0张</div>
        <div class="">
            <!-- btn 继续添加 -->
            <div id="filePicker2" class=""></div>                          

        </div>
        <div class="mt40 clearfix">
<!--                                <input id="btnSubmit" class="statusBar uploadBtn btn btn-yes btn-block" type="button" name="yt0" value="提交">-->
            <button id="btnSubmit" class="statusBar uploadBtn btn btn-primary col-sm-4 col-sm-offset-1">提交</button>
            <!--                <button id="btnSubmit" type="button" class="statusBar state-pedding">提交</button>-->
        </div>
    </div>
    <!--一开始就显示提交按钮就注释上面的提交 取消下面的注释 -->
</div>