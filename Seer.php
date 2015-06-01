<?php
/*
*    Responsibilites:
*         This is the loader class, Communication occurs only through it.
*/

define('CORE_LOCATION', "./Core/");

require_once CORE_LOCATION.'curl.php';
require_once CORE_LOCATION.'xpath.php';
require_once CORE_LOCATION.'output.php';

class Seer{
     public $xpath;
     public $curl;
     public $output;

     public function __construct(){
          $this->xpath = new xpath();
          $this->curl = new curl();
          $this->output = new output();
     }
}
