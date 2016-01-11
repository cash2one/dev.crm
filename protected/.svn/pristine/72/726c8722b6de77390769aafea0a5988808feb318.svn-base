
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/js/jqueryfileupload/css/blueimp-gallery.min.css">
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/js/colorbox-master/colorbox.css">
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/mr.css">


<?php
//Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/jqueryfileupload/vendor/jquery.ui.widget.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/jqueryfileupload/vendor/tmpl.min.js', CClientScript::POS_END);
//Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/jqueryfileupload/vendor/load-image.all.min.js', CClientScript::POS_END);
//Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/jqueryfileupload/vendor/canvas-to-blob.min.js', CClientScript::POS_END);
//Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/jqueryfileupload/jquery.iframe-transport.js', CClientScript::POS_END);
//Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/jqueryfileupload/jquery.fileupload.js', CClientScript::POS_END);
//Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/jqueryfileupload/jquery.fileupload-process.js', CClientScript::POS_END);
//Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/jqueryfileupload/jquery.fileupload-image.js', CClientScript::POS_END);
//Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/jqueryfileupload/jquery.fileupload-validate.js', CClientScript::POS_END);
//Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/jqueryfileupload/jquery.fileupload-ui.js', CClientScript::POS_END);
//Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/jqueryfileupload/custom.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/colorbox-master/jquery.colorbox.custom.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/wheelzoom.js', CClientScript::POS_END);

/*
  <!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
  <!--[if (gte IE 8)&(lt IE 10)]>
  Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/jqueryfileupload/cors/jquery.xdr-transport.js', CClientScript::POS_END);
  <![endif]-->
 */
//$hideSubmitBtn boolean to indicate hide submit button. use isset($hideSubmitBtn) to check for validity first.
// MedicalRecord.id
$mrid = $model->getId();
// ajax request urls.
$urlLoadFiles = $this->createUrl('medicalRecord/ajaxLoadFiles');
$urlUploadFile = $this->createUrl('medicalRecord/ajaxUploadFile');
$urlDeleteFile = $this->createUrl('medicalRecord/deleteFile');
$urlUpdateFileMeta = $this->createUrl('medicalRecord/ajaxUpdateFileMeta');
// report types.
$report_lab = MedicalRecordFile::REPORT_LAB;
$report_image = MedicalRecordFile::REPORT_IMAGE;
$report_written = MedicalRecordFile::REPORT_WRITTEN;
?>

<div class="clearfix">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" id="report-tab">
        <li class="active"><a href="#report-lab" data-toggle="tab">化验报告</a></li>
        <li><a href="#report-image" data-toggle="tab">影像资料</a></li>
        <li><a href="#report-written" data-toggle="tab">其它报告</a></li>                
    </ul>
</div>

<!-- Tab panes -->
<div class="tab-content form border">
    <div class="tab-pane active" id="report-lab">        
        <!-- The file upload form used as target for the file upload widget -->
        <form class="fileupload" action="<?php echo $urlUploadFile; ?>" method="POST" enctype="multipart/form-data">
            <!-- Redirect browsers with JavaScript disabled to the origin page -->
            <noscript><input type="hidden" name="redirect" value=""></noscript>
            <div class="mr-data">
                <input class="report-type" type="hidden" name="MRFile[report_type]" value="<?php echo $report_lab; ?>">
                <input type="hidden" name="id" value="<?php echo $mrid; ?>">
            </div>
            <div class="file-loading loading loading01 show-on-start"></div>
            <div role="presentation" class="gallery row center-block clearfix">
                <!-- The table listing the files available for upload/download -->
                <div class="files"></div>                
            </div>
        </form>
    </div>

    <div class="tab-pane" id="report-image">       
        <!-- The file upload form used as target for the file upload widget -->
        <form class="fileupload" action="<?php echo $urlUploadFile; ?>" method="POST" enctype="multipart/form-data">
            <!-- Redirect browsers with JavaScript disabled to the origin page -->
            <noscript><input type="hidden" name="redirect" value=""></noscript>
            <div class="mr-data">
                <input type="hidden" name="MRFile[report_type]" value="<?php echo $report_image; ?>">
                <input type="hidden" name="id" value="<?php echo $mrid; ?>">
            </div>
            <div class="file-loading loading loading01 show-on-start"></div>
            <!-- The table listing the files available for upload/download -->
            <div role="presentation" class="gallery row center-block clearfix">
                <!-- The table listing the files available for upload/download -->
                <div class="files"></div>                
            </div>
        </form>
    </div>

    <div class="tab-pane" id="report-written">        
        <!-- The file upload form used as target for the file upload widget -->
        <form class="fileupload" action="<?php echo $urlUploadFile; ?>" method="POST" enctype="multipart/form-data">
            <!-- Redirect browsers with JavaScript disabled to the origin page -->
            <noscript><input type="hidden" name="redirect" value=""></noscript>
            <div class="mr-data">
                <input type="hidden" name="MRFile[report_type]" value="<?php echo $report_written; ?>">
                <input type="hidden" name="id" value="<?php echo $mrid; ?>">
            </div>
            <div class="file-loading loading loading01 show-on-start"></div>
            <!-- The table listing the files available for upload/download -->
            <div role="presentation" class="gallery row center-block clearfix">
                <!-- The table listing the files available for upload/download -->
                <div class="files"></div>
            </div>
        </form>
    </div>
</div>

<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
    {% for (var i=0, file; file=o.files[i]; i++) { %}
    <div class="template-upload fade">
        <div class="file-holder gallery-cell gallery-preview col-sm-6 col-md-4 mb20 text-center">            
            <div class="gallery-cell-inner">               
                <div class="gallery-image"><span class="preview thumbnail"></span></div>
                <div>
                    <strong class="error text-danger"></strong>
                </div>
                <div>
                    <p class="size">上传中...</p>
                    <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
                </div>
                <div class="btn-holder">
                    {% if (!i && !o.options.autoUpload) { %}
                    <button class="btn btn-primary btn-sm btn-block start" disabled>
                        <i class="glyphicon glyphicon-upload"></i>
                        <span>开始</span>
                    </button>
                    {% } %}
                    {% if (!i) { %}
                    <button class="btn btn-warning btn-sm btn-block cancel">
                        <i class="glyphicon glyphicon-ban-circle"></i>
                        <span>取消</span>
                    </button>
                    {% } %}
                </div>
            </div>
        </div>
        <!-- /- file-holder -->
    </div>

    {% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
    {% for (var i=0, file; file=o.files[i]; i++) { %}
    <div class="file-holder gallery-cell col-sm-6 col-md-4 mb20">
        <input type="hidden" name="fileId" value="{%=file.id%}" />
        <input type="hidden" name="mrId" value="{%=file.mrId%}" />
        <div class="gallery-cell-inner">
            <div class="loading"></div>           
            <div class="gallery-image"><div class="gallery-image-controls"><a class="control-popup" href="{%=file.fileUrl%}"><i class="fa fa-search"></i></a><a class="control-dl" href="{%=file.fileUrl%}" download><i class="fa fa-download"></i></a></div>
                <img class="center-block" src="{%=file.thumbnailUrl%}" data-hd-src="{%=file.fileUrl%}"/></div>
            <div><input type="text" name="fileDate" value="{%=file.fileDate%}" placeholder="日期" class="form-control-static pull-right gallery-image-date form-control datepicker" data-date-format="yyyy-mm-dd" readonly /><textarea name="fileDesc" class="gallery-image-desc form-control" maxlength="50" rows="3" placeholder="" readonly>{%=file.fileDesc%}</textarea></div>
        </div>
    </div>   
    {%}%}
</script>

<script>       
    $(document).ready(function(){
        initFiles();
        $('#report-tab a').click(function (e) {
            e.preventDefault()
            $(this).tab('show')
        })        
    });
    
    function initFiles(){
        $("form.fileupload").each(function(){
            var domForm = $(this);
            var mrid = domForm.find("input[name='id']").val();
            var reportType = domForm.find("input[name='MRFile[report_type]']").val();           
            
            $.ajax({ 
                type:'get',
                dataType: "json",
                url: "<?php echo $urlLoadFiles; ?>"+"?id="+mrid +"&rt="+reportType + "&tmpl=1",
                beforeSend:function(){
                    $(".loading").show();
                },
                success: function( data ) {
                    data.init=true; //indicate its initial loading.      
                    domForm.find(".files").html(tmpl("template-download", data));    
                   
                    myhzBindFileActionEvents(domForm.find(".files .file-holder"));                   
                },
                complete:function(){
                    $(".loading").hide();
                }
            });       
        });
        
    }
    function myhzBindFileActionEvents($domFH){                        
        $domFH.find(".gallery-image-controls>.control-popup").click(function(e){        
            e.preventDefault();            
            // $(this).parents(".gallery").find(".gallery-cell .control-popup").colorbox({
            $(this).colorbox({
                //$(this).colorbox({		
                overlayClose:false,
                caption:function(){return "\u76f8\u5173\u63cf\u8ff0："+$(this).parents(".file-holder").find("textarea[name='fileDesc']").val();},   //相关描述
                date:function(){return "\u65e5\u671f："+$(this).parents(".file-holder").find("input[name='fileDate']").val();}, //日期
                rel:"img-data", 
                transition:"none", 
                width:"90%",
                height:"100%",
                onComplete:function(){wheelzoom(document.querySelector("#colorbox .cboxPhoto"));},
                onClosed:function(){$(this).colorbox.remove();}
            });
										
        });

    }          
</script>