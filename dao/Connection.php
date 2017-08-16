<?php
/**
 * Created by PhpStorm.
 * User: tkint
 * Date: 11/07/2017
 * Time: 18:17
 */

namespace dao;

use Config;
use Exception;
use PDO;


/**
 * Class Connection
 * @package dao
 */
class Connection
{
    /**
     * @var PDO
     */
    private $pdo;

    /**
     * @var
     */
    private static $instance;

    /**
     * Connection constructor.
     * @throws Exception
     */
    private function __construct()
    {
        try {
            $this->pdo = new PDO(
                'mysql:dbname=' . Config::DB_BASE . ';host=' . Config::DB_URL . ';port=' . Config::DB_PORT,
                Config::DB_USER,
                Config::DB_PASS,
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
            );
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    /**
     * @return PDO
     */
    public function getPdo()
    {
        return $this->pdo;
    }

    /**
     * @return Connection
     */
    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Connection();
        }
        return self::$instance;
    }
}