<?php
$urlAjaxLoadloadHospitalDept = $this->createUrl('doctor/ajaxLoadloadHospitalDept', array('hid' => ''));
$urlSearchHospital = $this->createUrl('hospital/searchResult');
?>
<div class="modal fade mt100" id="hospitalSearchModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center">搜索医院</h4>
            </div>
            <div class="modal-body">
                <form id="searchHp-form" class="form-inline text-center">
                    <div class="form-group">
                        <label class="control-label">医院名</label>
                        <input class="form-control" name="hpName" id="Hospital_hpName" type="text">
                        <button id="searchHp" type="button" class="btn btn-primary">搜索</button>
                    </div>

                </form>
                <div class="mt20">
                    <h4 class="strong">展示结果:</h4>
                    <div id="hpList" class="row">

                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
    $(document).ready(function () {
        $('#searchHp').click(function () {
            ajaxLoadHospital();
        });
        //搜索回车操作
        $('#Hospital_hpName').keydown(function (event) {
            if (event.keyCode == "13") {
                event.preventDefault();
                ajaxLoadHospital();
            }
        });
    });
    function ajaxLoadHospital() {
        $.ajax({
            url: '<?php echo $urlSearchHospital; ?>',
            data: $('#searchHp-form').serialize(),
            success: function (data) {
                setHpHtml(data);
            }
        });
    }
    function setHpHtml(hospitals) {
        var innerHtml = '';
        if (hospitals && hospitals.length > 0) {
            for (var i = 0; i < hospitals.length; i++) {
                var hospital = hospitals[i];
                innerHtml += '<div class="col-sm-6"><span><a class="determineHp" data-id="' + hospital.id + '" data-hpName="' + hospital.name + '" href="javascript:void(0);">' + hospital.name + '</a></span></div>';
            }
        } else {
            innerHtml += '<div class="col-sm-12">未查询到结果</div>';
        }
        $('#hpList').html(innerHtml);
        initHpClick();
    }
    
</script>