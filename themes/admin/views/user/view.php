<?php
/* @var $this UserController */
/* @var $model User */
$doctorInfo = $data->results->doctorInfo;
$userDoctorHz = $data->results->userDoctorHz;
$userDoctorZz = $data->results->userDoctorZz;
$urlUploadFile = $this->createUrl("user/ajaxUploadCert");
$urlAjaxDoctorCert = $this->createUrl('user/ajaxDoctorCert');
$urlAjaxLoadFiles = 'http://file.mingyizhudao.com/api/loaddrcert?userId=' . $doctorInfo->id;

$urlUserBookingList = $this->createUrl('user/bookinglist', array('id' => $doctorInfo->id));
$this->breadcrumbs = array(
    '用户列表' => array('admin'),
    $doctorInfo->username,
);

$this->menu = array(
    array('label' => '用户列表', 'url' => array('listdoctors')),
    array('label' => '管理用户', 'url' => array('admin')),
);
$urlVerifyUser = $this->createUrl("user/verify", array('id' => $doctorInfo->id));
$urlReturn = $this->createUrl('user/view', array('id' => $doctorInfo->id));
$files = $doctorInfo->files;
if (strIsEmpty($doctorInfo->name)) {
    $verifiyUrl = '<span class="color-red">该医生未提交医生信息</span>';
} else {
    $abtn = $doctorInfo->verified ? '取消认证' : '认证';
    $verifiyUrl = '<a class="btn btn-primary" href="' . $urlVerifyUser . '" >' . $abtn . '</a>';
}
$verified = $doctorInfo->verified ? '已认证' : '未认证';
?>
<style>
    .table-info tbody th{width: 15%;}
    .table-info tbody td{width: 35%;}
    .imglist img{height: 160px;width: 100%;}
    .delete .file-panel{padding: 5px;text-align: center;background-color: #f00;color: #fff;}
</style>
<h1>查看 #<?php echo $doctorInfo->id; ?></h1>
<a href="<?php echo $urlUserBookingList; ?>" class="btn btn-primary">查看医生提交预约</a>
<table class="table table-info mt20" id="yw0">
    <tbody>
        <tr class="odd">
            <th>医生姓名</th><td><?php echo $doctorInfo->name; ?></td>
            <th>手机</th><td><?php echo substr_replace($doctorInfo->username, '****', 3, 4) . '   <a data-mobile="' . $doctorInfo->username . '" data-toggle="modal" data-target="#outingCallsModal">打电话</a>'; ?></td>
        </tr> 
        <tr class="even">
            <th>所属医院</th><td><?php echo $doctorInfo->hospitalName; ?></td>
            <th>所属科室</th><td><?php echo $doctorInfo->hpDeptName; ?></td>
        </tr> 
        <tr class="even">
            <th>临床职称</th><td><?php echo $doctorInfo->clinicalTitle; ?></td>
            <th>学术职称</th><td><?php echo $doctorInfo->academicTitle; ?></td>
        </tr>
        <tr class="even">
            <th>省份</th><td><?php echo $doctorInfo->stateName; ?></td>
            <th>城市</th><td><?php echo $doctorInfo->cityName; ?></td>
        </tr>
        <tr class="even">
            <th>认证状态</th><td><?php echo $verified . '     ' . $verifiyUrl; ?></td>
            <th>注册日期</th><td><?php echo $doctorInfo->dataCreated; ?></td>
        </tr>
        <tr class="even">
            <th>是否电子签约</th><td><?php echo $doctorInfo->isContractDoctor; ?></td>
            <th>期望患者类型</th><td><?php echo $doctorInfo->preferredPatient; ?></td>
        </tr>
    </tbody>
</table>
<h3>会诊信息</h3>
<table class="table table-info" id="yw0">
    <tbody>
        <?php
        if (is_null($userDoctorHz) || $userDoctorHz->isJoin != 1) {
            echo '<tr class="odd"><td rowspan="4">暂不参与,无信息</td></tr>';
        } else {
            ?>
            <tr class="odd">
                <th>外出会诊台数</th><td><?php echo $userDoctorHz->minNoSurgery; ?></td>
                <th>时间成本要求</th><td><?php echo $userDoctorHz->travelDuration; ?></td>
            </tr>
            <tr class="odd">
                <th>方便会诊时间</th><td><?php echo $userDoctorHz->weekDays; ?></td>
                <th>愿意会诊病例</th><td><?php echo $userDoctorHz->patientsPrefer; ?></td>
            </tr>
            <tr class="odd">
                <th>每台咨询费区间</th><td><?php echo "{$userDoctorHz->feeMin}元 — {$userDoctorHz->feeMax}元"; ?></td>
                <th>常去地区或医院</th><td><?php echo $userDoctorHz->freqDestination; ?></td>
            </tr>
            <tr class="odd">
                <th>对手术地点/要求条件</th><td><?php echo $userDoctorHz->destinationReq; ?></td>
                <th></th><td></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<h3>转诊信息</h3>
<table class="table table-info" id="yw0">
    <tbody>
        <?php
        if (is_null($userDoctorZz) || $userDoctorZz->isJoin != 1) {
            echo '<tr class="odd"><td rowspan="4">暂不参与,无信息</td></tr>';
        } else {
            ?>
            <tr class="odd">
                <th>转诊费</th><td><?php echo $userDoctorZz->fee;
            ?></td>
                <th>对转诊病例的要求</th><td><?php echo $userDoctorZz->preferredPatient; ?></td>
            </tr>
            <tr class="odd">
                <th>最快安排床位时间</th><td><?php echo $userDoctorZz->prepDays; ?></td>
                <th></th><td></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<div>
    <h3>证件：共 <?php echo count($files) ?>（份）</h3>
    <div class="form-wrapper">
        <form id="doctor-form" data-url-uploadfile="<?php echo $urlAjaxDoctorCert; ?>" data-url-return="<?php echo $urlReturn; ?>" method="post">
            <input id="doctorId" type="hidden" name="doctor[id]" value="<?php echo $doctorInfo->id; ?>" />    
            <input type="hidden" id="domain" value="http://drcert.file.mingyizhudao.com"> 
            <input type="hidden" id="uptoken_url" value="<?php echo $this->createUrl('user/ajaxToken'); ?>">
        </form>
        <div class="mb20 row">
            <div class="col-sm-12">
                <?php $this->renderPartial('_uploadFile'); ?>
            </div>
        </div>
    </div>
    <div class="row imglist">

    </div>
</div>
<?php
$this->renderPartial('_showImgModal');
$this->renderPartial('//adminbooking/outingCallsModal');
?>
<script>
    $(document).ready(function () {
        $.ajax({
            url: '<?php echo $urlAjaxLoadFiles; ?>',
            success: function (data) {
                setImgHtml(data.results);
            }
        });
    });
    function setImgHtml(results) {
        var innerHtml = '';
        var files = results.files;
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            innerHtml += '<div class="col-sm-2 mt10 docImg"><a data-toggle="modal" data-target="#showImgModal" data-src="' + file.absFileUrl + '"><img src="' + file.absFileUrl + '"/></a><div>' + file.dateCreated + '</div>' +
                    '<a class="delete" href="<?php echo $this->createUrl('user/delectDoctorCert'); ?>?id=' + file.id + '&doctorId=<?php echo $doctorInfo->id; ?>"><div class="file-panel">删除</div></a>' +
                    '</div>';
        }
        $('.imglist').html(innerHtml);
        initDelete();
    }
    function initDelete() {
        $('a.delete').click(function (e) {
            e.preventDefault();
            var deleteUrl = $(this).attr('href');
            if (confirm('确定删除这张图片?')) {
                $.ajax({
                    url: deleteUrl,
                    success: function (data) {
                        if (data.status == 'ok') {
                            alert('删除成功!');
                            location.reload();
                        }
                    },
                    error: function () {
                        alert('删除失败!');
                    }
                });
            }
        });
    }
</script>