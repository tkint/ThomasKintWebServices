<?php
/**
 * Created by PhpStorm.
 * User: tkint
 * Date: 27/07/2017
 * Time: 04:03
 */

namespace service;

use dao\ArticleDAO;
use model\Article;
use WebServices;

/**
 * Class ArticleService
 *
 * Web services served with the /article url.
 * Implements methods coming from Service abstract class which define GET, POST, PUT and DELETE http methods
 *
 * @package service
 */
class ArticleService extends Service
{
    /**
     * Get one specified article or all of them if id not specified in url
     *
     * @return array|Article|null
     */
    public static function doGet()
    {
        $data = null;
        $articledao = new ArticleDAO();
        $param = WebServices::getParam(0);
        if (isset($param) && !is_null($param)) {
            $data = $articledao->getArticleByIdArticle($param);
        } else {
            $data = $articledao->getArticles();
        }

        return $data;
    }

    /**
     * Create a article from the json object passed in body request
     *
     * @return Article|null
     */
    public static function doPost()
    {
        $data = null;
        $articledao = new ArticleDAO();
        $body = WebServices::getBody();
        if (isset($body) && !is_null($body)) {
            $article = Article::fromJSON($body);

            $data = $articledao->createArticle($article);
        }

        return $data;
    }

    /**
     * Update a specified article from the json object passed in body request
     *
     * @return Article|null
     */
    public static function doPut()
    {
        $data = null;
        $articledao = new ArticleDAO();
        $body = WebServices::getBody();
        if (isset($body) && !is_null($body)) {
            $article = Article::fromJSON($body);

            $data = $articledao->updateArticle($article);
        }

        return $data;
    }

    /**
     * Delete a specified article
     *
     * @return bool|null
     */
    public static function doDelete()
    {
        $data = null;
        $articledao = new ArticleDAO();
        $param = WebServices::getParam(0);
        if (isset($param) && !is_null($param)) {
            $data = $articledao->deleteArticle($param);
        }

        return $data;
    }
}