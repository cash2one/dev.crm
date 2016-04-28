<style>.button-column a.delete{display:none;}.button-column a.update{display:none;}</style>
<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs = array(
    '医生' => array('admin'),
    '搜索',
);

$this->menu = array(
    array('label' => 'List User', 'url' => array('admin')),
);
?>

<h1>医生搜索</h1>

<?php
$urlSearch = $this->createUrl('doctor/searchResult');
$urlUserView = $this->createAbsoluteUrl('doctor/view');
$urlLoadCity = $this->createUrl('region/loadCities');
?>

<div id='searchForm'>
    <div class="form-group col-sm-2">
        <label >姓名</label>
        <div>
            <input class="form-control" name = 'name' value = '' >
        </div>
    </div>
    <div class="form-group col-sm-2">
        <label >手机</label>
        <div>
            <input class="form-control" name = 'mobile' value = '' >
        </div>
    </div>
    <div class="form-group col-sm-2">
        <label >医院</label>
        <div>
            <input class="form-control" name = 'hpName' value = '' >
        </div>
    </div>
    <div class="form-group col-sm-2">
        <label >科室</label>
        <div>
            <input class="form-control" name = 'hpDeptName' value = '' >
        </div>
    </div>
    <div class="form-group col-sm-2">
        <label >临床职称</label>
        <div>
            <select name='mTitle' class="form-control">
                <option value=''>全部</option>
                <option value='1'>主任医师</option>
                <option value='2'>副主任医师</option>
                <option value='3'>主治医师</option>
                <option value='4'>住院医师</option>
            </select>
        </div>
    </div>
    <div class="form-group col-sm-2">
        <label >学术职称</label>
        <div>
            <select name='aTitle' class="form-control">
                <option value=''>全部</option>
                <option value='1'>教授</option>
                <option value='2'>副教授</option>
                <option value='9'>无</option>
            </select>
        </div>
    </div>
    <div class="form-group col-sm-2">
        <label >省份</label>
        <div>
            <select id="state" name="state" class="form-control">
                <option value="">选择省份</option>
                <option value="1">北京</option>
                <option value="2">天津</option>
                <option value="3">河北</option>
                <option value="4">山西</option>
                <option value="5">内蒙古</option>
                <option value="6">辽宁</option>
                <option value="7">吉林</option>
                <option value="8">黑龙江</option>
                <option value="9">上海</option>
                <option value="10">江苏</option>
                <option value="11">浙江</option>
                <option value="12">安徽</option>
                <option value="13">福建</option>
                <option value="14">江西</option>
                <option value="15">山东</option>
                <option value="16">河南</option>
                <option value="17">湖北</option>
                <option value="18">湖南</option>
                <option value="19">广东</option>
                <option value="20">广西</option>
                <option value="21">海南</option>
                <option value="22">重庆</option>
                <option value="23">四川</option>
                <option value="24">贵州</option>
                <option value="25">云南</option>
                <option value="26">西藏</option>
                <option value="27">陕西</option>
                <option value="28">甘肃</option>
                <option value="29">青海</option>
                <option value="30">宁夏</option>
                <option value="31">新疆</option>
                <option value="32">台湾</option>
                <option value="33">香港</option>
                <option value="34">澳门</option>
            </select>
        </div>
    </div>
    <div class="form-group col-sm-2">
        <label >城市</label>
        <div>
            <select id="city" name="city" class="form-control">
                <option value="">选择城市</option>
            </select>
        </div>
    </div>

    <div class="form-group col-sm-2 mt24">
        <button id = 'btnSearch' type="button" class="btn btn-primary">搜索</button>
    </div> 
    <div class="clearfix"></div>
</div>
<div id="searchResult">   
</div>
<script>
    $(document).ready(function () {
        var selectorSearchResult = '#searchResult';
        var domForm = $("#searchForm");
        var requestUrl = "<?php echo $urlSearch; ?>";
        loadUserSearchResult(requestUrl + '?role=2', selectorSearchResult);

        $("#btnSearch").click(function () {
            var searchUrl = requestUrl + '?role=2';
            domForm.find("input,select").each(function () {
                // trim
                var value = $.trim($(this).val());
                if (value !== '') {
                    searchUrl += '&' + $(this).attr('name') + '=' + value;
                }
            });
            loadUserSearchResult(searchUrl, selectorSearchResult);
        });

        $("select#state").change(function () {
            $("select#city").attr("disabled", true);
            var stateId = $(this).val();
            var actionUrl = "<?php echo $urlLoadCity; ?>";// + stateId + "&prompt=选择城市";
            $.ajax({
                type: 'get',
                url: actionUrl,
                data: {'state': this.value, 'prompt': '选择城市'},
                cache: false,
                // dataType: "html",
                'success': function (data) {
                    $("select#city").html(data);
                },
                'error': function (data) {
                },
                complete: function () {
                    $("select#city").attr("disabled", false);
                }
            });
            return false;
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