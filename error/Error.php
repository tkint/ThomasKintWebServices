<?php
/**
 * Created by PhpStorm.
 * User: Thomas
 * Date: 19/11/2017
 * Time: 22:38
 */

namespace error;

class Error
{
    public $type;

    public $code;

    public $message;

    /**
     * Error constructor.
     * @param $type
     * @param $error
     */
    public function __construct($type, $error)
    {
        $this->type = $type;
        $this->code = $error[0];
        $this->message = $error[1];
    }
}