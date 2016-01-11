<?php

/**
  * @ȡ��ĳ��ϵͳ������
  * @$configKey ϵͳ���õ�key
  * @return string
  *
  */
function getSysConfig($configKey) {

	global $sysConfig;

	if ( !$configKey || empty($configKey) )	{
	
		return null;	
	}
	
	if ( !isViaArray($sysConfig, $configKey) ) {
		
		return null;
	}
	
	return $sysConfig[$configKey];
}

/**
  * @ȡ���̻����
  * @return string
  *
  */
function getCustomerNumber() {
	
	return getSysConfig("customernumber");
}

/**
  * @ȡ��Hmac��Կ
  * @return string
  *
  */
function getKeyValue() {

	return getSysConfig("keyValue");
}

/**
  * @ȡ��AES��Կ
  * @return string
  *
  */
function getKeyForAes() {

	return getSysConfig("keyAesValue");
}

/**
  * @ȡ�ñ����ַ�������
  * @return string
  *
  */
function getLocaleCode() {

	return getSysConfig("localeCode");
}

/**
  * @ȡ��Զ���ַ�������
  * @return string
  *
  */
function getRemoteCode() {

	return getSysConfig("remoteCode");
}

?>