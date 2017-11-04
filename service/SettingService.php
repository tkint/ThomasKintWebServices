<?php
/**
 * Created by PhpStorm.
 * User: tkint
 * Date: 27/07/2017
 * Time: 04:03
 */

namespace service;

use dao\SettingDAO;
use model\Setting;
use WebServices;

/**
 * Class SettingService
 *
 * Web services served with the /setting url.
 * Implements methods coming from Service abstract class which define GET, POST, PUT and DELETE http methods
 *
 * @package service
 */
class SettingService extends Service
{
    /**
     * Get one specified setting or all of them if id not specified in url
     *
     * @return array|Setting|null
     */
    public static function doGet()
    {
        $data = null;
        $settingdao = new SettingDAO();
        $param = WebServices::getParam(0);
        if (isset($param) && !is_null($param)) {
            $data = $settingdao->getSettingByName($param);
        } else {
            $data = $settingdao->getSettings();
        }

        return $data;
    }

    /**
     * Create a setting from the json object passed in body request
     *
     * @return Setting|null
     */
    public static function doPost()
    {
        $data = null;
        $settingdao = new SettingDAO();
        $body = WebServices::getBody();
        if (isset($body) && !is_null($body)) {
            $setting = Setting::fromJSON($body);

            $data = $settingdao->createSetting($setting);
        }

        return $data;
    }

    /**
     * Update a specified setting from the json object passed in body request
     *
     * @return Setting|null
     */
    public static function doPut()
    {
        $data = null;
        $settingdao = new SettingDAO();
        $body = WebServices::getBody();
        $param = WebServices::getParam(0);
        if (isset($body) && !is_null($body) &&
            isset($param) && !is_null($param)) {
            $setting = Setting::fromJSON($body);

            $data = $settingdao->updateSetting($setting, $param);
        }

        return $data;
    }

    /**
     * Delete a specified setting
     *
     * @return bool|null
     */
    public static function doDelete()
    {
        $data = null;
        $settingdao = new SettingDAO();
        $param = WebServices::getParam(0);
        if (isset($param) && !is_null($param)) {
            $data = $settingdao->deleteSetting($param);
        }

        return $data;
    }
}