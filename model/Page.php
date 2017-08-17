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
    public $name;

    /**
     * @var
     */
    public $link;

    /**
     * @var
     */
    public $path;
	
	/**
     * @var
     */
    public $icon;

	/**
     * @var
     */
    public $numorder;

    /**
     * @var
     */
    public $content;
	
	/**
     * @var
     */
    public $style;

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
     * @param mixed $icon
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;
    }
	
	/**
     * @return mixed
     */
    public function getIcon()
    {
        return $this->icon;
    }
	
	/**
     * @param mixed $numorder
     */
    public function setNumorder($numorder)
    {
        $this->numorder = $numorder;
    }
	
	/**
     * @return mixed
     */
    public function getNumorder()
    {
        return $this->numorder;
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
	public function getStyle()
    {
        return $this->style;
    }

    /**
     * @param mixed $style
     */
    public function setStyle($style)
    {
        $this->style = $style;
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
        if (isset($array['name']) && !is_null($array['name']))
            $page->setName($array['name']);
        if (isset($array['link']) && !is_null($array['link']))
            $page->setLink($array['link']);
        if (isset($array['path']) && !is_null($array['path']))
            $page->setPath($array['path']);
        if (isset($array['icon']) && !is_null($array['icon']))
            $page->setIcon($array['icon']);
        if (isset($array['numorder']) && !is_null($array['numorder']))
            $page->setNumorder($array['numorder']);
        if (isset($array['content']) && !is_null($array['content']))
            $page->setContent($array['content']);
        if (isset($array['style']) && !is_null($array['style']))
            $page->setStyle($array['style']);
        return $page;
    }
}