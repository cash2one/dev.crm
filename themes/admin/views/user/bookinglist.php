<?php ?>
<h1>医生提交预约列表</h1>
<div class="mt10">
    <table class="table">
        <thead>
            <tr>
                <td>ID</td>
                <td>患者姓名</td>
                <td>患者手机</td>
                <td>预约号</td>
                <td>状态</td>
                <td>疾病诊断</td>
                <td style="width:30%;">疾病描述</td>
                <td>创建日期</td>
            </tr>
        </thead>
        <tbody>
            <?php
            if(count($data) == 0){
                echo '<tr><td>无</td></tr>';
            }
            foreach ($data as $patientBooking) {
                $patient = $patientBooking->getPatient();
                $patientName = $patient->getName();
                $patientMobile = $patient->getMobile();
                $diseaseName = $patient->getDiseaseName() != null ? $patient->getDiseaseName() : '';
                $diseaseDetail = $patient->getDiseaseDetail() != null ? $patient->getDiseaseDetail() : '';
                ?>
                <tr>
                    <td>
                        <?php echo CHtml::link(CHtml::encode($patientBooking->id), array('patientbooking/view', 'id' => $patientBooking->id), array('target' => '_blank')); ?>
                    </td>
                    <td>
                        <?php echo CHtml::encode($patientName); ?>
                    </td>
                    <td>
                        <?php echo CHtml::encode($patientMobile); ?>
                    </td>
                    <td>
                        <?php echo CHtml::link(CHtml::encode($patientBooking->ref_no), array('patientbooking/view', 'id' => $patientBooking->id), array('target' => '_blank')); ?>
                    </td>
                    <td>
                        <?php echo CHtml::encode($patientBooking->getStatus()); ?>
                    </td>
                    <td>
                        <?php echo CHtml::encode($diseaseName); ?>
                    </td>
                    <td>
                        <?php echo CHtml::encode($diseaseDetail); ?>
                    </td>
                    <td>
                        <?php echo CHtml::encode($patientBooking->getDateCreated()); ?>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>
