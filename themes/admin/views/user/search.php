<style>.button-column a.delete{display:none;}.button-column a.update{display:none;}</style>
<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs = array(
    'Users' => array('admin'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List User', 'url' => array('admin')),
);
?>

<h1>Manage UserDoctors</h1>

<?php
$urlSearch = $this->createUrl('user/searchResult');
$urlUserView = $this->createAbsoluteUrl('user/view');
?>

<div id='searchForm'>
    <div class="form-group col-sm-3">
        <label >姓名</label>
        <div>
            <input class="form-control" name = 'name' value = '' >
        </div>
    </div>
    <div class="form-group col-sm-3">
        <label >手机</label>
        <div>
            <input class="form-control" name = 'mobile' value = '' >
        </div>
    </div>
    <div class="form-group col-sm-3">
        <label >医院</label>
        <div>
            <input class="form-control" name = 'hpName' value = '' >
        </div>
    </div>
    <div class="form-group col-sm-3">
        <label >科室</label>
        <div>
            <input class="form-control" name = 'hpDeptName' value = '' >
        </div>
    </div>
    <div class="form-group col-sm-3">
        <label >临床职称</label>
        <div>
            <select name='cTitle' class="form-control">
                <option value=''>全部</option>
                <option value='1'>主任医师</option>
                <option value='2'>副主任医师</option>
                <option value='3'>主治医师</option>
                <option value='4'>住院医师</option>
            </select>
        </div>
    </div>
    <div class="form-group col-sm-3">
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
    <div class="form-group col-sm-3">
        <label >是否认证</label>
        <div>
            <select name='isVerified' class="form-control">
                <option value=''>全部</option>
                <option value='1'>是</option>
                <option value='0'>否</option>
            </select>
        </div>
    </div>
    <div class="form-group col-sm-3">
        <label >是否签约</label>
        <div>
            <select name='isContracted' class="form-control">
                <option value=''>全部</option>
                <option value='1'>是</option>
                <option value='0'>否</option>
            </select>
        </div>
    </div>

    <div class="form-group col-sm-3">
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
loadUserSearchResult(requestUrl+ '?role=2', selectorSearchResult);

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