<?php
/*
*    Responsibilites:
*         Connects to website and grabs documents
*         Organize options and header types, Also request types and data
*/
class curl
{
     private $handle;
     private $options;
     private $page;
     private $errors;
     private $errors_count;

     public function __construct($url){
          $this->handle = curl_init($url);
     }

     public function add_option($key, $value = null){
          if($value == null) {      // Options are supplied through an array
               foreach($key as $option => $value){
                    $this->options[$option] = $value;
               }
          }
          else {
               $this->options[$key] = $value;
          }
     }

     public function run(){
          foreach($this->options as $option => $value) {
               curl_setopt($handle, $option, $value);
          }
          $this->page = curl_exec($this->handle);
          if(($this->errors_count = curl_errno($this->handle)) > 0) {
               $this->errors = curl_error($this->handle);
          }
          curl_close($this->handle);
     }

     public function retrieve_errors(){
          return array(
               'count' => $this->errors_count;
               'errors' => $this->errors;
          );
     }
}
