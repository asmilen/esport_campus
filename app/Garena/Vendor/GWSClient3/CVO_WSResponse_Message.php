<?php
namespace App\Garena\Vendor\GWSClient3;

class CVO_WSResponse_Message {
	const RESULT_SUCCESS = 0;

	public $result;
	public $error_code;
	public $body;

	public function __construct($result, $error_code, $body){
		$this->result = $result;
		$this->error_code = $error_code;
		$this->body = $body;
	}
}