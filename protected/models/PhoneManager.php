<?php

class PhoneManager {

    const VENDOR_TINET = 'tinet'; //天润

    private $config = null;

    public function __construct() {
        $this->config = ConfigPhone::model()->getByAttributes(array('phone_name' => self::VENDOR_TINET));
        $this->config->password = md5($this->config->password);
    }

    /**
     * 发起HTTPS请求
     */
    public function curlRequest($url, $post = true, $data = array()) {
        //初始化curl
        $ch = curl_init();
        //参数设置
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_POST, $post);
        if ($post) {
            $post_data = http_build_query($data);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        //连接失败
        if ($result == FALSE) {
            Yii::log('internetPhone:' . var_export($data, true), CLogger::LEVEL_ERROR, __METHOD__);
            $result = "{\"statusCode\":\"1\",\"statusMsg\":\"timeout\"}";
        }

        curl_close($ch);
        return $result;
    }

    /**
     * 第三方外呼调用
     * @param string $phone
     * @param int $cno
     * @return mixed|string
     */
    public function sendPreviewOutcall($phone, $cno) {
        //http://puruan.ccic2.com/interface/PreviewOutcall?enterpriseId=3001875&hotline=51397664&cno=2000&pwd=0659c7992e268962384eb17fafe88364&customerNumber=13916681596&userField=myzd&clidLeftNumber=&sync=
        $url = "{$this->config->interface_server_ip}{$this->config->preview_outcall_url}?enterpriseId={$this->config->enterprise_id}&hotline={$this->config->hotline}&cno={$cno}&pwd={$this->config->password}&customerNumber={$phone}&userField=myzd&clidLeftNumber=&sync=";
        $result = $this->curlRequest($url, false);

        return $result;
    }

    /**
     * 提取通话录音
     * @param $mainUniqueId
     */
    public function getRecord($mainUniqueId) {
        $model = PhoneRecord::model()->getByAttributes(array('main_unique_id' => $mainUniqueId));
        if (is_object($model)) {
            $date = date('Ymd', strtotime($model->date_created));
            $time = time();
            $pwd = md5($this->config->password . $time);
            $url = "{$this->config->interface_server_ip}voices/record/{$date}/{$model->record_file}?enterpriseId={$this->config->enterprise_id}&hotline={$this->config->hotline}&userName={$this->config->username}&pwd={$pwd}&seed={$time}";
            header("Content-type: audio/mp3");
            readfile($url);
        }
    }

    /**
     * 提取通话录音下载
     * @param $mainUniqueId
     */
    public function getRecordDownload($mainUniqueId) {
        $model = PhoneRecord::model()->getByAttributes(array('main_unique_id' => $mainUniqueId));
        if (is_object($model)) {
            $date = date('Ymd', strtotime($model->date_created));
            $time = time();
            $pwd = md5($this->config->password . $time);
            $url = "{$this->config->interface_server_ip}voices/record/{$date}/{$model->record_file}?enterpriseId={$this->config->enterprise_id}&hotline={$this->config->hotline}&userName={$this->config->username}&pwd={$pwd}&seed={$time}";
            header('Content-type: application/x-mp3');
            header('Content-Disposition: attachment; filename='.$model->record_file);
            readfile($url);
            exit();
        }
    }

    /**
     * 外呼通话记录
     * @param string $phone
     * @param int $cno
     * @return mixed|string
     */
    public function sendOutcall($phone = '17717394560', $cno = 2000) {
        //http://puruan.ccic2.com/interface/PreviewOutcall?enterpriseId=3001875&hotline=51397664&cno=2000&pwd=0659c7992e268962384eb17fafe88364&customerNumber=13916681596&userField=myzd&clidLeftNumber=&sync=
        $url = "{$this->config->interface_server_ip}{$this->config->preview_outcall_url}?enterpriseId={$this->config->enterprise_id}&hotline={$this->config->hotline}&cno={$cno}&pwd={$this->config->password}&customerNumber={$phone}&userField=myzd&clidLeftNumber=&sync=";
        $result = $this->curlRequest($url, false);

        return $result;
    }

    /**
     * 队列座席状态
     * @param string $phone
     * @param int $cno
     * @return mixed|string
     */
    public function sendQueueMonitoring($phone = '17717394560', $cno = 2000) {
        $pwd = md5($this->config->password);
        //http://puruan.ccic2.com/interface/queueMonitoring/QueueMonitoring?userName=admin&pwd=0659c7992e268962384eb17fafe88364&enterpriseId=3001875&queueQids=30018750000
        $url = "{$this->config->interface_server_ip}{$this->config->queue_monitoring_url}?userName={$this->config->username}&pwd={$this->config->password}&enterpriseId={$this->config->enterpriseId}&pwd={$pwd}&customerNumber={$phone}&userField=myzd&clidLeftNumber=&sync=";
        $result = $this->curlRequest($url, false);

        return $result;
    }

    /**
     * 队列接口-查看所有队列
     *
     * @return mixed|string
     */
    public function sendQueueList() {
        $url = "{$this->config->interface_server_ip}{$this->config->queue_list_url}?enterpriseId={$this->config->enterprise_id}&userName={$this->config->username}&password={$this->config->password}";
        $result = $this->curlRequest($url, false);
        return $result;
    }

    //根据手机号查询所有的通话记录
    public function loadAllPhoneRecordByMobile($mobile) {
        return PhoneRecord::model()->getAllByAttributes(array('customer_number' => $mobile), array('phoneRecordRemark'));
    }

    public function phoneRecord($post){
        Yii::log('tinet'  . ':' . var_export($post, true), CLogger::LEVEL_ERROR, __METHOD__);
        if(isset($post['cdr_customer_number_type'])){
            $model = PhoneRecord::model()->getByAttributes(array('main_unique_id'=>$post['cdr_main_unique_id']));
            if(is_object($model)){
                $model->call_type = $post['cdr_call_type']; //呼叫类型
                $model->client_number = $post['cdr_client_number']; //转接的电话号码	如座席号码、分机号真实号码等
                $model->customer_number_type = $post['cdr_customer_number_type']; //来电或外呼客户号码类型: 手机/固话
                $model->status = $post['cdr_status']; //通话状态
                $model->start_time = date('Y-m-d H:i:s', $post['cdr_start_time']); //进入系统时间
                $model->answer_time = date('Y-m-d H:i:s', $post['cdr_answer_time']); //系统接听时间
                $model->end_time = date('Y-m-d H:i:s', $post['cdr_end_time']); //挂机时间
                $model->record_file = $post['cdr_record_file']; //	录音文件名
                if($model->save()){
                    $output = array('result'=>'success');
                }else{
                    $output = array('result'=>'error');
                }
            }else{
                $model = new PhoneRecord();
                $model->main_unique_id = $post['cdr_main_unique_id']; //通话记录唯一标识
                $model->call_type = $post['cdr_call_type']; //呼叫类型
                $model->cno = $post['cdr_bridged_cno']; //座席号码
                $model->client_number = $post['cdr_client_number']; //转接的电话号码	如座席号码、分机号真实号码等
                $model->customer_number = $post['cdr_customer_number']; //客户号码
                $model->call_type = $post['cdr_call_type']; //呼叫类型
                $model->customer_number_type = $post['cdr_customer_number_type']; //来电或外呼客户号码类型: 手机/固话
                $model->status = $post['cdr_status']; //通话状态
                $model->start_time = date('Y-m-d H:i:s', $post['cdr_start_time']); //进入系统时间
                $model->answer_time = date('Y-m-d H:i:s', $post['cdr_answer_time']); //系统接听时间
                $model->end_time = date('Y-m-d H:i:s', $post['cdr_end_time']); //挂机时间
                $model->record_file = $post['cdr_record_file']; //	录音文件名
                if(isset($post['cdr_bridged_cno'])){
                    $user = AdminUser::model()->getByAttributes(array('cno'=>$post['cdr_bridged_cno']));
                    if(is_object($user)){
                        $model->admin_user_id = $user->id;
                        $model->admin_user_name = $user->fullname;
                    }
                }
                if($model->save()){
                    $output = array('result'=>'success');
                }else{
                    $output = array('result'=>'error');
                }
            }
        }else{
            $output = array('result'=>'error');
        }
        return $output;
    }

}
