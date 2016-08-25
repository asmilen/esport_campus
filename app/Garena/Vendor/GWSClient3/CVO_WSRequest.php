<?php

namespace App\Garena\Vendor\GWSClient3;
  /**
  *  Web service request struct   
  */
  
  class CVO_WSRequest {
		const TYPE_SOAP = 1;
		const TYPE_XMLRPC = 2;
		const TYPE_POST = 3;
		const TYPE_GET = 4;
		const TYPE_GXML = 5; //Garena XML 
		public $module;
		public $method;
		public $params;
		
		public function __construct($module,$method,$params){
			$this->module = $module;
			$this->method = $method;
			$this->params = $params;
		}
  }