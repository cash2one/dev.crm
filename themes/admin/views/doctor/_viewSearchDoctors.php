
<?php
$doctor = new stdClass();

$doctor->name = $data->getName();
$doctor->mobile = $data->getMobile();
$doctor->hospital_name = $data->getHospitalName();
$doctor->hp_dept_name = $data->getHpDeptName();
$doctor->clinical_title = $data->getMedicalTitle();
$doctor->academic_title = $data->getAcademicTitle();
$doctor->state_name = $data->getStateName();
$doctor->city_name = $data->getCityName();
?>

<tr>
    <td><a target="_blank" href="<?php echo $this->createUrl('doctor/view', array('id' => $data->id)) ?>"><?php echo $data->id; ?></a></td>
    <td><a target="_blank" href="<?php echo $this->createUrl('doctor/view', array('id' => $data->id)) ?>"><?php echo $doctor->name; ?></a></td>
    <td><?php echo $doctor->hospital_name; ?></td>
    <td><?php echo $doctor->hp_dept_name; ?></td>
    <td><?php echo $doctor->clinical_title; ?></td>
    <td><?php echo $doctor->academic_title; ?></td>
    <td><a target="_blank" href="<?php echo $this->createUrl('doctor/view', array('id' => $data->id)) ?>">查看</a></td>
</tr>

