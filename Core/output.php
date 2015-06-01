<?php
/*
*    Responsibilites:
*         Build output files using input and specified file type
*/
class output{
     private $input;

     public function __construct($input, $separator = null){
          if($separator == null){       //Input is a list
               $cursor = 0;
               foreach($input as $node){
                    $this->input[$cursor] =
               }
          }
          else{     //Input is a separated string

          }
     }
}
