<?php

namespace TaskStep\Logic\Exceptions;

use Exception;

/**
 * Exception à utiliser quand le token n'est pas valide
 */
class BadTokenException extends Exception
{

    public function __construct(){
        parent::__construct("Le token n'est pas valide");
    }

}