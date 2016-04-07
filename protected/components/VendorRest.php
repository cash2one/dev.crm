<?php

class VendorRest {
    const VENDOR_ID_160 = 2;
    const KEY_160 = '059f98ab41dfwe9e9d58c27f8bc68bzd';
    const URL_160 = 'http://h5.91160.com/api/index.php?c=outchat&a=zdOrder';
    const BOOKING_160 = 1;
    const DEPOSIT_160 = 2;
    const SERVICE_160 = 3;
    const CONFIRMED_160 = 4;
    public static function getRequestString($values){
//        ksort($values, SORT_STRING);
        $tmpStr = '';
        foreach($values as $k=>$v){
            if($v !== ''){
                $tmpStr .= $k.'='.$v.'&';
            }

        }
        return rtrim($tmpStr, '&');
    }

    public static function getSign($requestString, $time, $key){
        $stringSignTemp = "{$requestString}&t={$time}&key={$key}";
        $sign = md5($stringSignTemp);
        return $sign;
    }

    public static function getData($values, $type, $key){
        ksort($values, SORT_STRING);
        $requestString = self::getRequestString($values);
        $time = time();
        $sign = self::getSign($requestString, $time, $key);

        $fields = json_encode($values);
        $data = array('type'=>$type,'t'=>$time, 'sign'=>$sign, 'fields'=>$fields);
        return $data;
    }

    /**
     * 发起HTTPS请求
     */
    public static function send($vendorId, $values, $type, $post = 1) {
        switch($vendorId){
            case self::VENDOR_ID_160:
                $url = self::URL_160;
                $key = self::KEY_160;
                break;
        }
        $data = self::getData($values, $type, $key);
//        var_dump($data);die;
        //初始化curl
        $ch = curl_init();
        //参数设置
        $res = curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT,20);
        curl_setopt($ch, CURLOPT_POST, $post);
        if ($post)
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        $result = curl_exec($ch);
        //连接失败
        if ($result == FALSE) {
            Yii::log($vendorId . ':' . $data['fields'], CLogger::LEVEL_ERROR, __METHOD__);
            $result = "{\"statusCode\":\"172001\",\"statusMsg\":\"网络错误\"}";
        }

        curl_close($ch);
        return $result;
    }

}
