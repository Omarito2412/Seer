<?php
/*
*    Responsibilites:
*         Build DOMXpath object
*         Assign/Execute queries
*         Clean and organize outputs based on filters
*/
class xpath
{
     private $errors;
     private $xpath;
     private $query_map;
     private $return_types;
     private $output_buffer;

     public function xpath($html){
          libxml_use_internal_errors(true);
          $DOM = new DOMDocument;
          if(!$DOM->loadHTML($html)) {
               $this->errors = libxml_get_errors();
               libxml_clear_errors();
          }
          $this->xpath = new DOMXPath($DOM);
     }
     public function get_errors(){
          return $this->errors;
     }
     public function add_query($input, $query=null, $return="LIST"){
          if($query == null){      //Queries were supplied in an array.
               foreach($input as $name => $query){
                    $query_data = explode("#", $query);     //Concatenating the Query and the return type with a hash tag
                    $this->query_map[$name] = $query_data[0];
                    if(isset($query_data[1]))
                         $this->return_types[$name] = $query_data[1];
                    else
                         $this->return_types[$name] = "LIST";
               }
          }
          else{
               $this->query_map[$input] = $query;
               $this->return_types[$input] = $return;
          }
     }
     public function run(){
          foreach($this->query_map as $name => $query){
               $this->output_buffer[$name] = organize($this->xpath->query($query), $this->return_types[$name]);
          }
          return $this->output_buffer;
     }
     protected function organize($xpath_result, $type){
          if($type == "LIST")
               return $xpath_result;
     }
}
