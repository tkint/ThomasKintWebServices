<?php
/**
 * Created by PhpStorm.
 * User: tkint
 * Date: 27/07/2017
 * Time: 04:03
 */

namespace service;

use dao\LinkDAO;
use model\Link;
use WebServices;

/**
 * Class LinkService
 *
 * Web services served with the /link url.
 * Implements methods coming from Service abstract class which define GET, POST, PUT and DELETE http methods
 *
 * @package service
 */
class LinkService extends Service
{
    /**
     * Get one specified link or all of them if id not specified in url
     *
     * @return array|Link|null
     */
    public static function doGet()
    {
        $data = null;
        $linkdao = new LinkDAO();
        $param = WebServices::getParam(0);
        if (isset($param) && !is_null($param)) {
            $data = $linkdao->getLinkById($param);
        } else {
            $data = $linkdao->getLinks();
        }

        return $data;
    }

    /**
     * Create a link from the json object passed in body request
     *
     * @return Link|null
     */
    public static function doPost()
    {
        $data = null;
        $linkdao = new LinkDAO();
        $body = WebServices::getBody();
        if (isset($body) && !is_null($body)) {
            $link = Link::fromJSON($body);

            $data = $linkdao->createLink($link);
        }

        return $data;
    }

    /**
     * Update a specified link from the json object passed in body request
     *
     * @return Link|null
     */
    public static function doPut()
    {
        $data = null;
        $linkdao = new LinkDAO();
        $body = WebServices::getBody();
        if (isset($body) && !is_null($body)) {
            $link = Link::fromJSON($body);

            $data = $linkdao->updateLink($link);
        }

        return $data;
    }

    /**
     * Delete a specified link
     *
     * @return bool|null
     */
    public static function doDelete()
    {
        $data = null;
        $linkdao = new LinkDAO();
        $param = WebServices::getParam(0);
        if (isset($param) && !is_null($param)) {
            $data = $linkdao->deleteLink($param);
        }

        return $data;
    }
}