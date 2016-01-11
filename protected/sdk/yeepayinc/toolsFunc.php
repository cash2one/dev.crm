<?php

/**
  * @���һ�������Ƿ�����Ч��
  * @$checkArray ����
  * @$arrayKey ��������
  * @return boolean
  * ���$arrayKey���Σ���ֹ������飬
  * ���Ҽ�������Ƿ�����������С�
  *
 */
function isViaArray($checkArray, $arrayKey = null) {
	
	if ( !$checkArray || empty($checkArray) ) {
		
		return false;
	}
	
	if ( !$arrayKey ) {
		
		return true;
	}
	
	return array_key_exists($arrayKey, $checkArray);
}

/**
  * @ȡ��hmacǩ��
  * @$dataArray ������������ַ���
  * @$key ��Կ
  * @return string
  *
 */
function getHmac(array $dataArray, $key) {
	
	if ( !isViaArray($dataArray) ) {
	
		return null;	
	}
	
	if ( !$key || empty($key) ) {
		
		return null;
	}
	
	if ( is_array($dataArray) ) {
	
		$data = implode("", $dataArray);
	} else {
	
		$data = strval($dataArray);	
	}
	
	//print_r($data);
	
	if ( getLocaleCode() != "UTF-8" ) {
	
		$key = iconv(getLocaleCode(), "UTF-8", $key);
		$data = iconv(getLocaleCode(), "UTF-8", $data);	
	}
	

	$b = 64; // byte length for md5
	if (strlen($key) > $b) {
		
		$key = pack("H*",md5($key));
	}
	
	$key = str_pad($key, $b, chr(0x00));
	$ipad = str_pad('', $b, chr(0x36));
	$opad = str_pad('', $b, chr(0x5c));
	$k_ipad = $key ^ $ipad ;
	$k_opad = $key ^ $opad;

	return md5($k_opad . pack("H*",md5($k_ipad . $data)));
}

/**
  * @ȡ��aes����
  * @$dataArray �����ַ���
  * @$key ��Կ
  * @return string
  *
 */
function getAes($data, $aesKey) {

	//print_r(mcrypt_list_algorithms());
	//print_r(mcrypt_list_modes());

	$aes = new CryptAES();
	$aes->set_key($aesKey);
	$aes->require_pkcs5();
	$encrypted = strtoupper($aes->encrypt($data));
	
	return $encrypted;

}

/**
  * @ȡ��aes����
  * @$dataArray �����ַ���
  * @$key ��Կ
  * @return string
  *
 */
function getDeAes($data, $aesKey) {

	$aes = new CryptAES();
	$aes->set_key($aesKey);
	$aes->require_pkcs5();
	$text = $aes->decrypt($data);
	
	return $text;
}

/**
  * @����http����
  * @$url �����url
  * @$method POST ���� GET
  * @$postfields ����Ĳ���
  * @return mixed
  */
function post($url, $postfields = null) {
	
	$http_info = array();
	$ci = curl_init();
	curl_setopt($ci, CURLOPT_USERAGENT, "Yeepay ZGT PHPSDK v1.1x");
	curl_setopt($ci, CURLOPT_CONNECTTIMEOUT, 30);
	curl_setopt($ci, CURLOPT_TIMEOUT, 30);
	curl_setopt($ci, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ci, CURLOPT_HTTPHEADER, array("Expect:"));
	curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, false);
	//curl_setopt($ci, CURLOPT_HEADERFUNCTION, array());
	curl_setopt($ci, CURLOPT_HEADER, false);
	
	curl_setopt($ci, CURLOPT_POST, true);
	
	if (!empty($postfields)) {
				
		curl_setopt($ci, CURLOPT_POSTFIELDS, $postfields);
	}
	
	curl_setopt($ci, CURLOPT_URL, $url);
	$response = curl_exec($ci);
	$http_code = curl_getinfo($ci, CURLINFO_HTTP_CODE);
	$http_info = array_merge($http_info, curl_getinfo($ci));
	curl_close ($ci);
	//print_r($response);

	return $response;
}

/**
  * @ʹ���ض�function������������Ԫ��������
  * @&$array Ҫ������ַ���
  * @$function Ҫִ�еĺ���
  * @$apply_to_keys_also �Ƿ�ҲӦ�õ�key��
  *
  */
function arrayRecursive(&$array, $function, $apply_to_keys_also = false)
{
    foreach ($array as $key => $value) {
        if (is_array($value)) {
            arrayRecursive($array[$key], $function, $apply_to_keys_also);
        } else {
            $array[$key] = $function($value);
        }

        if ($apply_to_keys_also && is_string($key)) {
            $new_key = $function($key);
            if ($new_key != $key) {
                $array[$new_key] = $array[$key];
                unset($array[$key]);
            }
        }
    }
}

/**
  *
  * @������ת��ΪJSON�ַ������������ģ�
  * @$array Ҫת��������
  * @return string ת���õ���json�ַ���
  *
  */
function cn_json_encode($array) {
    $array = cn_url_encode($array);
    $json = json_encode($array);
    return urldecode($json);
}

/**
  *
  * @������ͳһ����urlencode���������ģ�
  * @$array Ҫת��������
  * @return array ת���������
  *
  */
function cn_url_encode($array) {
    arrayRecursive($array, "urlencode", true);
	return $array;
}

?>