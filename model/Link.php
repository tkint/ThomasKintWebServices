<?php
/**
 * Created by PhpStorm.
 * User: tkint
 * Date: 02/08/2017
 * Time: 22:10
 */

namespace model;


/**
 * Class Link
 * @package model
 */
class Link
{
    /**
     * @var
     */
    public $id_link;

    /**
     * @var
     */
    public $name;

    /**
     * @var
     */
    public $target;

    /**
     * @var
     */
    public $icon;

    /**
     * @var
     */
    public $fa;

    /**
     * @return mixed
     */
    public function getIdLink()
    {
        return $this->id_link;
    }

    /**
     * @param mixed $id_link
     */
    public function setIdLink($id_link)
    {
        $this->id_link = $id_link;
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
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * @param mixed $target
     */
    public function setTarget($target)
    {
        $this->target = $target;
    }

    /**
     * @return mixed
     */
    public function getIcon()
    {
        return $this->icon;
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
    public function getFa()
    {
        return $this->fa;
    }

    /**
     * @param mixed $fa
     */
    public function setFa($fa)
    {
        $this->fa = $fa;
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
     * @return Link
     */
    public static function fromJSON($json)
    {
        $object = json_decode($json, true);
        return self::fromArray($object);
    }

    /**
     * @param $array
     * @return Link
     */
    public static function fromArray($array)
    {
        $link = new Link();
        if (isset($array['id_link']) && !is_null($array['id_link']))
            $link->setIdLink($array['id_link']);
        if (isset($array['name']) && !is_null($array['name']))
            $link->setName($array['name']);
        if (isset($array['target']) && !is_null($array['target']))
            $link->setTarget($array['target']);
        if (isset($array['icon']) && !is_null($array['icon']))
            $link->setIcon($array['icon']);
        if (isset($array['fa']) && !is_null($array['fa']))
            $link->setFa($array['fa']);
        return $link;
    }
}