<?php
/**
 * Created by PhpStorm.
 * User: tkint
 * Date: 02/08/2017
 * Time: 22:10
 */

namespace dao;

use PDO;
use model\Setting;

/**
 * Class SettingDAO
 * @package dao
 */
class SettingDAO
{
    /**
     * @var PDO
     */
    private $pdo;

    /**
     * BookDAO constructor.
     */
    public function __construct()
    {
        $this->pdo = Connection::getInstance()->getPdo();
    }

    /**
     * @return array
     */
    public function getSettings()
    {
        $settings = array();
        $req = $this->pdo->prepare(
            'SELECT name, description, default_value, current_value
                      FROM setting'
        );
        $req->execute();

        $o = null;
        while ($o = $req->fetchObject(Setting::class)) {
            $settings[] = $o;
        }

        $req->closeCursor();

        return $settings;
    }

    /**
     * @param $name
     * @return Setting
     */
    public function getSettingByName($name)
    {
        $setting = new Setting();

        $req = $this->pdo->prepare(
            'SELECT name, description, default_value, current_value
                      FROM setting 
                      WHERE name = :name'
        );
        $req->bindParam(':name', $name, PDO::PARAM_STR);
        $req->execute();

        $o = null;
        if (($o = $req->fetchObject(Setting::class)) !== false) {
            $setting = $o;
        }

        $req->closeCursor();

        return $setting;
    }

    /**
     * @param Setting $setting
     * @return Setting
     */
    public function createSetting(Setting $setting)
    {
        $req = $this->pdo->prepare(
            'INSERT INTO setting (name, description, default_value, current_value) 
                      VALUES (:name, :description, :default_value, :current_value, :update_date, :image)'
        );
        $req->bindParam(':name', $setting->name, PDO::PARAM_STR);
        $req->bindParam(':description', $setting->description, PDO::PARAM_STR);
        $req->bindParam(':default_value', $setting->default_value, PDO::PARAM_STR);
        $req->bindParam(':current_value', $setting->current_value, PDO::PARAM_STR);
        $req->execute();

        return $setting;
    }

    public function updateSetting(Setting $setting, $name)
    {
        if ($setting->id_setting != null) {
            $req = $this->pdo->prepare(
                'UPDATE setting SET 
                          name = :name,
						  description = :description,
                          default_value = :default_value,
						  current_value = :current_value,
						  update_date = :update_date,
						  image = :image
                          WHERE name = :old_name'
            );
            $req->bindParam(':old_name', $name, PDO::PARAM_STR);
            $req->bindParam(':name', $setting->name, PDO::PARAM_STR);
            $req->bindParam(':description', $setting->description, PDO::PARAM_STR);
            $req->bindParam(':default_value', $setting->default_value, PDO::PARAM_STR);
            $req->bindParam(':current_value', $setting->current_value, PDO::PARAM_STR);
            $req->execute();
        }
        return $setting;
    }

    public function deleteSetting($name)
    {
        $req = $this->pdo->prepare(
            'DELETE FROM setting 
                      WHERE name = :name'
        );
        $req->bindParam(':name', $name, PDO::PARAM_STR);
        return $req->execute();
    }
}