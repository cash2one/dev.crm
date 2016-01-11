<?php

/**
  * @�����ױ�����
  *
  */
class RequestService {
	
	//ҵ��ӿ�����
	protected $bizName;

	//ҵ������
	protected $bizConfig;
	
	//�̻����
	protected $customernumber;
	
	//hmac��Կ
	protected $keyForHmac;
	
	//AES key
	protected $keyForAES;
	
	//���ԭʼ��������
	protected $request = array();
	
	//�����������
	protected $requestData = array();
	
	//���ԭʼ��������
	protected $response;
	
	//��Ž�����ķ�������
	protected $responseData = array();
	
	public function __construct($bizName) {
		
		global $infConfig;

		if ( !$bizName ) {
		
			throw new ZGTException("bizName is null, [" . $bizName . "].");
		}
		
		if ( !isViaArray($infConfig) ) {
		
			throw new ZGTException("infConfig is null.");
		}
		
		if ( !array_key_exists($bizName, $infConfig) ) {
			
			throw new ZGTException("biz of infConfig is not found[" . $bizName . "].");
		}
		
		$this->bizName = $bizName;
		$this->customernumber = getCustomerNumber();
		$this->keyForHmac = getKeyValue();
		$this->keyForAES = getKeyForAes();
		$this->bizConfig = $infConfig[$bizName];
		
	}
	
	public function __destruct() {}
	
	public function sendRequest($queryData) {

		$this->request = $queryData;

		echo "queryData:<br />";
		print_r($queryData);
		echo "<br /><hr />";

		if ( !$queryData || !is_array($queryData) ) {
			
			throw new ZGTException("query is null or isn't array.");
		}
		
		//ȡ����Ҫ�����URL
		$requestURL = $this->bizConfig["requestURL"];

		//��������
		foreach ( $this->bizConfig["mustFillRequest"] as $fKey => $fValue ) {
			
			if ( !array_key_exists($fValue, $queryData) ) {
				
				throw new ZGTException("queryData.[${fValue}] is must fill, but not found.");
			}
			
			if ( !$queryData[$fValue] ) {
				
				throw new ZGTException("queryData.[${fValue}] is must fill.");
			}
		}
		
		
		//����ǩ��
		$hmacGenConfig = $this->bizConfig["needRequestHmac"];
		$hmacData = array();
		$hmacData["customernumber"] = $this->customernumber;
		foreach ( $hmacGenConfig as $hKey => $hValue ) {
			
			$v = "";
			//�ж�$queryData���Ƿ���ڴ����������Ƿ�ɷ���
			if ( isViaArray($queryData, $hValue) && $queryData[$hValue] ) {
				
				$v = $queryData[$hValue];
			}
			
			//ȡ�ö�Ӧ���ܵ����ĵ�ֵ
			$hmacData[$hValue] = $v;
		}
	
		//$hmacData = cn_url_encode($hmacData);
	
		echo "hmac:<br />";
		print_r($hmacData);
		echo "<br /><hr />";
	
		$hmac = getHmac($hmacData, $this->keyForHmac);
		
		//�ŵ���������
		$requestDataConfig = $this->bizConfig["needRequest"];
		$dataMap = array();
		$dataMap["customernumber"] = $this->customernumber;
		foreach ( $requestDataConfig as $rKey => $rValue ) {
			
			$v = "";
			//�ж�$queryData���Ƿ���ڴ����������Ƿ�ɷ���
			if ( isViaArray($queryData, $rValue) && $queryData[$rValue] ) {
				
				$v = $queryData[$rValue];
			}
			
			//ȡ�ö�Ӧ���ܵ����ĵ�ֵ
			$dataMap[$rValue] = $v;
		}
		$dataMap["hmac"] = $hmac;
		/*
		$dataMap["signedname"] = "aaa";
		$dataMap["linkman"] = "aaa";
		$dataMap["legalperson"] = "aaa";
		$dataMap["bankname"] = "aaa";
		$dataMap["accountname"] = "aaa";
		$dataMap["bankprovince"] = "aaa";
		$dataMap["bankcity"] = "aaa";
		*/
		
		echo "dataMap<br />";
		print_r($dataMap);
		echo "<br /><hr />";
		
		//ת����json��ʽ
		//$dataJsonString = cn_json_encode($dataMap);
		$dataJsonString = json_encode($dataMap);
		$dataJsonString = iconv(getLocaleCode(), getRemoteCode(), cn_json_encode($dataMap));
		
		echo "dataJsonString<br />";
		print_r($dataJsonString);
		echo "<br /><hr />";
		
		//�����������ݰ�
		$data = getAes($dataJsonString, $this->keyForAES);

		$postfields = array("customernumber" => $this->customernumber, "data" => $data);
		//print_r($postfields);
		
		//������������
		$this->requestData["requestURL"] = $requestURL;
		$this->requestData["requestData"] = $postfields;
				
		$this->response = post($requestURL, $postfields);

		return $this->response;
	}
	
	public function receviceResponse() {
		
		$responseJsonArray = json_decode($this->response, true);
		
		echo "responseJsonArray<br />";
		print_r($responseJsonArray);
		echo "<br /><hr />";
		
		if ( array_key_exists("code", $responseJsonArray)
				&& "1" != $responseJsonArray["code"] ) {

			throw new ZGTException("response error, errmsg = ["
									 . iconv(getRemoteCode(), getLocaleCode(), $responseJsonArray["msg"])
									 . "], errcode = ["
									 . $responseJsonArray["code"]
									 . "]
									 . ", $responseJsonArray["code"]);
		}
		
		$responseData = getDeAes($responseJsonArray["data"], $this->keyForAES);
		$result = json_decode($responseData, true);
		
		//����UTF-8->GBKת��
		$resultLocale = array();
		foreach ( $result as $rKey => $rValue ) {
			
			$resultLocale[$rKey] = iconv(getRemoteCode(), getLocaleCode(), $rValue);
		}
		$this->responseData = $resultLocale;
		
		echo "resultLocale<br />";
		print_r($resultLocale);
		echo "<br /><hr />";
		
		if ( "1" != $result["code"] ) {

			throw new ZGTException("response error, errmsg = [" . $resultLocale["msg"] . "], errcode = [" . $resultLocale["code"] . "].", $result["code"]);
		}

		if ( $result["customernumber"] != $this->customernumber ) {
			
			throw new ZGTException("customernumber not equals, request is [" . $this->customernumber . "], response is [" . $hmacData["customernumber"] . "].");
		}

		//��֤����ǩ��
		$hmacGenConfig = $this->bizConfig["needResponseHmac"];
		$hmacData = array();
		foreach ( $hmacGenConfig as $hKey => $hValue ) {
			
			$v = "";
			//�ж�$queryData���Ƿ���ڴ����������Ƿ�ɷ���
			if ( isViaArray($result, $hValue) && $result[$hValue] ) {
				
				$v = $result[$hValue];
			}
			
			//ȡ�ö�Ӧ���ܵ����ĵ�ֵ
			$hmacData[$hKey] = $v;

		}
		$hmac = getHmac($hmacData, $this->keyForHmac);
		
		if ( $hmac != $result["hmac"] ) {
			
			throw new ZGTException("hmac not equals, response is [" . $result["hmac"] . "], gen is [" . $hmac . "].");
		}
		
		if ( array_key_exists("customError", $result)
		 		&& "" != $result["customError"] ) {
	
			throw new ZGTException("response.customError error, errmsg = [" . $resultLocale["customError"] . "], errcode = [" . $resultLocale["code"] . "].", $result["code"]);
		}
		
		return $resultLocale;
	}
	
	public function getRequest() {
		
		return $this->request;
	}
	
	public function getRequestData() {
		
		return $this->requestData;
	}

	public function getResponse() {
		
		return $this->response;	
	}
	
	public function getResponseData() {
		
		return $this->responseData;
	}
}

?>