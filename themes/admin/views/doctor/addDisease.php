<?php
Yii::app()->clientScript->registerScriptFile('http://myzd.oss-cn-hangzhou.aliyuncs.com/static/web/js/bootstrap.min.js', CClientScript::POS_HEAD);
$urlSubmit = $this->createUrl('doctor/updateDisease');
$docId = Yii::app()->request->getQuery('id');
$diseaseIds = CJSON::encode($data->diseaseIds);
?>
<style>
    .text18{font-size: 18px;display: none;}
    .text14{font-size: 14px;color: #00f;}
    .nav-tabs a{text-decoration: none;}
</style>
<form action="<?php echo $urlSubmit ?>" method="post">
    <input type="hidden" name='DoctorDiseaseJoinForm[id]' value="<?php echo $docId; ?>"/>
    <div>
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#waike" aria-controls="waike" role="tab" data-toggle="tab">外科</a></li>
            <li role="presentation"><a href="#guke" aria-controls="guke" role="tab" data-toggle="tab">骨科</a></li>
            <li role="presentation"><a href="#fuchanke" aria-controls="fuchanke" role="tab" data-toggle="tab">妇产科</a></li>
            <li role="presentation"><a href="#yanke" aria-controls="yanke" role="tab" data-toggle="tab">眼科</a></li>
            <li role="presentation"><a href="#kouqiangke" aria-controls="kouqiangke" role="tab" data-toggle="tab">口腔科</a></li>
            <li role="presentation"><a href="#xiaoerwaike" aria-controls="xiaoerwaike" role="tab" data-toggle="tab">小儿外科</a></li>
            <li role="presentation"><a href="#other" aria-controls="other" role="tab" data-toggle="tab">其他</a></li>
        </ul>
        <div class="diseaselist tab-content">
            <div role="tabpanel" class="tab-pane active" id="waike">
                <div class="text18">外科</div>
                <div class="text14">普外科</div>
                <div>
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="1"> 肠癌
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="2"> 肠息肉
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="3"> 大隐静脉曲张
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="4"> 胆道肿瘤
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="5"> 胆管癌
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="6"> 胆结石
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="7"> 肝癌
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="8"> 肝囊肿
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="9"> 肝脏移植
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="10"> 甲状旁腺亢进
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="11"> 甲状腺癌
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="12"> 甲状腺结节
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="13"> 颈动脉狭窄
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="14"> 门脉高压症
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="15"> 乳腺癌
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="16"> 乳腺结节
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="17"> 疝气
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="18"> 胃癌
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="19"> 胰腺癌
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="20"> 胰腺囊肿
                </div>
                <div class="text14">心胸外科</div>
                <div>
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="21"> 成人心脏病
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="22"> 肺癌
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="23"> 腹主动脉瘤
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="24"> 冠心病
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="25"> 气胸
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="26"> 食管癌
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="27"> 先天性心脏病
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="28"> 心律失常
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="29"> 胸腺瘤
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="30"> 胸主动脉瘤
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="31"> 主动脉夹层
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="32"> 纵膈淋巴结肿大
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="33"> 纵膈肿瘤
                </div>
                <div class="text14">泌尿外科</div>
                <div>
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="34"> 膀胱癌
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="35"> 膀胱结石
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="36"> 男性性功能障碍
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="37"> 尿失禁
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="38"> 前列腺癌
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="39"> 肾癌
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="40"> 肾结石
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="41"> 肾上腺肿瘤
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="42"> 肾脏移植
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="43"> 输尿管结石
                </div>
                <div class="text14">神经外科</div>
                <div>
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="44"> 垂体瘤
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="45"> 癫痫
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="46"> 脊髓损伤
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="47"> 脊髓血管畸形
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="48"> 脊髓肿瘤
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="49"> 面肌痉挛
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="50"> 脑动脉瘤
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="51"> 脑外伤
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="52"> 脑血管畸形
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="53"> 脑肿瘤
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="54"> 帕金森病
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="55"> 三叉神经痛
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="56"> 舌咽神经痛
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="57"> 烟雾病
                </div>
                <div class="text14">整形外科</div>
                <div>
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="58"> 瘢痕疙瘩
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="59"> 美容整形
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="60"> 皮肤血管瘤
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="61"> 生殖器畸形
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="guke">
                <div class="text18">骨科</div>
                <div class="text14">四肢</div>
                <div>
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="62"> 骨肿瘤
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="63"> 手外伤
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="64"> 四肢骨折
                </div>
                <div class="text14">脊柱</div>
                <div>
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="65"> 脊柱骨折
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="66"> 脊柱畸形
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="67"> 脊柱肿瘤
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="68"> 颈椎病
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="69"> 腰椎间盘突出
                </div>
                <div class="text14">关节</div>
                <div>
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="70"> 半月板损伤
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="71"> 股骨头坏死
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="72"> 关节畸形
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="73"> 关节置换
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="74"> 肩袖损伤
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="75"> 膝关节炎
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="fuchanke">
                <div class="text18">妇产科</div>
                <div class="text14">妇科</div>
                <div>
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="76"> 宫颈癌
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="77"> 宫外孕
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="78"> 卵巢癌
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="79"> 卵巢囊肿
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="80"> 外阴癌
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="81"> 阴道癌
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="82"> 子宫癌
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="83"> 子宫肌瘤
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="84"> 子宫内膜异位症
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="85"> 子宫脱垂
                </div>
                <div class="text14">产科</div>
                <div>
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="86"> 高危妊娠
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="87"> 妊娠合并糖尿病
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="88"> 妊娠合并心脏病
                </div>
                <div class="text14">生殖医学科</div>
                <div>
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="89"> 不孕症
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="90"> 试管婴儿
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="yanke">
                <div class="text18">眼科</div>
                <div class="text14">眼科</div>
                <div>
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="91"> 白内障
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="92"> 玻璃体积血
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="93"> 角膜病
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="94"> 近视
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="95"> 青光眼
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="96"> 弱视
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="97"> 散光
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="98"> 视网膜脱离
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="99"> 糖尿病视网膜病变
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="100"> 斜视
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="101"> 眼底病
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="102"> 眼外伤
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="103"> 眼肿瘤
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="104"> 远视
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="kouqiangke">
                <div class="text18">口腔科</div>
                <div class="text14">口腔科</div>
                <div>
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="105"> 唇腭裂
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="106"> 口腔肿瘤
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="107"> 龋齿
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="108"> 牙齿修复
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="109"> 牙齿正畸
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="110"> 牙颌面畸形
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="111"> 牙髓病
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="112"> 牙龈病
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="113"> 牙周病
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="114"> 种植牙
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="xiaoerwaike">
                <div class="text18">小儿外科</div>
                <div class="text14">小儿普外科</div>
                <div>
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="115"> 小儿肝胆先天性畸形
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="116"> 小儿关节脱位
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="117"> 小儿脊柱畸形
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="118"> 小儿尿道下裂
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="119"> 小儿鞘膜积液
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="120"> 小儿疝气
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="121"> 小儿手足畸形
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="122"> 小儿先天发育畸形
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="123"> 小儿隐睾
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="124"> 小儿肿瘤
                </div>
                <div class="text14">小儿神经外科</div>
                <div>
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="125"> 先天性神经系统畸形
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="126"> 小儿脊髓肿瘤
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="127"> 小儿脑肿瘤
                </div>
                <div class="text14">小儿心胸外科</div>
                <div>
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="128"> 小儿先天性心脏病
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="129"> 小儿心肌炎
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="130"> 小儿心律失常
                </div>
                <div class="text14">小儿眼科</div>
                <div>
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="131"> 小儿屈光不正
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="132"> 小儿弱视
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="133"> 小儿斜视
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="134"> 小儿眼外伤
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="135"> 先天性白内障
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="136"> 先天性青光眼
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="137"> 先天性上睑下垂
                </div>
                <div class="text14">小儿口腔科</div>
                <div>
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="138"> 小儿错合畸形
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="139"> 小儿根尖周病
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="140"> 小儿龋齿
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="141"> 小儿牙髓病
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="other">
                <div class="text18">其他</div>
                <div class="text14">心内科</div>
                <div>
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="142"> 急性心肌梗死
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="143"> 心脏瓣膜病
                </div>
                <div class="text14">消化内镜科</div>
                <div>
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="144"> 肠息肉
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="145"> 溃疡性结肠炎
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="146"> 十二指肠溃疡
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="147"> 胃溃疡
                </div>
                <div class="text14">耳鼻咽喉头颈外科</div>
                <div>
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="148"> 鼻窦炎
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="149"> 鼻息肉
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="150"> 鼻咽癌
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="151"> 耳聋
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="152"> 喉癌
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="153"> 声带息肉
                    <input type="checkbox" name="DoctorDiseaseJoinForm[disease][]" value="154"> 头颈部肿瘤
                </div>
            </div>
        </div>
    </div>
    <div class="mt20">
        <button id="btnSubmit" type="submit" class="btn btn-success">保存</button>
    </div>
</form>
<br/>

<script>
    $(document).ready(function () {
        var diseaseIds = '<?php echo($diseaseIds); ?>';
        diseaseIds = $.parseJSON(diseaseIds);
        for (var i = 0; i < diseaseIds.length; i++) {
            var disId = diseaseIds[i];
            $("input:checkbox[value='" + disId + "']").attr('checked', 'true');
        }
    });
</script>