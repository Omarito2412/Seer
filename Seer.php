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
namespace Seer;

/**
 * Responsibilites:
 *   This is the loader class, Communication occurs only through it.
 */
define('CORE_LOCATION', "./Core/");

require_once __DIR__.'/vendor/autoload.php';

class Seer
{
    public $xpath;
    public $curl;
    public $output;

    public function __construct()
    {
        $this->xpath = new Core\Xpath();
        $this->curl = new Core\Curl();
        $this->output = new Core\Output();
    }
}
