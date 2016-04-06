<?php
$mobile = Yii::app()->request->getQuery('mobile', '');
$patients = $data->results['patients'];
$bookings = $data->results['bookings'];
?>
<style>
    .table>thead{color: #fff;}
    .table tr>td{min-width: 6em;}
</style>
<h1>预约信息列表 #<?php echo $mobile; ?></h1>
<table class="table table-hover">
    <thead>
        <tr>
            <th>患者姓名</th>
            <th>患者所在省市</th>
            <th>患者年龄</th>
            <th>患者性别</th>
            <th>预约类型</th>
            <th>预约号</th>
            <th>创建时间</th>
            <th>预约详情</th>
            <th>推送医生名</th>
            <th>推送医生医院</th>
            <th>推送医生手机</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($patients as $patient) {
            ?>

            <?php
            $urlDoctor = $this->createUrl('user/view', array('id' => $patient->creator_id));
            $patientBookings = isset($patient->patientBookings) ? $patient->patientBookings : null;
            ?>
            <?php
            if (count($patientBookings) == 0) {
                ?>
                <tr>
                    <td><?php echo $patient->name; ?></td>
                    <td><?php echo $patient->getStateName() == $patient->getCityName() ? $patient->getStateName() : $patient->getStateName() . ' ' . $patient->getCityName(); ?></td>
                    <td><?php echo $patient->getAge(); ?></td>
                    <td><?php echo $patient->getGender(); ?></td>
                    <td><?php echo '医生端'; ?></td>
                    <td colspan="7" class="text-center">无预约信息</td>
                </tr>
                <?php
            } else {
                foreach ($patientBookings as $key => $booking) {
                    $urlBooking = $this->createUrl('patientbooking/view', array('id' => $booking->id));
                    $creatorProfile = $booking->pbCreator->userDoctorProfile;
                    if (isset($creatorProfile)) {
                        $creatorName = $creatorProfile->getName();
                        $creatorHp = $creatorProfile->getHospitalName();
                        $creatorMobile = $creatorProfile->getMobile();
                    } else {
                        $creatorName = $booking->pbCreator->username;
                        $creatorHp = '无';
                        $creatorMobile = $booking->pbCreator->username;
                    }
                    ?>
                    <tr>
                        <?php if ($key == 0) { ?>
                            <td rowspan="<?php echo count($patientBookings); ?>"><?php echo $patient->name; ?></td>
                            <td rowspan="<?php echo count($patientBookings); ?>"><?php echo $patient->getStateName() == $patient->getCityName() ? $patient->getStateName() : $patient->getStateName() . ' ' . $patient->getCityName(); ?></td>
                            <td rowspan="<?php echo count($patientBookings); ?>"><?php echo $patient->getAge(); ?></td>
                            <td rowspan="<?php echo count($patientBookings); ?>"><?php echo $patient->getGender(); ?></td>
                            <td rowspan="<?php echo count($patientBookings); ?>"><?php echo '医生端'; ?></td>
                        <?php } ?>
                        <td><a href="<?php echo $urlBooking; ?>" target="_blank"><?php echo $booking->getRefNo(); ?></a></td>
                        <td><?php echo $booking->date_created; ?></td>
                        <td><?php echo $booking->getDetail(); ?></td>
                        <td><a href="<?php echo $urlDoctor; ?>" target="_blank"><?php echo $creatorName; ?></a></td>
                        <td><?php echo $creatorHp; ?></td>
                        <td><?php echo $creatorMobile; ?></td>
                    </tr>
                    <?php
                }
            }
            ?>
            <?php
        }
        ?>
        <?php
        foreach ($bookings as $booking) {
            ?>
            <tr>
                <?php
                $urlDoctor = $this->createUrl('user/view', array('id' => $booking->creatorId));
                if ($booking->bookingType == AdminBooking::BK_TYPE_BK) {
                    $urlBooking = $this->createUrl('booking/view', array('id' => $booking->bookingId));
                } else {
                    $urlBooking = $this->createUrl('patientbooking/view', array('id' => $booking->bookingId));
                }
                ?>
                <td><?php echo $booking->patientName; ?></td>
                <td><?php echo $booking->state == $booking->city ? $booking->state : $booking->state . ' ' . $booking->city; ?></td>
                <td><?php echo $booking->age; ?></td>
                <td><?php echo $booking->gender; ?></td>
                <td><?php echo $booking->bookingTypeText; ?></td>
                <td><a href="<?php echo $urlBooking; ?>" target="_blank"><?php echo $booking->refNo; ?></a></td>
                <td><?php echo $booking->dateCreated; ?></td>
                <td><?php echo $booking->detail; ?></td>
                <td><a href="<?php echo $urlDoctor; ?>" target="_blank"><?php echo $booking->creatorName; ?></a></td>
                <td><?php echo $booking->creatorHp; ?></td>
                <td><?php echo $booking->creatorMobile; ?></td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>

