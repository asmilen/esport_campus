<?php

namespace App\Garena\Vendor\GWSClient3;
use App\Garena\Vendor\PhpSecLib\Crypt_AES;
use XMLWriter;

/**
* Utilize POST+XML to access GWS
* Required Ext: CURL, XMLWriter, openSSL
* www.garena.com
* Copyrite @ Garena Interactive Pte Ltd.
*/

class GWSClient {
	private $gws_address;
	private $port;
	private $appid;
	private $auth_key;
	private $current_module;
	private $silent_mode;
	public $enable_log;

	public function __construct($gws_address, $port, $appid, $auth_key, $silent_mode = FALSE){
		$this->gws_address = $gws_address;
		$this->port = $port;
		$this->appid = $appid;
		$this->auth_key = $auth_key;
		$this->silent_mode = $silent_mode;
	}

	public function use_new_error_handling($true_false){
		$this->silent_mode = !$true_false;
	}

	//Return GWS_Response
	public function send_request(CVO_WSRequest $request, $token, $aes) {		

		if(file_exists(config('gws')['private_key_file'])) {
			$fp=fopen(config('gws')['private_key_file'], 'r');
			$priv_key=fread($fp, 8192);
			fclose($fp);

			// retireve our private key
			$res = openssl_get_privatekey($priv_key);
			// encrypt token with our private key store in crypttext
			if(openssl_private_encrypt($token, $crypttext, $res)) {
				$encrypted_token = base64_encode($crypttext);
				$signature = $this->generate_signature($request);
				$xml_raw = $this->generate_raw_xml($request, $signature);
				$content = base64_encode($aes->encrypt($xml_raw));

				// submit our encrypted token and xml
				$xml_w = new XMLWriter();
				$xml_w->openMemory();
				$xml_w->setIndent(TRUE);
				$xml_w->startDocument('1.0','utf-8');
				$xml_w->startElement('request');
				$xml_w->writeElement('token', $encrypted_token);
				$xml_w->writeElement('content', $content);
				$xml_w->endElement();
				$xml_w->fullEndElement();
				$xml = $xml_w->outputMemory(TRUE);

				return $this->http_send($xml);
			} else {
				return '';
			}
		} else {
			return '';
		}

	}

	public function parse_response($xml_raw, $aes){
		$xml_obj = simplexml_load_string($xml_raw);
		$xml_raw = $aes->decrypt(base64_decode($xml_obj->content));
		$xml_obj = simplexml_load_string($xml_raw, NULL, LIBXML_NOCDATA);

		if(isset($xml_obj->message)) {
			// parse CDATA information
			// which is all the extra parameters returned from ws server
			$response_data = explode(',',(string)$xml_obj->message->body);
			$count = sizeof($response_data);
			$body = array();
			for ($i = 0; $i < floor($count / 2); $i++) {
				$body[trim($response_data[$i])] = trim($response_data[$i + floor($count/2)]);
			}

			if((string)$xml_obj->message->result == CVO_WSResponse_Message::RESULT_SUCCESS){
				return new CVO_WSResponse_Message((string)$xml_obj->message->result,(string)$xml_obj->message->result,$body);
			}else{
				if(!$this->silent_mode){
					throw new GWSClientException('Error Code '.(string)$xml_obj->message->result, (string)$xml_obj->message->result);
				} else {
					return new CVO_WSResponse_Message((string)$xml_obj->message->result,(string)$xml_obj->message->result,$body);
				}
			}
		} else {
			return FALSE;
		}
	}

	private function http_send($xml_raw){
		$session = curl_init();
		$header_arr = array(
										'POST HTTP/1.1',
										'Host: www.garena.com',
										'Content-Type: text/xml; charset= "utf-8"',
										'Content-Length: ' . strlen($xml_raw)
									);
		curl_setopt($session, CURLOPT_URL, $this->gws_address);
		curl_setopt($session, CURLOPT_PORT, $this->port);
		curl_setopt($session, CURLOPT_HTTPHEADER, $header_arr);
		curl_setopt($session, CURLOPT_POST, 1);
		curl_setopt($session, CURLOPT_POSTFIELDS, $xml_raw);
		curl_setopt($session, CURLOPT_HEADER, TRUE);
		curl_setopt($session, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($session, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($session, CURLOPT_TIMEOUT, 30);
		$response = curl_exec($session);
		if(!$response){
			throw new GWSClientException('Failed to connect to service', '-999');
		}
		$fp = explode("\r\n\r\n",$response);
		
		return $fp[1];
	}

	private function generate_raw_xml(CVO_WSRequest $request,$signature){
		$xml_w = new XMLWriter();
		$xml_w->openMemory();
		$xml_w->setIndent(TRUE);
		$xml_w->startDocument('1.0','utf-8');
		$xml_w->startElement('request');
		$xml_w->writeElement('appid',$this->appid);
		$xml_w->startElement('module');
		$xml_w->writeElement('name',$request->module);
		$xml_w->startElement('method');
		$xml_w->writeElement('name',$request->method);
		$xml_w->startElement('params');
		if(isset($request->params) && sizeof($request->params) > 0){
			foreach($request->params as $param){
				$xml_w->writeElement('param',$param);
			}
		}
		$xml_w->endElement();
		$xml_w->endElement();
		$xml_w->endElement();
		$xml_w->writeElement('signature', $signature);
		$xml_w->fullEndElement();
		
		return $xml_w->outputMemory(TRUE);
	}

	private function generate_signature(CVO_WSRequest $request){
		$params_str = '';
		if(!empty($request->params)){
			foreach($request->params as $param){
				$params_str .= $param.'|';
			}
		}
		$plain = $this->appid.'|'.$request->module.'|'.$request->method.'|'.$this->auth_key.'|'.$params_str;
		$signature = sha1($plain);
		
		return $signature;
	}

	public function set_module($module){
		$this->current_module = $module;
	}

	public function __call($method, $args){
		// generate a random token to be used as AES key!!!
		for ($token = '', $i = 0, $z = strlen($a = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789')-1; $i != 48; $x = rand(0,$z), $token .= $a{$x}, $i++);
		$aes = new Crypt_AES();
		$aes->setKey(substr($token, 0, 32));
		$aes->setIV(substr($token, 32, 16));
		$raw_response = $this->send_request(new CVO_WSRequest($this->current_module, $method, $args), $token, $aes);
		
		return $this->parse_response($raw_response, $aes);
	}
}
