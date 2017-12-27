<?php

/**
 * Created by PhpStorm.
 * User: tkint
 * Date: 11/07/2017
 * Time: 18:18
 */
abstract class Config
{
    const WS_URL = 'ws';
    const WS_CLASS = 'Service';
    const WS_EXE = 'execute';

    const DB_URL = 'localhost';
    const DB_PORT = 3306;
    const DB_USER = 'thomaskint';
    const DB_PASS = 'thomaskint';
    const DB_BASE = 'thomaskint';

    public static $ALLOWED_ORIGIN = array(
        'http://localhost:8080',
        'http://thomaskint.com',
        'https://thomaskint.com',
        'http://www.thomaskint.com',
        'https://www.thomaskint.com'
    );
}