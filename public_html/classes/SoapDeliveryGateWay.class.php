<?php
/**
 * /classes/SoapSmsGateWay.class.php
 */
class SoapDeliveryGateWay {
    public function sendDelivery($messagesData){
        $rawPost  = "Input:\r\n";
        $rawPost .= file_get_contents('php://input');
        $rawPost .= "\r\n---\r\nmessageData:\r\n";
        $rawPost .= serialize($messagesData);
        file_put_contents("log.txt",$rawPost);
        return array("status" => "true");
    }
}
