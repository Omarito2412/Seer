<?php

require_once __DIR__.'/vendor/autoload.php';

use Seer\Seer;
use Seer\Core\Output;
use Seer\Core\Curl;
use Seer\Core\Xpath;

$xpath = new Xpath();
$curl = new Curl();
$output = new Output();

$scraper = new Seer();

if ($scraper->get('https://github.com/Omarito2412/Seer', [CURLOPT_FOLLOWLOCATION => true])->status == 0) {
    $Names = $scraper->query("//td[@class='content']/span/a/text()");
    foreach ($Names as $name) {
        echo $name->nodeValue.'<br/>';
    }
}
// $scraper->xpath->load($page);
// $scraper->xpath->add_query('Filenames', "//td[@class='content']/span/a/text()");
// $Names = $scraper->xpath->run()['Filenames'];

// $scraper->output->csv_init('output.csv', 'File');
// $output = array();
// foreach ($Names as $name) {
//     echo $name->nodeValue.'<br/>';
//     $output[] = array($name->nodeValue);
// }
// $scraper->output->csv_push_all('output.csv', $output);
// $scraper->output->csv_create('output.csv');
