<?php

namespace App\Garena\Vendor\GWSClient3;


use Exception;

class GWSClientException extends Exception {
  public $file;
  public $line;

  public function __construct($pre_defined_message = '', $code = 0) {
    parent::__construct($pre_defined_message, $code);
  }
}