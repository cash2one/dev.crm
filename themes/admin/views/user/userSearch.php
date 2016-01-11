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
$urlSearch = $this->createAbsoluteUrl('user/ajaxUserSearch');
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
                <option value='2'>否</option>
            </select></td>
        <td>是否签约</td>
        <td><select name='isContracted'>
                <option value=''>全部</option>
                <option value='1'>是</option>
                <option value='2'>否</option>
            </select></td>
    </tr>
</table>
<button id='btnSearch' type='button'>搜索</button>
<?php
echo '<br>----------------------------------------------------查询结果-------------------------------------------------------------------------<br>';
?>

<table>
    <tr>
        <th>ID</th>
        <th>姓名</th>
        <th>手机</th>
        <th>医院</th>
        <th>科室</th>
        <th>临床职称</th>
        <th>学术职称</th>
        <th>认证状态</th>
        <th>签约状态</th>
    </tr>

    <?php
    $this->widget('zii.widgets.CListView', array(
        'dataProvider' => $dataProvider,
        'itemView' => '_viewUserSeachDoctors',
    ));
    ?>
</table>


<script>
    $(document).ready(function () {
        var domForm = $("#searchForm");
        var userViewUrl = "<?php //echo $urlUserView;    ?>";
        var requestUrl = "<?php //echo $urlSearch;    ?>";
        $("#btnSearch").click(function () {
            var searchUrl = requestUrl + '?role=2';
            var formData = new FormData();
            var index = 1;
            domForm.find("input,select").each(function () {
                // trim
                var value = $.trim($(this).val());
                if (value !== '') {
                    searchUrl += '&' + $(this).attr('name') + '=' + value;
                }
            });
            window.location.href = searchUrl;
            console.log(searchUrl);
            //return false;
//            $.ajax({
//                type: 'get',
//                dataType: "json",
//                url: searchUrl,
//                // jsonp: "$callback",
//
//                success: function (data) {
//                    console.log(data);
//                    var results = data['results'];
//                    console.log(results);
//                    var item;
//                    var domUserSearchResultTable = $('#userSearchResultTable');
//                    domUserSearchResultTable.empty();
//                    var resultHtml = "<tr><td>编号</td><td>姓名</td><td>手机</td><td>医院</td><td>科室</td><td>临床职称</td><td>学术职称</td><td>操作</td></tr>";
//                    for (var i = 0, l = results.length; i < l; i++) {
//                        var user = results[i];
//                        item = "<tr><td>" + results[i].id
//                                + "</td><td>" + results[i].name
//                                + "</td><td>" + results[i].mobile
//                                + "</td><td>" + results[i].hpName
//                                + "</td><td>" + results[i].hpDeptName
//                                + "</td><td>" + results[i].cTitle
//                                + "</td><td>" + results[i].aTitle
//                                + "</td><td><a href='" + userViewUrl + "?id=" + user.id + "' target='_blank'>查看<a/></td></tr>";
//                        resultHtml += item;
//                    }
//                    domUserSearchResultTable.html(resultHtml);
//                },
//                error: function (data) {
//                    alert('查询失败,请刷新页面后重新查询');
//                }
//            });
        });
    });
</script>