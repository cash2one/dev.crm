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
    public function getRecord($mainUniqueId){
        $model = PhoneRecord::model()->getByAttributes(array('main_unique_id'=>$mainUniqueId));
        if(is_object($model)){
            $date = date('Ymd', strtotime($model->date_created));
            $time = time();
            $pwd = md5($this->config->password . $time);
            $url = "{$this->config->interface_server_ip}/voices/record/{$date}/{$model->record_file}?enterpriseId={$this->config->enterprise_id}&hotline={$this->config->hotline}&userName={$this->config->username}&pwd={$pwd}&seed={$time}";
            header("Content-type: audio/mp3");
            readfile($url);
        }
    }

    /**
     * 外呼通话记录
     * @param string $phone
     * @param int $cno
     * @return mixed|string
     */
    public function sendOutcall($phone='17717394560', $cno=2000) {
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
    public function sendQueueMonitoring($phone='17717394560', $cno=2000) {
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

}
