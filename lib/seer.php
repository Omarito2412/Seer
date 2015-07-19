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
    private $xpath;
    private $curl;
    private $output;

    /**
     * You have two ways to create a Seer object, the first being by
     * instantiating objects that extend the Seer\Core components
     * which are Xpath, Curl, Output to suite your needs  and
     * inject them into the Seer constructor, or by using
     * the stock classes by not supplying arguments to
     * the constructor while creating a new instance.
     * @param Core\Xpath $xpath
     * @param Core\Curl $curl
     * @param Core\Output $output
     */
    public function __construct(Core\Xpath $xpath = null, Core\Curl $curl = null, Core\Output $output = null)
    {
        $this->xpath = ($xpath == null) ? new Core\Xpath : $xpath;
        $this->curl = ($curl == null) ? new Core\Curl : $curl;
        $this->output = ($output == null) ? new Core\output : $output;
    }

    /**
     * Send a GET request to the given URL and scrape the response page
     * @param  String $url The URL to scrape
     * @param  Array $params Any extra curl params
     * @return Object The status of the response and the errors if available
     */
    public function get($url, $params = null)
    {
        $this->curl->init($url);
        if ($params) {
            $this->curl->add_option($params);
        }

        $this->xpath->load($this->curl->run());
        $errors = $this->curl->retrieve_errors();
        if ($errors['count'] > 0) {
            return (object) ['status' => -1, 'errors' => $errors['errors']];
        }
        return (object) ['status' => 0, 'errors' => null];
    }
    /**
     * Send a POST request to the given URL and scrape the response page
     * @param  String $url The URL to scrape
     * @param  Array $params Any extra curl params
     * @param  Array $fields An array of Key => Value pairs to be sent as form data
     * @return Object The status of the response and the errors if available
     */
    public function post($url, $fields, $params = null)
    {
        return $this->request("POST", $url, $fields, $params);
    }

    /**
     * Send a PUT request to the given URL and scrape the response page
     * @param  String $url The URL to scrape
     * @param  Array $params Any extra curl params
     * @param  Array $fields An array of Key => Value pairs to be sent as form data
     * @return Object The status of the response and the errors if available
     */
    public function put($url, $fields, $params = null)
    {
        return $this->request("PUT", $url, $fields, $params);
    }

    /**
     * @param  String $type HTTP Request Type
     * @param  String $url The URL to scrape
     * @param  Array $params Any extra curl params
     * @param  Array $fields An array of Key => Value pairs to be sent as form data
     * @return Object The status of the response and the errors if available
     */
    private function request($type, $url, $fields, $params = null)
    {
        $this->curl->init($url);
        $this->curl->add_option(CURLOPT_CUSTOMREQUEST, $type);
        $fields = http_build_query($fields);
        $this->curl->add_option(CURLOPT_POSTFIELDS, $fields);
        $this->xpath->load($this->curl->run());
        $errors = $this->curl->retrieve_errors();
        if ($errors['count'] > 0) {
            return (object) ['status' => -1, 'errors' => $errors['errors']];
        }
        return (object) ['status' => 0, 'errors' => null];
    }

    /**
     * @param  String $query The query to execute
     * @return NodeList The result set
     */
    public function query($query)
    {
        $this->xpath->add_query("query", $query);
        return $this->xpath->run()["query"];
    }
    /**
     * @param  String $input The query name or an Array of Queries Name => Query
     * @param  String $query The query in case $input is not an Array
     * @param  String $return The return type
     * @return Void
     */
    public function storeQuery($input, $query = null, $return = "LIST")
    {
        $this->xpath->addQuery($input, $query, $return);
    }
}
