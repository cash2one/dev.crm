<?php

/**
  * @�����ױ�����
  *
  */
class ZGTException extends Exception {
	
	//�ض��幹����ʹ message ��Ϊ���뱻ָ��������
	public function __construct($message, $code = 0) {
		
		// �Զ���Ĵ���

		// ȷ�����б���������ȷ��ֵ
		parent::__construct($message, $code);
	}

    //�Զ����ַ����������ʽ
	public function __toString() {
		
		return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
	}
}

?>