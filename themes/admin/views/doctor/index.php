<style type="text/css">
    .view .dr-avatar{margin-left:1em;margin-bottom:1em;width:100px;float:right;clear:both;}
    .view .dr-avatar>img{width:100%;}
</style>

<?php
/* @var $this DoctorController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    '医生列表',
);

$this->menu = array(
    array('label' => 'Create Doctor', 'url' => array('createDoctor')),
    array('label' => 'Manage Doctor', 'url' => array('admin')),
);
?>

<h1>医生列表</h1>
<style>
    .data-list, .list-view {position: relative;}
    .pager {margin: 0;}
</style>
<div class="data-list mt10">
    <table class="table">
        <thead>
            <tr>
                <td>ID</td>
                <td>姓名</td>
                <td>职称</td>
                <td>所属医院</td>
                <td>所属科室</td>
                <td>手机</td>
                <td>是否签约</td>
                <td>是否是牛人榜</td>
                <td>创建时间</td>
            </tr>
        </thead>
        <tbody>
            <?php
            $this->widget('zii.widgets.CListView', array(
                'dataProvider' => $dataProvider,
                'itemView' => '_view',
            ));
            ?>
        </tbody>
    </table>
</div>
<style>.list-view{position:relative;}</style>
