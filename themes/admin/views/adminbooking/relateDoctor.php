<h1>关联医生 </h1>
<?php
/* @var $this PatientbookingController */
/* @var $model PatientBooking */

//$urlAddDoctorToBooking= $this->createUrl('admin/patientbooking/relate', array('bid'=>$bid));

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#patient-booking-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php

$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'patient-booking-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'user_id',
        'name',
        'hospital_name',
        'hp_dept_name',
//        array(
//            'class' => 'CButtonColumn',
//            'template' => '{relate}',
//            'buttons' => array(
//                'relate' => array(
//                    'label' => '[选择]',
//                    'url'=>'Yii::app()->createUrl("admin/patientbooking/relate", array("userid"=>$data->user_id))',
//                ),
//            ),
//        ),
        array(
            'class'=>'CLinkColumn',
            'labelExpression' => '"选择"',
           'urlExpression' => 'array("adminBooking/relate", "bid" =>'. $bid .', "userid" => $data->user_id, "name" => $data->name)',
//            'url'=>"javascript:addDoctorToBooking(<?php echo $data->user_id;);"
        ),
    ),
));

?>
<!--<script type="text/javascript">
function addDoctorToBooking($userid){
    var r = confirm("确定关联这个医生吗？");
    if (r == true){
        var url = "<php echo $urlAddDoctorToBooking;>" + "?userid="+$userid;
        window.location.href = url;
    }
}
</script>-->