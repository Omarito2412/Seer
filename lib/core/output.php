<?php
/**
 * Seer,
 *
 * A PHP XPath based web scraping framework.
 *
 * PHP support 5.3+
 *
 * @package     Seer
 * @version     0.0.0
 * @author      Omarito2412
 * @link        https://github.com/Omarito2412/Seer
 * @license     MIT
 */
namespace Seer\Core;

/**
 * Responsibilities:
 *   Build output files using input and specified file type
 */
class Output
{
    private $input;
    private $info;

    public function csv_init($name, $headers, $separator = ",")
    {
        if ($headers != FALSE)
            $this->input[$name] = array(
                'headers' => $headers
            );

        $this->info[$name] = array(
            'separator' => $separator,
            'list-separator' => '|'
        );
    }
    public function csv_add_opt($name, $value){
            // Add an option to this file from the specified options in the documentation
        $this->info[$name] = $value;
    }
    public function csv_push($file_name, $entry)
    {       //$entry = array('col1' => val1, 'col2' => val2); CSV Columns of 1 row
        $row = array();
        foreach($entry as $column){
            if(is_object($column) && get_class($column) == "DOMNodeList")
                $column = $this->list_to_string($column);
            else if(is_array($column))
                $column = implode($this->info['list-separator'], $column);
            $row[] = $column;
        }
        $this->input[$file_name][] = implode($this->info[$file_name]['separator'], $row);
    }

    public function csv_push_all($file_name, $rows_array)
    {  //$lines_array = array(array('col1' => val1), array('col1'=> val1)); CSV Rows
        foreach ($rows_array as $row) {
            $this->csv_push($file_name, $row);
        }
    }

    public function csv_create($name)
    {
        $fh = fopen($name, "w+");
        $csv = implode("\n", $this->input[$name]);
        fwrite($fh, $csv);
        fclose($fh);
    }

    public function csv_append($name)
    {
        $fh = fopen($name, "a+");
        $csv = implode("\n", $this->input[$name]);
        fwrite($fh, $csv);
        fclose($fh);
    }

    private function to_array($List)
    {
        $output = array();
        foreach ($List as $Node) {
            $output[] = $Node->nodeValue;
        }
        return $output;
    }
    private function list_to_string($list)
    {
        $string = array();
        foreach($list as $item){
            $string[] = $item->nodeValue;
        }
        $string = implode($this->info["list-separator"], $string);
        return $string;
    }
}
