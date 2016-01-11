<?php

!defined("__LOCALE__CODE__") && define("__LOCALE__CODE__", "GBK");

header("Content-Type:text/html;charset=" . __LOCALE__CODE__);

if ( !defined("__DEBUG_MODE__") ) {
	
	//���ԡ�����ģʽ
	define("__DEBUG_MODE__", true);
	
	//����ģʽ
	//define("__DEBUG_MODE__", false);
}

//���ô��󱨸�
error_reporting(__DEBUG_MODE__ ? 2047 : 0);

//ͳһ���쳣����
set_exception_handler(
	function($e) {
		
		echo "Uncaught exception: " , $e->getMessage(), "\n<br />";
		echo "Code: " , $e->getCode(), "\n<br />";
		
		if ( __DEBUG_MODE__ ) {
			
			echo "File: " , $e->getFile(), "\n<br />";
			echo "Line: " , $e->getLine(), "\n<br />";
			echo "Trace: " , $e->getTraceAsString(), "\n<br />";
		}
	}
);

//ϵͳ����
$sysConfig = array();

//�̻����
$sysConfig["customernumber"] = "10012431666";

//�̻���Կ
$sysConfig["keyValue"] = "7Fx2N19V34U810042Tu8047395002h75u72A8K9jDhf979p6LdQmUxD8F9p6";

//���²��������޸�
//AES��Կ
$sysConfig["keyAesValue"] = substr($sysConfig["keyValue"], 0, 16);

//���ر���
$sysConfig["localeCode"] = __LOCALE__CODE__;

//Զ�̱���
$sysConfig["remoteCode"] = "UTF-8";

//����ķ�����
$sysConfig["serverURI"] = "http://o2o.yeepay.com/zgt-api/api";
//�����˺�ע�������ַ
$sysConfig["registerURL"] = "${sysConfig["serverURI"]}/register";
//���������ַ
$sysConfig["payURL"] = "${sysConfig["serverURI"]}/pay";
//������ѯ�����ַ
$sysConfig["queryURL"] = "${sysConfig["serverURI"]}/queryOrder";
//�ǽ���ת�������ַ
$sysConfig["transferURL"] = "${sysConfig["serverURI"]}/transfer";
//�ǽ���ת�˲�ѯ�����ַ
$sysConfig["transferQueryURL"] = "${sysConfig["serverURI"]}/transferQuery";
//����ת�������ַ
$sysConfig["divideURL"] = "${sysConfig["serverURI"]}/divide";
//����ת�˲�ѯ�����ַ
$sysConfig["divideQueryURL"] = "${sysConfig["serverURI"]}/queryDivide";
//�����˿������ַ
$sysConfig["refundURL"] = "${sysConfig["serverURI"]}/refund";
//�����˿��ѯ�����ַ
$sysConfig["refundQueryURL"] = "${sysConfig["serverURI"]}/queryRefund";
//����ȷ�������ַ
$sysConfig["confirmURL"] = "${sysConfig["serverURI"]}/settleConfirm";
//����ѯ�����ַ
$sysConfig["balanceQueryURL"] = "${sysConfig["serverURI"]}/queryBalance";

//���²��֣����ǽӿڲ��������߷��ز����Ķ������������޸�
$infConfig = array();

//�����˺�ע��ӿ�����
$infConfig["register"] = array();
$infConfig["register"]["requestURL"] = $sysConfig["registerURL"];
$infConfig["register"]["needRequestHmac"] = array(0 => "requestid", 1 => "bindmobile", 2 => "customertype", 3 => "signedname", 4 => "linkman", 5 => "idcard", 6 => "businesslicence", 7 => "legalperson", 8 => "minsettleamount", 9 => "riskreserveday", 10 => "bankaccountnumber", 11 => "bankname", 12 => "accountname", 13 => "bankaccounttype", 14 => "bankprovince", 15 => "bankcity");
$infConfig["register"]["mustFillRequest"] = array(0 => "requestid", 1 => "bindmobile", 2 => "customertype", 3 => "signedname", 4 => "linkman", 5 => "legalperson", 6 => "minsettleamount", 7 => "riskreserveday", 8 => "bankaccountnumber", 9 => "bankname", 10 => "accountname", 11 => "bankaccounttype", 12 => "bankprovince", 13 => "bankcity");
$infConfig["register"]["needRequest"] = array(0 => "requestid", 1 => "bindmobile", 2 => "customertype", 3 => "signedname", 4 => "linkman", 5 => "idcard", 6 => "businesslicence", 7 => "legalperson", 8 => "minsettleamount", 9 => "riskreserveday", 10 => "bankaccountnumber", 11 => "bankname", 12 => "accountname", 13 => "bankaccounttype", 14 => "bankprovince", 15 => "bankcity");
$infConfig["register"]["needResponseHmac"] = array(0 => "customernumber", 1 => "requestid", 2 => "code", 3 => "ledgerno");

//����֧���ӿ�����
$infConfig["pay"] = array();
$infConfig["pay"]["requestURL"] = $sysConfig["payURL"];
$infConfig["pay"]["needRequestHmac"] = array(0 => "requestid", 1 => "amount", 2 => "assure", 3 => "productname", 4 => "productcat", 5 => "productdesc", 6 => "divideinfo", 7 => "callbackurl", 8 => "webcallbackurl", 9 => "bankid", 10 => "period", 11 => "memo");
$infConfig["pay"]["mustFillRequest"] = array(0 => "requestid", 1 => "amount", 2 => "callbackurl");
$infConfig["pay"]["mustFillRequest_SALES"] = array(0 => "payproducttype");
$infConfig["pay"]["mustFillRequest_ONEKEY"] = array(0 => "payproducttype");
$infConfig["pay"]["mustFillRequest_DIRECT"] = array(0 => "payproducttype", 1 => "cardname", 2 => "idcard", 3 => "bankcardnum", 4 => "mobilephone", 5 => "mcc");
$infConfig["pay"]["needRequest"] = array(0 => "requestid", 1 => "amount", 2 => "assure", 3 => "productname", 4 => "productcat", 5 => "productdesc", 6 => "divideinfo", 7 => "callbackurl", 8 => "webcallbackurl", 9 => "bankid", 10 => "period", 11 => "memo", 12 => "payproducttype", 13 => "userno", 14 => "ip", 15 => "cardname", 16 => "idcard", 17 => "bankcardnum", 18 => "mobilephone", 19 => "cvv2", 20 => "expiredate", 21 => "mcc", 22 => "areacode");
$infConfig["pay"]["needResponseHmac"] = array(0 => "customernumber", 1 => "requestid", 2 => "code", 3 => "externalid", 4 => "amount", 5 => "payurl");
$infConfig["pay"]["needCallbackHmac"] = array(0 => "customernumber", 1 => "requestid", 2 => "code", 3 => "notifytype", 4 => "externalid", 5 => "amount", 6 => "cardno");

//������ѯ�ӿ�����
$infConfig["paymentQuery"] = array();
$infConfig["paymentQuery"]["requestURL"] = $sysConfig["queryURL"];
$infConfig["paymentQuery"]["needRequestHmac"] = array(0 => "requestid");
$infConfig["paymentQuery"]["mustFillRequest"] = array(0 => "requestid");
$infConfig["paymentQuery"]["needRequest"] = array(0 => "requestid");
$infConfig["paymentQuery"]["needResponseHmac"] = array(0 => "customernumber", 1 => "requestid", 2 => "code", 3 => "externalid", 4 => "amount", 5 => "productname", 6 => "productcat", 7 => "productdesc", 8 => "status", 9 => "ordertype", 10 => "busitype", 11 => "orderdate", 12 => "createdate", 13 => "bankid");

//ת�˽ӿ�����
$infConfig["transfer"] = array();
$infConfig["transfer"]["requestURL"] = $sysConfig["transferURL"];
$infConfig["transfer"]["needRequestHmac"] = array(0 => "requestid", 1 => "ledgerno", 2 => "amount");
$infConfig["transfer"]["mustFillRequest"] = array(0 => "requestid", 1 => "amount");
$infConfig["transfer"]["needRequest"] = array(0 => "requestid", 1 => "ledgerno", 2 => "amount", 3 => "sourceledgerno");
$infConfig["transfer"]["needResponseHmac"] = array(0 => "customernumber", 1 => "requestid", 2 => "code");

//ת�˲�ѯ�ӿ�����
$infConfig["transferQuery"] = array();
$infConfig["transferQuery"]["requestURL"] = $sysConfig["transferQueryURL"];
$infConfig["transferQuery"]["needRequestHmac"] = array(0 => "requestid");
$infConfig["transferQuery"]["mustFillRequest"] = array(0 => "requestid");
$infConfig["transferQuery"]["needRequest"] = array(0 => "requestid");
$infConfig["transferQuery"]["needResponseHmac"] = array(0 => "customernumber", 1 => "requestid", 2 => "code", 3 => "ledgerno", 4 => "amount", 5 => "status");

//���˽ӿ�����
$infConfig["divide"] = array();
$infConfig["divide"]["requestURL"] = $sysConfig["divideURL"];
$infConfig["divide"]["needRequestHmac"] = array(0 => "requestid", 1 => "orderrequestid", 2 => "divideinfo");
$infConfig["divide"]["mustFillRequest"] = array(0 => "requestid", 1 => "orderrequestid", 2 => "divideinfo");
$infConfig["divide"]["needRequest"] = array(0 => "requestid", 1 => "orderrequestid", 2 => "divideinfo");
$infConfig["divide"]["needResponseHmac"] = array(0 => "customernumber", 1 => "requestid", 2 => "code");

//���˲�ѯ�ӿ�����
$infConfig["divideQuery"] = array();
$infConfig["divideQuery"]["requestURL"] = $sysConfig["divideQueryURL"];
$infConfig["divideQuery"]["needRequestHmac"] = array(0 => "orderrequestid", 1 => "dividerequestid", 2 => "ledgerno");
$infConfig["divideQuery"]["mustFillRequest"] = array(0 => "orderrequestid");
$infConfig["divideQuery"]["needRequest"] = array(0 => "orderrequestid", 1 => "dividerequestid", 2 => "ledgerno");
$infConfig["divideQuery"]["needResponseHmac"] = array(0 => "customernumber", 1 => "orderrequestid", 2 => "code", 3 => "divideinfo");

//�˿�ӿ�����
$infConfig["refund"] = array();
$infConfig["refund"]["requestURL"] = $sysConfig["refundURL"];
$infConfig["refund"]["needRequestHmac"] = array(0 => "requestid", 1 => "orderrequestid", 2 => "amount", 3 => "divideinfo", 4 => "confirm", 5 => "memo");
$infConfig["refund"]["mustFillRequest"] = array(0 => "requestid", 1 => "orderrequestid", 2 => "amount", 3 => "confirm", 4 => "memo");
$infConfig["refund"]["needRequest"] = array(0 => "requestid", 1 => "orderrequestid", 2 => "amount", 3 => "divideinfo", 4 => "confirm", 5 => "memo");
$infConfig["refund"]["needResponseHmac"] = array(0 => "customernumber", 1 => "requestid", 2 => "code", 3 => "refundexternalid");

//�˿��ѯ�ӿ�����
$infConfig["refundQuery"] = array();
$infConfig["refundQuery"]["requestURL"] = $sysConfig["refundQueryURL"];
$infConfig["refundQuery"]["needRequestHmac"] = array(0 => "orderrequestid", 1 => "refundrequestid");
$infConfig["refundQuery"]["mustFillRequest"] = array(0 => "orderrequestid");
$infConfig["refundQuery"]["needRequest"] = array(0 => "orderrequestid", 1 => "refundrequestid");
$infConfig["refundQuery"]["needResponseHmac"] = array(0 => "customernumber", 1 => "orderrequestid", 2 => "code", 3 => "externalid", 4 => "refundinfo");

//����ȷ�Ͻӿ�����
$infConfig["confirm"] = array();
$infConfig["confirm"]["requestURL"] = $sysConfig["confirmURL"];
$infConfig["confirm"]["needRequestHmac"] = array(0 => "orderrequestid");
$infConfig["confirm"]["mustFillRequest"] = array(0 => "orderrequestid");
$infConfig["confirm"]["needRequest"] = array(0 => "orderrequestid");
$infConfig["confirm"]["needResponseHmac"] = array(0 => "customernumber", 1 => "orderrequestid", 2 => "code");


//����ѯ�ӿ�����
$infConfig["balanceQuery"] = array();
$infConfig["balanceQuery"]["requestURL"] = $sysConfig["balanceQueryURL"];
$infConfig["balanceQuery"]["needRequestHmac"] = array(0 => "ledgerno");
$infConfig["balanceQuery"]["mustFillRequest"] = array();
$infConfig["balanceQuery"]["needRequest"] = array(0 => "ledgerno");
$infConfig["balanceQuery"]["needResponseHmac"] = array(0 => "customernumber", 1 => "code", 2 => "balance", 3 => "ledgerbalance");

//����ϵͳ�ļ�
require_once(__DIR__ . "/toolsFunc.php");
require_once(__DIR__ . "/func.php");
require_once(__DIR__ . "/RequestService.php");
//�����ӽ����ļ�
require_once(__DIR__ . "/CryptAES.php");
//�����Զ����쳣�ļ�
require_once(__DIR__ . "/ZGTException.php");

?>