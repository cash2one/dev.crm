<?php
/* @var $this SalesOrderController */
/* @var $model SalesOrder */

$this->breadcrumbs = array(
    '订单' => array('index'),
    '订单搜索',
);

$this->menu = array(
    array('label' => '订单列表', 'url' => array('index')),
//    array('label' => 'Create SalesOrder', 'url' => array('create')),
);
?>

<h1>订单搜索</h1>
<?php
$urlSearch = $this->createUrl('sms/searchResult');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . "/js/bootstrap-datepicker/css/bootstrap-datepicker.css");
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/bootstrap-datepicker/bootstrap-datepicker.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/bootstrap-datepicker/bootstrap-datepicker.zh-CN.js', CClientScript::POS_END);
?>

<div id = 'searchForm'>
    <div class="form-group col-sm-2">
        <label >客服</label>
        <div>
            <select name="adminUserId" class="form-control">
                <option value="">选择</option>
                <?php
                $adminUser = AdminBooking::model()->getAdminUserList();
                foreach ($adminUser as $key => $value) {
                    echo '<option value="' . $key . '">' . $value . '</option>';
                }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group col-sm-2">
        <label >手机</label>
        <div>
            <input class="form-control" name = 'mobile' value = '' >
        </div>
    </div>
    <div class="form-group col-sm-2">
        <label >内容</label>
        <div>
            <input class="form-control" name = 'content' value = '' >
        </div>
    </div>
    <div class="form-group col-sm-2">
        <label >是否成功</label>
        <div>
            <select name = 'isSuccess' class="form-control">
                <option value = ''>全部</option>
                <option value = '1'>是</option>
                <option value = '0'>否</option>
            </select>
        </div>
    </div>
    <div class="form-group col-sm-2">
        <label >创建开始时间</label>
        <div>
            <input class="form-control dateOpen" name = 'dateOpenStart' value = '' placeholder="yyyy-MM-dd">
        </div>
    </div>
    <div class="form-group col-sm-2">
        <label >创建结束时间</label>
        <div>
            <input class="form-control dateOpen" name = 'dateOpenEnd' value = '' placeholder="yyyy-MM-dd">
        </div>
    </div>
    <div class="form-group col-sm-2 mt24">
        <button id = 'btnSearch' type="submit" class="btn btn-primary">搜索</button>
    </div>
</div>
<div class="clearfix"></div>
<div id="countAmount"></div>
<div id="searchResult" class="mt10">   
</div>
<style>
    #searchResult .table td{word-break: break-all; word-wrap:break-word;min-width: 5em;max-width: 50em;vertical-align: middle;}
</style>

<script>
    $(document).ready(function () {
        $(".dateOpen").datepicker({
            //startDate: "+1d",
            //todayBtn: true,
            autoclose: true,
            maxView: 2,
            //todayHighlight: true,
            pickerPosition: "bottom-left",
            format: "yyyy-mm-dd",
            language: "zh-CN"
        });
        $(".dateClosed").datepicker({
            //startDate: "+1d",
            //todayBtn: true,
            autoclose: true,
            maxView: 2,
            //todayHighlight: true,
            pickerPosition: "bottom-left",
            format: "yyyy-mm-dd",
            language: "zh-CN"
        });
        var selectorSearchResult = '#searchResult';
        var domForm = $("#searchForm");
        var requestUrl = "<?php echo $urlSearch; ?>";
        loadUserSearchResult(requestUrl + '?he=2', selectorSearchResult);

        $("#btnSearch").click(function () {
            var searchUrl = requestUrl + '?he=2';
            domForm.find("input,select").each(function () {
                // trim
                var value = $.trim($(this).val());
                if (value !== '') {
                    searchUrl += '&' + $(this).attr('name') + '=' + value;
                    countUrl += '&' + $(this).attr('name') + '=' + value;
                }
            });
            loadUserSearchResult(searchUrl, selectorSearchResult);
        });

    });
    function loadUserSearchResult(requestUrl, selectorSearchResult) {
        $.ajax({
            url: requestUrl,
            async: false,
            success: function (data) {
                $(selectorSearchResult).html(data);
            },
            complete: function () {
                // hide loading gif.
            }
        });
    }
</script>




