<?php
// turn off WSDL caching
ini_set("soap.wsdl_cache_enabled","0");

function push_recipe($list_of_recipes){
	return 0;
}

// initialize SOAP Server
$server=new SoapServer("test.wsdl"/*,[
	'classmap'=>[
		'book'=>'Book', // 'book' complex type in WSDL file mapped to the Book PHP class
	]
]*/);

// register available functions
$server->addFunction('push_recipe');

// start handling requests
$server->handle();