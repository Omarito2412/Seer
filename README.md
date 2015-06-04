## SEER

A PHP XPath based web scraping framework.

Install
-----

Using Git
```bash
$ git clone https://github.com/Omarito2412/Seer.git
```

Using Composer
```json
{
     "require":{
          "seer/seer" : "dev-master"
     }

}
```

Or download it manually


Usage
-----
Simply require `Seer.php` and start your query.


````php
<?php

require_once 'Seer.php';


use Seer\lib\Seer;
use Seer\lib\Core\Output;
use Seer\lib\Core\Curl;
use Seer\lib\Core\Xpath;


$xpath = new Xpath;
$curl = new Curl;
$output = new Output;

$scraper = new Seer($xpath, $curl, $output);

$scraper->curl->init('https://github.com/Omarito2412/Seer');
$scraper->curl->add_option(array(
     CURLOPT_RETURNTRANSFER => true,
     CURLOPT_FOLLOWLOCATION => true
));
$page = $scraper->curl->run();
$scraper->xpath->load($page);
$scraper->xpath->add_query('Filenames', "//td[@class='content']/span/a/text()");
$Names = $scraper->xpath->run()['Filenames'];

$scraper->output->csv_init('output.csv', 'File');
$output = array();
foreach($Names as $name){
     $output[] = array($name->nodeValue);
}
$scraper->output->csv_push_all('output.csv', $output);
$scraper->output->csv_create('output.csv');
````

LICENSE
-----
MIT
