<?php
/**
 * /client.php
 */
header("Content-Type: text/html; charset=utf-8");
header('Cache-Control: no-store, no-cache');
header('Expires: '.date('r'));
/**
 * Пути по-умолчанию для поиска файлов
 */
set_include_path(get_include_path()
    .PATH_SEPARATOR.'classes'
    .PATH_SEPARATOR.'objects');
/**
 ** Функция для автозагрузки необходимых классов
 */
function __autoload($class_name){
    include $class_name.'.class.php';
}
ini_set('display_errors', 1);
error_reporting(E_ALL & ~E_NOTICE);
// Заготовки объектов

class Order{
    public $order_id;
}
class Request{
    public $order;
}
// создаем объект для отправки на сервер
$req = new Request();
$msg1 = new Order();
$msg1->order_id = 1;
$req ->order=$msg1;


//$req->messageList = (object)$req->messageList;
var_dump($req);
//var_dump(unserialize('O:8:"stdClass":1:{s:11:"messageList";O:8:"stdClass":1:{s:7:"message";O:8:"stdClass":4:{s:5:"phone";s:11:"79871234567";s:4:"text";s:37:"Тестовое сообщение 1";s:4:"date";s:22:"2013-07-21T15:00:00.26";s:4:"type";s:2:"15";}}}'));
//var_dump(unserialize('O:8:"stdClass":1:{s:11:"messageList";O:8:"stdClass":1:{s:7:"message";O:8:"stdClass":1:{s:6:"Struct";a:3:{i:0;O:8:"stdClass":4:{s:5:"phone";s:11:"79871234567";s:4:"text";s:37:"Тестовое сообщение 1";s:4:"date";s:22:"2013-07-21T15:00:00.26";s:4:"type";s:2:"15";}i:1;O:8:"stdClass":4:{s:5:"phone";s:11:"79871234567";s:4:"text";s:37:"Тестовое сообщение 2";s:4:"date";s:19:"2014-08-22T16:01:10";s:4:"type";s:2:"16";}i:2;O:8:"stdClass":4:{s:5:"phone";s:11:"79871234567";s:4:"text";s:37:"Тестовое сообщение 3";s:4:"date";s:19:"2014-08-22T16:01:10";s:4:"type";s:2:"17";}}}}}'));
//var_dump(unserialize('O:8:"stdClass":1:{s:11:"messageList";O:8:"stdClass":1:{s:7:"message";O:8:"stdClass":1:{s:5:"BOGUS";a:3:{i:0;O:8:"stdClass":4:{s:5:"phone";s:11:"79871234567";s:4:"text";s:37:"Тестовое сообщение 1";s:4:"date";s:22:"2013-07-21T15:00:00.26";s:4:"type";s:2:"15";}i:1;O:8:"stdClass":4:{s:5:"phone";s:11:"79871234567";s:4:"text";s:37:"Тестовое сообщение 2";s:4:"date";s:19:"2014-08-22T16:01:10";s:4:"type";s:2:"16";}i:2;O:8:"stdClass":4:{s:5:"phone";s:11:"79871234567";s:4:"text";s:37:"Тестовое сообщение 3";s:4:"date";s:19:"2014-08-22T16:01:10";s:4:"type";s:2:"17";}}}}}'));
//var_dump(unserialize('O:8:"stdClass":1:{s:11:"messageList";O:8:"stdClass":1:{s:5:"BOGUS";a:3:{i:0;O:8:"stdClass":4:{s:5:"phone";s:11:"79871234567";s:4:"text";s:37:"Тестовое сообщение 1";s:4:"date";s:22:"2013-07-21T15:00:00.26";s:4:"type";s:2:"15";}i:1;O:8:"stdClass":4:{s:5:"phone";s:11:"79871234567";s:4:"text";s:37:"Тестовое сообщение 2";s:4:"date";s:19:"2014-08-22T16:01:10";s:4:"type";s:2:"16";}i:2;O:8:"stdClass":4:{s:5:"phone";s:11:"79871234567";s:4:"text";s:37:"Тестовое сообщение 3";s:4:"date";s:19:"2014-08-22T16:01:10";s:4:"type";s:2:"17";}}}}'));
//var_dump(unserialize('O:8:"stdClass":1:{s:11:"messageList";O:8:"stdClass":1:{s:5:"BOGUS";O:8:"stdClass":4:{s:5:"phone";s:11:"79871234567";s:4:"text";s:37:"Тестовое сообщение 1";s:4:"date";s:22:"2013-07-21T15:00:00.26";s:4:"type";s:2:"15";}}}'));
$uri  = "http://{$_SERVER['HTTP_HOST']}/Pasha_def.wsdl.php";
$client = new SoapClient(   $uri,
                            array( 'soap_version' => SOAP_1_2));
var_dump($client->sendDelivery($req));
