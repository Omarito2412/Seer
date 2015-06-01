<?php
/*
*    Responsibilites:
*         Build output files using input and specified file type
*/
class output{
     private $input;
     private $info;

     public function csv_init($name, $headers, $separator=","){
          if($headers != FALSE)
               $this->input[$name] = array(
                         'headers' => $headers
               );

          $this->info[$name] = array(
                    'separator' => $separator
          );
     }
     public function csv_push($name, $entry){       //$entry = array('col1' => val1, 'col2' => val2); CSV Columns of 1 row
          if(get_class($entry) == "DOMNodeList")
               $entry = $this->to_array($entry);
          $this->input[$name][] = implode($this->info[$name]['separator'], $entry);
     }
     public function csv_push_all($name, $lines_array){  //$lines_array = array(array('col1' => val1), array('col1'=> val1)); CSV Rows
          foreach($lines_array as $entry){
               if(is_array($entry))
                    $this->input[$name][] = implode($this->info[$name]['separator'], $entry);
               else
                     $this->input[$name][] = $entry;
          }
     }
     public function csv_create($name){
          $fh = fopen($name, "w+");
          $csv = implode("\n", $this->input[$name]);
          fwrite($fh, $csv);
          fclose($fh);
     }
     public function csv_append($name){
          $fh = fopen($name, "a+");
          $csv = implode("\n", $this->input[$name]);
          fwrite($fh, $csv);
          fclose($fh);
     }
     private function to_array($List){
          $output = array();
          foreach($List as $Node){
               $output[] = $Node->nodeValue;
          }
          return $output;
     }
}
