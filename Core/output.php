<?php
/*
*    Responsibilites:
*         Build output files using input and specified file type
*/
class output{
     private $input;
     private $info

     public function csv_init($name, $headers, $separator=","){
          if($headers != FALSE)
               $input[$name] = array(
                         'headers' => $headers
               );

          $info[$name] = array(
                    'separator' => $separator
          );
     }
     public function csv_push($entry){       //$entry = array('col1' => val1, 'col2' => val2); CSV Columns of 1 row
          $input[$name][] = implode($info[$name]['separator'], $entry);
     }
     public function csv_push_all($lines_array){  //$lines_array = array(array('col1' => val1), array('col1'=> val1)); CSV Rows
          foreach($lines_array as $entry){
               $input[$name][] = implode($info[$name]['separator'], $entry);
          }
     }
     public function csv_create($name){
          $fh = fopen($name, "w+");
          $csv = implode("\n", $input[$name]);
          fwrite($fh, $csv);
          fclose($fh);
     }
     public function csv_append($name){
          $fh = fopen($name, "a+");
          $csv = implode("\n", $input[$name]);
          fwrite($fh, $csv);
          fclose($fh);
     }
}
