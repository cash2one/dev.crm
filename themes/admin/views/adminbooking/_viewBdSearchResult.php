<?php
$pbOrder = isset($data->orderAdminbooking) ? $data->orderAdminbooking : null;
$doctorMobile = isset($data->bkOwner) ? $data->bkOwner->username : '无';
//var_dump($data);
//print_r(CJSON::encode($data));exit;
?>
<?php if (count($pbOrder) == 0) { ?>
    <tr>
        <td ><?php echo $data->bd_user_name; ?></td>
        <td ><a target="_blank" href="<?php echo $this->createUrl('bdBkView', array('id' => $data->id)) ?>" ><?php echo $data->ref_no; ?></a></td>
        <td ><?php echo $data->patient_name; ?></td>
        <td ><?php echo $data->disease_name; ?></td>
        <td ><?php echo $data->final_doctor_name; ?></td>
        <td ><?php echo $data->final_hospital_name; ?></td>
        <td ><?php echo $data->final_time; ?></td>
        <td ><?php echo $data->creator_doctor_name; ?></td>
        <td ><?php echo $data->creator_hospital_name; ?></td>
        <td ><?php echo $data->contact_name; ?></td>
        <td ><?php echo $data->admin_user_name; ?></td>
        <td ><?php echo $data->getWorkSchedule(); ?></td>
        <td ><?php echo $data->date_created; ?></td>
        <td colspan="2" class="text-center">暂无支付单信息</td>
    </tr> 
    <?php
} else {
    foreach ($pbOrder as $key => $order) {
        ?>
        <tr>
            <?php if ($key == 0) { ?>
                <td rowspan="<?php echo count($pbOrder); ?>"><?php echo $data->bd_user_name; ?></td>
                <td rowspan="<?php echo count($pbOrder); ?>"><a target="_blank" href="<?php echo $this->createUrl('bdBkView', array('id' => $data->id)) ?>" ><?php echo $data->ref_no; ?></a></td>
                <td rowspan="<?php echo count($pbOrder); ?>"><?php echo $data->patient_name; ?></td>
                <td rowspan="<?php echo count($pbOrder); ?>"><?php echo $data->disease_name; ?></td>
                <td rowspan="<?php echo count($pbOrder); ?>"><?php echo $data->final_doctor_name; ?></td>
                <td rowspan="<?php echo count($pbOrder); ?>"><?php echo $data->final_hospital_name; ?></td>
                <td rowspan="<?php echo count($pbOrder); ?>"><?php echo $data->final_time; ?></td>
                <td rowspan="<?php echo count($pbOrder); ?>"><?php echo $data->creator_doctor_name; ?></td>
                <td rowspan="<?php echo count($pbOrder); ?>"><?php echo $data->creator_hospital_name; ?></td>
                <td rowspan="<?php echo count($pbOrder); ?>"><?php echo $data->contact_name; ?></td>
                <td rowspan="<?php echo count($pbOrder); ?>"><?php echo $data->admin_user_name; ?></td>
                <td rowspan="<?php echo count($pbOrder); ?>"><?php echo $data->getWorkSchedule(); ?></td>
                <td rowspan="<?php echo count($pbOrder); ?>"><?php echo $data->date_created; ?></td>
            <?php } ?>
            <td><?php echo $order->getOrderType(); ?></td>
            <td><?php echo $order->getIsPaid(); ?></td>
        </tr>
        <?php
    }
}
?>


