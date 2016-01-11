<style>.button-column a.delete{display:none;}.button-column a.update{display:none;}</style>
<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs = array(
    'Users' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List User', 'url' => array('index')),
);
?>

<h1>Manage UserDoctors</h1>

<?php
$urlSearch = $this->createUrl('user/searchResult');
$urlUserView = $this->createAbsoluteUrl('user/view');
?>

<table id='searchForm'>
    <tr>
        <td>姓名：</td>
        <td><input name='name' value=''></td>
        <td>手机：</td>
        <td><input name='mobile' value=''></td>
    </tr>
    <tr>
        <td>医院：</td>
        <td><input name='hpName' value=''></td>
        <td>科室：</td>
        <td><input name='hpDeptName' value=''></td>
    </tr>
    <tr>
        <td>临床职称</td>
        <td><select name='cTitle'>
                <option value=''>全部</option>
                <option value='1'>主任医师</option>
                <option value='2'>副主任医师</option>
                <option value='3'>主治医师</option>
                <option value='4'>住院医师</option>
            </select></td>
        <td>学术职称</td>
        <td><select name='aTitle'>
                <option value=''>全部</option>
                <option value='1'>教授</option>
                <option value='2'>副教授</option>
                <option value='9'>无</option>
            </select></td>
    </tr>
    <tr>
        <td>是否认证</td>
        <td><select name='isVerified'>
                <option value=''>全部</option>
                <option value='1'>是</option>
                <option value='0'>否</option>
            </select></td>
        <td>是否签约</td>
        <td><select name='isContracted'>
                <option value=''>全部</option>
                <option value='1'>是</option>
                <option value='0'>否</option>
            </select></td>
    </tr>
</table>
<button id='btnSearch' type='button'>搜索</button>
<?php
echo '<br>----------------------------------------------------查询结果-------------------------------------------------------------------------<br>';
?>

<div id="searchResult">   
</div>


<script>
    $(document).ready(function () {
        var selectorSearchResult = '#searchResult';
        var domForm = $("#searchForm");
        var requestUrl = "<?php echo $urlSearch; ?>";


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