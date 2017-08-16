<?php
/**
 * Created by PhpStorm.
 * User: tkint
 * Date: 27/07/2017
 * Time: 03:55
 */

/**
 * Class WebServices
 *
 * Main functions for the web services to work
 *
 */
class WebServices
{
    /**
     * Execute function of the targeted service
     *
     * @param $method
     * @return mixed
     */
    public static function execute($method)
    {
        $service = self::getService();
        return call_user_func('service\\' . $service . Config::WS_CLASS . '::' . Config::WS_EXE, $method);
    }

    /**
     * Get the service from the url
     *
     * @return string
     */
    private function getService()
    {
        $url = explode('/', self::getUrl());
        return ucfirst($url [0]);
    }

    /**
     * Get the parameter from the url at the position specified
     *
     * @param $index
     * @return null
     */
    public static function getParam($index)
    {
        $param = null;
        $url = explode('/', self::getUrl());
        if (sizeof($url) > $index + 1) {
            $param = $url [$index + 1];
        }
        return $param;
    }

    /**
     * Get the body of the request
     *
     * @return bool|string
     */
    public static function getBody() {
        return file_get_contents('php://input');
    }

    /**
     * Get the url stocked on the ws GET parameter due to RewriteEngine
     *
     * @return string
     */
    private function getUrl()
    {
        $url = '';
        if (isset ($_GET [Config::WS_URL]) && !empty ($_GET [Config::WS_URL])) {
            $url = $_GET [Config::WS_URL];
        }
        return $url;
    }
}