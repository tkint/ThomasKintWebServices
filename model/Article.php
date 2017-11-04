<?php
/**
 * Created by PhpStorm.
 * User: tkint
 * Date: 02/08/2017
 * Time: 22:10
 */

namespace model;


/**
 * Class Article
 * @package model
 */
class Article
{
    /**
     * @var
     */
    public $id_article;

    /**
     * @var
     */
    public $id_user;

    /**
     * @var
     */
    public $title;

    /**
     * @var
     */
    public $content;

    /**
     * @var
     */
    public $creation_date;

    /**
     * @var
     */
    public $update_date;

    /**
     * @var
     */
    public $image;

    /**
     * @return mixed
     */
    public function getIdArticle()
    {
        return $this->id_article;
    }

    /**
     * @param mixed $id_article
     */
    public function setIdArticle($id_article)
    {
        $this->id_article = $id_article;
    }

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->id_user;
    }

    /**
     * @param mixed $id_user
     */
    public function setIdUser($id_user)
    {
        $this->id_user = $id_user;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getCreationDate()
    {
        return $this->creation_date;
    }

    /**
     * @param mixed $creation_date
     */
    public function setCreationDate($creation_date)
    {
        $this->creation_date = $creation_date;
    }

    /**
     * @return mixed
     */
    public function getUpdateDate()
    {
        return $this->update_date;
    }

    /**
     * @param mixed $update_date
     */
    public function setUpdateDate($update_date)
    {
        $this->update_date = $update_date;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return string
     */
    public function toJSON()
    {
        return json_encode($this);
    }

    /**
     * @param $json
     * @return array|Article
     */
    public static function fromJSON($json)
    {
        $object = json_decode($json, true);
        if (sizeof($object) > 1 && !(isset($object['id_article']) && !is_null($object['id_article']))) {
            $articles = array();
            foreach ($object as $o) {
                $articles[] = self::fromArray($o);
            }
            return $articles;
        }
        return self::fromArray($object);
    }

    /**
     * @param $array
     * @return Article
     */
    public static function fromArray($array)
    {
        $article = new Article();
        foreach ($array as $key => $value) {
            if (property_exists(get_class($article), $key) && !is_null($value)) {
                $article->$key = $value;
            }
        }
        return $article;
    }
}