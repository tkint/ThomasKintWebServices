<?php
/**
 * Created by PhpStorm.
 * User: Thomas
 * Date: 19/11/2017
 * Time: 22:38
 */

namespace error;

abstract class UserErrors
{
    const ALREADY_EXISTS = array(0, 'User already exists');
    const DOES_NOT_EXIST = array(1, 'User doesn\'t exist');
    const NOT_VALID = array(2, 'User not valid');
}