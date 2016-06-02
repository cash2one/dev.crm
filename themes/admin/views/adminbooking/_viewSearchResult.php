<?php
if (arrayNotEmpty($adminBookings)) {
    foreach ($adminBookings as $data) {
        $pbOrder = isset($data->orderAdminbooking) ? $data->orderAdminbooking : null;
        $doctorMobile = is_null($data->doctorMobile) ? '无' : substr_replace($data->doctorMobile, '****', 3, 4);
        $userDoctorMobile = isset($data->userDoctorMobile) ? $data->userDoctorMobile : null;
        if (strIsEmpty($data->patientMobile)) {
            $patientMobile = '';
        } else if (strlen($data->patientMobile) == 11) {
            $patientMobile = substr_replace($data->patientMobile, '****', 3, 4);
        } else {
            $patientMobile = substr_replace($data->patientMobile, '***', 2, 3);
        }
        ?>
        <?php if (count($pbOrder) == 0) { ?>
            <tr>
                <td ><a target="_blank" href="<?php echo $this->createUrl('view', array('id' => $data->id)) ?>" ><?php echo $data->refNo; ?></a></td>
                <td ><?php echo $data->patientName; ?></td>
                <td >
                    <a href="<?php echo $this->createUrl('patient/view', array('mobile' => $data->patientMobile)); ?>" target="_blank"><?php echo $patientMobile; ?></a>
                    <?php
                    if (is_null($userDoctorMobile) == false) {
                        echo "<a target='_blank' href={$this->createUrl('user/view', array('id' => $userDoctorMobile->id))}><i class='fa fa-user-md' aria-hidden='true'></i></a> ";
                    }
                    if (strIsEmpty($data->patientMobile) == false && ($data->relateionBooking > 1)) {
                        echo "<a target='_blank' href={$this->createUrl('patient/view', array('mobile' => $data->patientMobile))}><i class='fa fa-users' aria-hidden='true'></i></a>";
                    }
                    ?>
                </td>
                <td ><?php echo $data->diseaseName; ?></td>
                <td ><?php echo $data->dateCreated; ?></td>
                <td ><?php echo $data->workSchedule; ?></td>
                <td ><?php echo $data->adminUserName; ?></td>
                <td ><?php echo $data->customerAgent; ?></td>
                <td ><?php echo $data->bdUserName; ?></td>
                <td colspan="2" class="text-center">暂无支付单信息</td>
                <td ><?php echo $data->customerRequest; ?></td>
                <td ><?php echo $data->finalTime; ?></td>
                <td ><?php echo $data->doctorName; ?></td>
                <td ><?php echo $doctorMobile; ?></td>
                <td ><?php echo $data->customerIntention; ?></td>
                <td ><?php echo $data->expectedDoctorName; ?></td>
                <td ><?php echo $data->expectedHospitalName; ?></td>
                <td ><?php echo $data->expectedDoctorMobile; ?></td>
                <td ><?php echo $data->customerDiversion; ?></td>
                <td ><?php echo $data->bookingType; ?></td>
            </tr> 
            <?php
        } else {
            foreach ($pbOrder as $key => $order) {
                ?>
                <tr>
                    <?php if ($key == 0) { ?>
                        <td rowspan="<?php echo count($pbOrder); ?>"><a target="_blank" href="<?php echo $this->createUrl('view', array('id' => $data->id)) ?>" ><?php echo $data->refNo; ?></a></td>
                        <td rowspan="<?php echo count($pbOrder); ?>"><?php echo $data->patientName; ?></td>
                        <td rowspan="<?php echo count($pbOrder); ?>">
                            <a href="<?php echo $this->createUrl('patient/view', array('mobile' => $data->patientMobile)); ?>" target="_blank"><?php echo $patientMobile; ?></a>
                            <?php
                            if (is_null($userDoctorMobile) == false) {
                                echo "<a target='_blank' href={$this->createUrl('user/view', array('id' => $userDoctorMobile->id))}><i class='fa fa-user-md' aria-hidden='true'></i></a>    ";
                            }
                            if ($data->relateionBooking > 1) {
                                echo "<a target='_blank' href={$this->createUrl('patient/view', array('mobile' => $data->patientMobile))}><i class='fa fa-users' aria-hidden='true'></i></a>";
                            }
                            ?>
                        </td>
                        <td rowspan="<?php echo count($pbOrder); ?>"><?php echo $data->diseaseName; ?></td>
                        <td rowspan="<?php echo count($pbOrder); ?>"><?php echo $data->dateCreated; ?></td>
                        <td rowspan="<?php echo count($pbOrder); ?>"><?php echo $data->workSchedule; ?></td>
                        <td rowspan="<?php echo count($pbOrder); ?>"><?php echo $data->adminUserName; ?></td>
                        <td rowspan="<?php echo count($pbOrder); ?>"><?php echo $data->customerAgent; ?></td>
                        <td rowspan="<?php echo count($pbOrder); ?>"><?php echo $data->bdUserName; ?></td>
                    <?php } ?>
                    <td><?php echo $order->getOrderType(); ?></td>
                    <td><?php echo $order->getIsPaid(); ?></td>
                    <?php if ($key == 0) { ?>
                        <td rowspan="<?php echo count($pbOrder); ?>"><?php echo $data->customerRequest; ?></td>
                        <td rowspan="<?php echo count($pbOrder); ?>"><?php echo $data->finalTime; ?></td>
                        <td rowspan="<?php echo count($pbOrder); ?>"><?php echo $data->doctorName; ?></td>
                        <td rowspan="<?php echo count($pbOrder); ?>"><?php echo $doctorMobile; ?></td>
                        <td rowspan="<?php echo count($pbOrder); ?>"><?php echo $data->customerIntention; ?></td>
                        <td rowspan="<?php echo count($pbOrder); ?>"><?php echo $data->expectedDoctorName; ?></td>
                        <td rowspan="<?php echo count($pbOrder); ?>"><?php echo $data->expectedHospitalName; ?></td>
                        <td rowspan="<?php echo count($pbOrder); ?>"><?php echo $data->expectedDoctorMobile; ?></td>
                        <td rowspan="<?php echo count($pbOrder); ?>"><?php echo $data->customerDiversion; ?></td>
                        <td rowspan="<?php echo count($pbOrder); ?>"><?php echo $data->bookingType; ?></td>
                    <?php } ?>

                </tr>
                <?php
            }
        }
    }
} else {
    echo '<tr><td>没有数据.</td></tr>';
}
?>