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
class Seer
{
    public $xpath;
    public $curl;
    public $output;

    public function __construct(Core\Xpath $xpath, Core\Curl $curl, Core\Output $output)
    {
        $this->xpath  = $xpath;
        $this->curl   = $curl;
        $this->output = $output;
    }
}
