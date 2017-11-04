<?php
/**
 * Created by PhpStorm.
 * User: tkint
 * Date: 02/08/2017
 * Time: 22:10
 */

namespace model;


/**
 * Class Setting
 * @package model
 */
class Setting
{
    /**
     * @var
     */
    public $name;

    /**
     * @var
     */
    public $description;

    /**
     * @var
     */
    public $default_value;

    /**
     * @var
     */
    public $current_value;

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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getDefaultValue()
    {
        return $this->default_value;
    }

    /**
     * @param mixed $default_value
     */
    public function setDefaultValue($default_value)
    {
        $this->default_value = $default_value;
    }

    /**
     * @return mixed
     */
    public function getCurrentValue()
    {
        return $this->current_value;
    }

    /**
     * @param mixed $current_value
     */
    public function setCurrentValue($current_value)
    {
        $this->current_value = $current_value;
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
     * @return array|Setting
     */
    public static function fromJSON($json)
    {
        $object = json_decode($json, true);
        if (sizeof($object) > 1 && !(isset($object['id_setting']) && !is_null($object['id_setting']))) {
            $settings = array();
            foreach ($object as $o) {
                $settings[] = self::fromArray($o);
            }
            return $settings;
        }
        return self::fromArray($object);
    }

    /**
     * @param $array
     * @return Setting
     */
    public static function fromArray($array)
    {
        $setting = new Setting();
        foreach ($array as $key => $value) {
            if (property_exists(get_class($setting), $key) && !is_null($value)) {
                $setting->$key = $value;
            }
        }
        return $setting;
    }
}