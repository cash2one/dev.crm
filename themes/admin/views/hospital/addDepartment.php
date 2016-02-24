<?php
/* @var $this HospitalController */
/* @var $model Hospital */
/* @var $fhJoin FacultyHospitalJoin */

$this->breadcrumbs = array(
    'Hospitals' => array('admin'),
    $model->name,
);

$this->menu = array(
    array('label' => 'View Hospital', 'url' => array('view', 'id' => $model->id)),
    array('label' => 'List Hospital', 'url' => array('index')),
);
?>

<h4>添加科室</h4>
<h3><?php echo $model->name; ?></h3>

<br />

<h4>已添加的科室：</h4>
<div class="faculty-list">
    <?php
    $deptList = $model->loadOptionsHospitalDepartment();
    $jsonDeptList = CJSON::encode($deptList);
    if (emptyArray($deptList) === false) {
        foreach ($deptList as $dept => $value) {
            echo '<div class="department">' . $value . '</div>';
        }
    }
    ?>
</div>

<br />
<?php $this->renderPartial('_formAddDepartment', array('model' => $model)); ?>
<script>
    $(document).ready(function () {
        $('.deleteDepartment').click(function (e) {
            e.preventDefault();
            var deptHtml = $(this).parents('.department');
            if (confirm('确定删除此科室?')) {
                var url = $(this).attr('href');
                $.ajax({
                    url: url,
                    success: function (data) {
                        if (data.status == true) {
                            deptHtml.remove();
                            alert('删除成功!');
                        } else {
                            alert('删除失败!' + data.error);
                        }
                    }
                });
            }

        });
    });
</script>
