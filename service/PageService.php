<?php
/**
 * Created by PhpStorm.
 * User: tkint
 * Date: 27/07/2017
 * Time: 04:03
 */

namespace service;

use dao\PageDAO;
use model\Page;
use WebServices;

/**
 * Class PageService
 *
 * Web services served with the /page url.
 * Implements methods coming from Service abstract class which define GET, POST, PUT and DELETE http methods
 *
 * @package service
 */
class PageService extends Service
{
    /**
     * Get one specified page or all of them if id not specified in url
     *
     * @return array|Page|null
     */
    public static function doGet()
    {
        $data = null;
        $pagedao = new PageDAO();
        $param = WebServices::getParam(0);
        if (isset($param) && !is_null($param)) {
			if ($param == 'numorders') {
				$data = $pagedao->getNumorders();
			} else {
				$data = $pagedao->getPageByName($param);
				$data->content = utf8_encode($data->content);
			}
        } else {
			$data = $pagedao->getPages();
        }

        return $data;
    }

    /**
     * Create a page from the json object passed in body request
     *
     * @return Page|null
     */
    public static function doPost()
    {
        $data = null;
        $pagedao = new PageDAO();
        $body = WebServices::getBody();
        if (isset($body) && !is_null($body)) {
            $page = Page::fromJSON($body);

            $data = $pagedao->createPage($page);
        }

        return $data;
    }

    /**
     * Update a specified page from the json object passed in body request
     *
     * @return Page|null
     */
    public static function doPut()
    {
        $data = null;
        $pagedao = new PageDAO();
        $param = WebServices::getParam(0);
        $body = WebServices::getBody();
        if (isset($body) && !is_null($body)) {
            if (isset($param) && !is_null($param)) {
                if ($param == 'numorders') {
                    $numorders = Page::fromJSON($body);

                    $data = $pagedao->updateNumorders($numorders);
                }
            } else {
                $page = Page::fromJSON($body);

                $data = $pagedao->updatePage($page);
            }
        }

        return $data;
    }

    /**
     * Delete a specified page
     *
     * @return bool|null
     */
    public static function doDelete()
    {
        $data = null;
        $pagedao = new PageDAO();
        $param = WebServices::getParam(0);
        if (isset($param) && !is_null($param)) {
            $data = $pagedao->deletePage($param);
        }

        return $data;
    }
}