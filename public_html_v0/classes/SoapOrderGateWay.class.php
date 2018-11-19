<?php
/**
 * /classes/SoapSmsGateWay.class.php
 */
class SoapOrderGateWay {
    public function sendSms($messagesData){
        //$rawPost  = "Input:\r\n";
        $rawPost1 = file_get_contents('php://input');
        //$rawPost .= "\r\n---\r\nmessageData:\r\n";
        //$rawPost .= serialize($messagesData);
		file_put_contents("log_Order.txt",$rawPost1);
		return array("status" => "true");
    }
}