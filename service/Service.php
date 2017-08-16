<?php
/**
 * Created by PhpStorm.
 * User: tkint
 * Date: 27/07/2017
 * Time: 04:04
 */

namespace service;


abstract class Service
{
    public static function execute($method)
    {
        $result = null;
        switch ($method) {
            case 'GET':
                $result = static::doGet();
                break;
            case 'POST':
                $result = static::doPost();
                break;
            case 'PUT':
                $result = static::doPut();
                break;
            case 'DELETE':
                $result = static::doDelete();
                break;
            default:
                $result = false;
                break;
        }
        return $result;
    }

    public static function doGet()
    {
        return false;
    }

    public static function doPost()
    {
        return false;
    }

    public static function doPut()
    {
        return false;
    }

    public static function doDelete()
    {
        return false;
    }
}