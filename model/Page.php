<?php
/**
 * Created by PhpStorm.
 * User: tkint
 * Date: 02/08/2017
 * Time: 22:10
 */

namespace model;


/**
 * Class Page
 * @package model
 */
class Page
{
    /**
     * @var
     */
    public $id_page;

    /**
     * @var
     */
    public $name;

    /**
     * @var
     */
    public $path;

    /**
     * @var
     */
    public $link;

    /**
     * @var
     */
    public $content;

    /**
     * @return mixed
     */
    public function getIdPage()
    {
        return $this->id_page;
    }

    /**
     * @param mixed $id_page
     */
    public function setIdPage($id_page)
    {
        $this->id_page = $id_page;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @return mixed
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param mixed $link
     */
    public function setLink($link)
    {
        $this->link = $link;
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
     * @return string
     */
    public function toJSON()
    {
        return json_encode($this);
    }

    /**
     * @param $json
     * @return Page
     */
    public static function fromJSON($json)
    {
        $object = json_decode($json, true);
        return self::fromArray($object);
    }

    /**
     * @param $array
     * @return Page
     */
    public static function fromArray($array)
    {
        $page = new Page();
        if (isset($array['id_page']) && !is_null($array['id_page']))
            $page->setIdPage($array['id_page']);
        if (isset($array['name']) && !is_null($array['name']))
            $page->setName($array['name']);
        if (isset($array['path']) && !is_null($array['path']))
            $page->setPath($array['path']);
        if (isset($array['link']) && !is_null($array['link']))
            $page->setLink($array['link']);
        if (isset($array['content']) && !is_null($array['content']))
            $page->setContent($array['content']);
        return $page;
    }
}