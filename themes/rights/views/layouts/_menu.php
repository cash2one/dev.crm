<?php $this->widget('zii.widgets.CMenu', array(
	'firstItemCssClass'=>'first',
	'lastItemCssClass'=>'last',
	'htmlOptions'=>array('class'=>'actions'),
	'items'=>array(
		array(
			'label'=>Rights::t('core', 'Assignments'),
			'url'=>array('assignment/view'),
			'itemOptions'=>array('class'=>'item-assignments'),
		),
		array(
			'label'=>Rights::t('core', 'Permissions'),
			'url'=>array('authitem/permissions'),
			'itemOptions'=>array('class'=>'item-permissions'),
		),
		array(
			'label'=>Rights::t('core', 'Roles'),
			'url'=>array('authitem/roles'),
			'itemOptions'=>array('class'=>'item-roles'),
		),
		array(
			'label'=>Rights::t('core', 'Tasks'),
			'url'=>array('authitem/tasks'),
			'itemOptions'=>array('class'=>'item-tasks'),
		),
		array(
			'label'=>Rights::t('core', 'Operations'),
			'url'=>array('authitem/operations'),
			'itemOptions'=>array('class'=>'item-operations'),
		),
	)
));	?>
<style>#menu>.actions>li>a{display:inline-block;padding:8px 10px;margin-bottom:0;font-weight:400;text-align:center;border-radius:4px;background-color:#428bca;border-color:#357ebd;white-space: nowrap;}
#menu>.actions>li{display:inline-block;}</style>