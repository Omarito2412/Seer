<?php
require '../lib/seer.php';
require '../lib/core/xpath.php';
require '../lib/core/curl.php';
require '../lib/core/output.php';

class SeerTest extends PHPUnit_Framework_TestCase
{
    public $Seer;

    public function testLoader()
    {
        $this->Seer = new \Seer\Seer(new \Seer\Core\Xpath(), new \Seer\Core\Curl(), new \Seer\Core\Output());
        $this->assertAttributeInstanceOf("\Seer\Core\Xpath", "xpath", $this->Seer);
        $this->assertAttributeInstanceOf("\Seer\Core\Curl", "curl", $this->Seer);
        $this->assertAttributeInstanceOf("\Seer\Core\Output", "output", $this->Seer);
    }
}